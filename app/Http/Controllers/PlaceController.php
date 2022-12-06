<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Scanned;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;

class PlaceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:place-list|place-create|place-edit|place-delete', ['only' => ['index','store']]);
        $this->middleware('permission:place-create', ['only' => ['create','store']]);
        $this->middleware('permission:place-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:place-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Place::where('type','=',1)->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('lat', function ($data) {
                    $lat =  sprintf('%.6f', floor($data->lat*10000*($data->lat>0?1:-1))/10000*($data->lat>0?1:-1));
                    $long = sprintf('%.6f', floor($data->long*10000*($data->long>0?1:-1))/10000*($data->long>0?1:-1));
                    return "($lat,$long)";
                })
                ->addColumn('QRCode', function ($data) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->QRCode.'" data-original-title="Edit" class="edit btn btn-outline-dark editProduct">Show</a>';
                    return $btn;
                })
                ->addColumn('action', function ($data) {
                    $action = '<div class="text-center">
                            <div class="btn-group dropstart text-center">
                                  <button type="button" class="btn btn-sm btn-light btn-active-light-primary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="svg-icon svg-icon-5 m-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                      height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                      fill="black"/>
									</svg>
									</span>Actions
                                  </button>
                                  <div class="dropdown-menu">';


                    $action = $action . '<div class="menu-item px-3">
                                            <a href="' . route('places.show', $data->id) . '"
                                               class="menu-link px-3">show</a>
                                        </div>';
                    $action = $action . '<div  class="menu-item px-3">
                                        <a id="edit" data-id="' . $data->id . '" data-name="' . $data->title . '" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_event"
                                           class="menu-link px-3">edit</a>
                                    </div>';
                    $action = $action . '<div class="menu-item px-3">
                                        <a href="' . url('pdf/' . $data->id) . '"
                                           class="menu-link px-3">export qr pdf</a>
                                    </div>';
                    $action = $action . '<div id="delete" data-id="' . $data->id . '" data-name="' . $data->title . '" class="menu-item px-3" data-kt-docs-table-filter="delete_row">
                                        <a data-kt-docs-table-filter="delete_row"
                                           class="menu-link px-3">Delete</a>
                                    </div>';

                    $action = $action . '</div></div></div>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }
        return view('forms.places.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'lat' => 'required|numeric|max:255',
                'long' => 'required|numeric|max:255',
                'location' => 'required|string|max:255',
                'uniqid' => 'required|max:255',
                'image' => 'required|mimes:jpeg,png,jpg'
            ], [
//                'name.required' => trans("str.Name is required"),
            ]);
            if ($validator->passes()) {

                $data = new Place();
                $data->title = $request->title;
                $data->description = $request->description;
                $data->lat = $request->lat;
                $data->long = $request->long;
                $data->location = $request->location;
                $data->type = 1;
                $data->added_by = Auth::user()->id;
                $data->QRCode = $request->uniqid;


                $imageuploaded = request()->file('image');
                $imagename = time() . '.' . $imageuploaded->getClientOriginalExtension();
                $imagepath = public_path('/images/places');
                $imageuploaded->move($imagepath, $imagename);
                $data->image = $imagename;


                $data->save();
                return response()->json(['success' => $data]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }
    }

    public function show($id)
    {
        $places = Place::find($id);
        $initialMarkers = [
            [
                'position' => [
                    'lat' => (double) $places->lat,
                    'lng' => (double) $places->long,
                ],
                'label' => ['color' => 'white', 'text' => 'M'],
                'draggable' => true
            ],
        ];
        return view('forms.places.show',compact('places','initialMarkers'));
    }

    public function edit(Request $request,$id)
    {
        if ($request->ajax()) {
            $event = Place::find($id);
            $initials = [
                [
                    'position' => [
                        'lat' => (double) $event->lat,
                        'lng' => (double) $event->long,
                    ],
                    'label' => ['color' => 'white', 'text' => 'M'],
                    'draggable' => true
                ],
            ];
            return response()->json(['event' => $event, 'initials' => $initials]);
        }
    }

    public function update(Request $request)
    {
        $data = Place::query()->find($request->place_id);
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'title_u' => 'required|string|max:255',
                'description_u' => 'required|string|max:500',
                'default_latitude_u' => 'required|numeric|max:255',
                'default_longitude_u' => 'required|numeric|max:255',
                'location_u' => 'required|string|max:255',
            ], [
//                'name.required' => trans("str.Name is required"),
            ]);
            if ($validator->passes()) {
                $data = Place::query()->find($request->place_id);
                $data->title = $request->title_u;
                $data->description = $request->description_u;
                $data->lat = $request->default_latitude_u;
                $data->long = $request->default_longitude_u;
                $data->location = $request->location_u;
                $data->updated_by = Auth::user()->id;

                if ($request->input('image') != 'undefined'){
                    $imageuploaded = request()->file('image');
                    $imagename = time() . '.' . $imageuploaded->getClientOriginalExtension();
                    $imagepath = public_path('/images/places');
                    $imageuploaded->move($imagepath, $imagename);
                    $data->image = $imagename;
                }

                $data->save();
                return response()->json(['success' => $data]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Place::query()->find($id)->delete();
            return response()->json(['success' => "success"]);
        }
        return response()->json(['error' => "error"]);
    }

    public function generator(Request $request)
    {

        $u = uniqid();
        if (File::exists(public_path('images/qrcode.svg'))) {
            File::delete(public_path('images/qrcode.svg'));
        }
        QrCode::size(300)->generate($u,public_path('images/qrcode.svg'));

        $response = array(
            'status' => 'success',
            'id' => $u,
            'qr' =>  asset("images/qrcode.svg")  ,
        );

        return response()->json($response);

    }
    public function showqr(Request $request)
    {
        $place = Place::where('QRCode',$request->qr)->first();
        $scan = new Scanned();
        $scan->place_id = $place->id;
        $scan->save();
        return QrCode::size(250)->generate($request->qr);
    }
    public function generatePDF($id)
    {
        $pd = Place::find($id)->QRCode;
        $pdf = Pdf::loadView('forms.places.qrcode', compact('pd'));
        return $pdf->download('qrcode.pdf');
    }
}

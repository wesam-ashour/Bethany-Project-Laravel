<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Scanned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;
use \Illuminate\Support\Str;

class PlaceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:place-list|place-create|place-edit|place-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:place-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:place-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:place-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Place::where('type', '=', 1)->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return Str::limit($data->title,20) ;
                })
                ->addColumn('description', function ($data) {
                    return Str::limit($data->description,20) ;
                })
                ->addColumn('location', function ($data) {
                    return Str::limit($data->location,20);
                })
                ->addColumn('lat', function ($data) {
                    $lat = sprintf('%.6f', floor($data->lat * 10000 * ($data->lat > 0 ? 1 : -1)) / 10000 * ($data->lat > 0 ? 1 : -1));
                    $long = sprintf('%.6f', floor($data->long * 10000 * ($data->long > 0 ? 1 : -1)) / 10000 * ($data->long > 0 ? 1 : -1));
                    return "($lat,$long)";
                })
                ->addColumn('QRCode', function ($data) {
                    $btn = '<a data-toggle="tooltip"  data-id="' . $data->QRCode . '" data-original-title="Edit" class="edit btn btn-outline-dark editProduct">' . trans("event.show QR") . '</a>';
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
									</span>' . trans("place.Actions") . '
                                  </button>
                                  <div class="dropdown-menu">';


                    $action = $action . '<div class="menu-item px-3">
                                            <a href="' . route('places.show', $data->id) . '"
                                               class="menu-link px-3">' . trans("place.Show") . '</a>
                                        </div>';
                    if (\auth()->user()->can('place-edit')) {
                        $action = $action . '<div  class="menu-item px-3">
                                        <a id="edit" data-id="' . $data->id . '" data-name="' . $data->title . '" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_event"
                                           class="menu-link px-3">' . trans("place.Edit_table") . '</a>
                                    </div>';
                    }
                    $action = $action . '<div class="menu-item px-3">
                                        <a href="' . url('pdf/' . $data->id) . '"
                                           class="menu-link px-3">' . trans("place.export") . '</a>
                                    </div>';
                    if (\auth()->user()->can('place-delete')) {
                        $action = $action . '<div id="delete" data-id="' . $data->id . '" data-name="' . $data->title . '" class="menu-item px-3" data-kt-docs-table-filter="delete_row">
                                        <a data-kt-docs-table-filter="delete_row"
                                           class="menu-link px-3">' . trans("place.Delete") . '</a>
                                    </div>';
                    }

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
                    'title_en' => 'required|string',
                    'title_ar' => 'required|string',
                    'description_en' => 'required|string',
                    'description_ar' => 'required|string',
                    'location_en' => 'required|string',
                    'location_ar' => 'required|string',
                    'lat' => 'required|numeric',
                    'long' => 'required|numeric',
                    'uniqid' => 'required|max:255',
                    'fileupload' => 'required|mimes:jpeg,png,jpg'
                ], [
                    'title_en.required' => trans("place.required"),
                    'title_en.string' => trans("place.string"),
                    'title_en.max' => trans("place.max"),
                    'title_ar.required' => trans("place.required"),
                    'title_ar.string' => trans("place.string"),
                    'title_ar.max' => trans("place.max"),

                    'description_en.required' => trans("place.required"),
                    'description_en.string' => trans("place.string"),
                    'description_en.max' => trans("place.max"),
                    'description_ar.required' => trans("place.required"),
                    'description_ar.string' => trans("place.string"),
                    'description_ar.max' => trans("place.max"),

                    'location_en.required' => trans("place.required"),
                    'location_en.string' => trans("place.string"),
                    'location_en.max' => trans("place.max"),
                    'location_ar.required' => trans("place.required"),
                    'location_ar.string' => trans("place.string"),
                    'location_ar.max' => trans("place.max"),

                    'lat.required' => trans("place.required"),
                    'lat.numeric' => trans("admin.numeric"),

                    'long.required' => trans("place.required"),
                    'long.numeric' => trans("admin.numeric"),

                    'uniqid.required' => trans("place.uniqid"),
                    'uniqid.max' => trans("place.max"),

                    'fileupload.required' => trans("place.image_req"),
                    'fileupload.mimes' => trans("place.mimes"),
                    'fileupload.uploaded' => trans("event.uploaded"),

                ]);

            if ($validator->passes()) {

                $data = new Place();
                $data->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
                $data->description = ['en' => $request->description_en, 'ar' => $request->description_ar];
                $data->lat = $request->lat;
                $data->long = $request->long;
                $data->location = ['en' => $request->location_en, 'ar' => $request->location_ar];
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
                    'lat' => (double)$places->lat,
                    'lng' => (double)$places->long,
                ],
                'label' => ['color' => 'white', 'text' => 'M'],
                'draggable' => true
            ],
        ];
        return view('forms.places.show', compact('places', 'initialMarkers'));
    }

    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $event = Place::find($id);
            $initials = [
                [
                    'position' => [
                        'lat' => (double)$event->lat,
                        'lng' => (double)$event->long,
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
        if ($request->ajax()) {
                $validator = Validator::make($request->all(), [
                    'title_en_edit' => 'required|string',
                    'title_ar_edit' => 'required|string',
                    'description_en_edit' => 'required|string',
                    'description_ar_edit' => 'required|string',
                    'location_en_edit' => 'required|string',
                    'location_ar_edit' => 'required|string',
                    'default_latitude_u' => 'required|numeric',
                    'default_longitude_u' => 'required|numeric',
                    'uniqid_edit' => 'sometimes|max:255',
                    'image' => $request->image != 'undefined' ? 'mimes:jpeg,png,jpg' : '',
                ], [
                    'title_en_edit.required' => trans("place.required"),
                    'title_en_edit.string' => trans("place.string"),
                    'title_en_edit.max' => trans("place.max"),
                    'title_ar_edit.required' => trans("place.required"),
                    'title_ar_edit.string' => trans("place.string"),
                    'title_ar_edit.max' => trans("place.max"),

                    'description_en_edit.required' => trans("place.required"),
                    'description_en_edit.string' => trans("place.string"),
                    'description_en_edit.max' => trans("place.max"),
                    'description_ar_edit.required' => trans("place.required"),
                    'description_ar_edit.string' => trans("place.string"),
                    'description_ar_edit.max' => trans("place.max"),

                    'location_en_edit.required' => trans("place.required"),
                    'location_en_edit.string' => trans("place.string"),
                    'location_en_edit.max' => trans("place.max"),
                    'location_ar_edit.required' => trans("place.required"),
                    'location_ar_edit.string' => trans("place.string"),
                    'location_ar_edit.max' => trans("place.max"),

                    'default_latitude_u.required' => trans("place.required"),
                    'default_latitude_u.numeric' => trans("admin.numeric"),

                    'default_longitude_u.required' => trans("place.required"),
                    'default_longitude_u.numeric' => trans("admin.numeric"),

                    'uniqid_edit.max' => trans("place.max"),

                    'image.mimes' => trans("place.mimes"),
                    'image.uploaded' => trans("event.uploaded"),

                ]);


            if ($validator->passes()) {
                $data = Place::query()->find($request->place_id);
                $data->title = ['en' => $request->title_en_edit, 'ar' => $request->title_ar_edit];
                $data->description = ['en' => $request->description_en_edit, 'ar' => $request->description_ar_edit];
                $data->lat = $request->default_latitude_u;
                $data->long = $request->default_longitude_u;
                $data->QRCode = $request->uniqid_edit;
                $data->location = ['en' => $request->location_en_edit, 'ar' => $request->location_ar_edit];
                $data->updated_by = Auth::user()->id;

                if ($request->input('image') != 'undefined') {
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
            $data2 = Scanned::where('place_id',$id)->delete();
            return response()->json(['success' => "success"]);
        }
        return response()->json(['error' => "error"]);
    }

    public function generator(Request $request)
    {
        $u = uniqid();

        File::deleteDirectory(public_path('images/qr'));
        File::makeDirectory(public_path('images/qr'));

        QrCode::size(300)->generate($u, public_path('images/qr/' . "$u" . '.svg'));

        $response = array(
            'status' => 'success',
            'id' => $u,
            'qr' => asset('public/images/qr/' . "$u" . '.svg'),
        );

        return response()->json($response);

    }

    public function showqr(Request $request)
    {
        $place = Place::where('QRCode', $request->qr)->first();
        return QrCode::size(250)->generate($request->qr);
    }

    public function generatePDF($id)
    {
        $pd = Place::find($id);
        $pdf = \niklasravnsborg\LaravelPdf\Facades\Pdf::loadView('forms.places.qrcode', compact('pd'));
        return $pdf->download('qrcode.pdf');

    }
}

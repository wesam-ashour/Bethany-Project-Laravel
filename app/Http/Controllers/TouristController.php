<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\DataTables\DataTables;

class TouristController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:tourist-list|tourist-create|tourist-edit|tourist-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:tourist-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tourist-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tourist-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Place::where('type', '=', 0)->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('description', function ($data) {
                    return $data->description;
                })
                ->addColumn('location', function ($data) {
                    return $data->location;
                })
                ->addColumn('lat', function ($data) {
                    $lat = sprintf('%.6f', floor($data->lat * 10000 * ($data->lat > 0 ? 1 : -1)) / 10000 * ($data->lat > 0 ? 1 : -1));
                    $long = sprintf('%.6f', floor($data->long * 10000 * ($data->long > 0 ? 1 : -1)) / 10000 * ($data->long > 0 ? 1 : -1));
                    return "($lat,$long)";
                })
                ->addColumn('QRCode', function ($data) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->QRCode . '" data-original-title="Edit" class="edit btn btn-outline-dark editProduct">'.trans("place.Show").'</a>';
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
									</span>'.trans("place.Actions").'
                                  </button>
                                  <div class="dropdown-menu">';


                    $action = $action . '<div class="menu-item px-3">
                                            <a href="' . route('tourists.show', $data->id) . '"
                                               class="menu-link px-3">'.trans("place.Show").'</a>
                                        </div>';
                    $action = $action . '<div  class="menu-item px-3">
                                        <a id="edit" data-id="' . $data->id . '" data-name="' . $data->title . '" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_event"
                                           class="menu-link px-3">'.trans("place.Edit_table").'</a>
                                    </div>';
                    $action = $action . '<div class="menu-item px-3">
                                        <a href="' . url('pdf/' . $data->id) . '"
                                           class="menu-link px-3">'.trans("place.export").'</a>
                                    </div>';
                    $action = $action . '<div id="delete" data-id="' . $data->id . '" data-name="' . $data->title . '" class="menu-item px-3" data-kt-docs-table-filter="delete_row">
                                        <a data-kt-docs-table-filter="delete_row"
                                           class="menu-link px-3">'.trans("place.Delete").'</a>
                                    </div>';

                    $action = $action . '</div></div></div>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }
        return view('forms.tourist.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'title_en' => 'required|string|max:255',
                'title_ar' => 'required|string|max:255',
                'description_en' => 'required|string|max:255',
                'description_ar' => 'required|string|max:255',
                'location_en' => 'required|string|max:255',
                'location_ar' => 'required|string|max:255',
                'lat' => 'required|numeric|max:255',
                'long' => 'required|numeric|max:255',
                'uniqid' => 'required|max:255',
                'fileupload' => 'required|mimes:jpeg,png,jpg'
            ],[
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

                'lat.required' => trans("place.lat"),

                'uniqid.required' => trans("place.uniqid"),
                'uniqid.max' => trans("place.max"),

                'fileupload.required' => trans("place.image_req"),
                'fileupload.mimes' => trans("place.mimes"),
            ]);

            if ($validator->passes()) {

                $data = new Place();
                $data->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
                $data->description = ['en' => $request->description_en, 'ar' => $request->description_ar];
                $data->lat = $request->lat;
                $data->long = $request->long;
                $data->location = ['en' => $request->location_en, 'ar' => $request->location_ar];
                $data->type = 0;
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
        $tourist = Tourist::find($id);
        $initialMarkers = [
            [
                'position' => [
                    'lat' => (double)$tourist->lat,
                    'lng' => (double)$tourist->long,
                ],
                'label' => ['color' => 'white', 'text' => 'M'],
                'draggable' => true
            ],
        ];
        return view('forms.tourist.show', compact('tourist', 'initialMarkers'));

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
        $data = Place::query()->find($request->tourist_id);
        if ($request->ajax()) {
                $validator = Validator::make($request->all(),
                    [
                        'title_en_edit' => 'required|string|max:255',
                        'title_ar_edit' => 'required|string|max:255',
                        'description_en_edit' => 'required|string|max:255',
                        'description_ar_edit' => 'required|string|max:255',
                        'location_en_edit' => 'required|string|max:255',
                        'location_ar_edit' => 'required|string|max:255',
                        'default_latitude_u' => 'required|numeric|max:255',
                        'uniqid_edit' => 'sometimes|max:255',
                        'image' =>  $request->image != 'undefined' ? 'mimes:jpeg,png,jpg' : '',
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

                        'lat_edit.required' => trans("place.lat"),

                        'uniqid_edit.max' => trans("place.max"),

                        'image.mimes' => trans("place.mimes"),
                    ]);



            if ($validator->passes()) {
                $data = Place::query()->find($request->tourist_id);
                $data->title = ['en' => $request->title_en_edit, 'ar' => $request->title_ar_edit];
                $data->description = ['en' => $request->description_en_edit, 'ar' => $request->description_ar_edit];
                $data->lat = $request->default_latitude_u;
                $data->long = $request->default_longitude_u;
                $data->QRCode = $request->uniqid_edit;
                $data->location = ['en' => $request->location_en_edit, 'ar' => $request->location_ar_edit];
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
            $data = Tourist::query()->find($id)->delete();
            return response()->json(['success' => "success"]);
        }
        return response()->json(['error' => "error"]);
    }
}

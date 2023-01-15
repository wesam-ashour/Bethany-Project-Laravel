<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Mail\MessageMail;
use App\Models\Admin;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\Facades\DataTables;
use \Illuminate\Support\Str;

class EventController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:event-list|event-create|event-edit|event-delete', ['only' => ['index','show']]);
        $this->middleware('permission:event-create', ['only' => ['create','store']]);
        $this->middleware('permission:event-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:event-delete', ['only' => ['destroy']]);
    }

    public function pdf(Request $request){
        $pd = DB::table('event_user')->where('event_id', '=', $request->id)->get();
        $pdf = PDF::loadView('forms.events.pdf', compact('pd'));
        return $pdf->download('Users.pdf');
    }

    public function excel(Request $request){
        $id = $request->id;
        return Excel::download(new UsersExport($id), 'users.xlsx');
    }

    public function index(Request $request)
    {
        if ($request->has('download')) {
            // dd(1);
            $pd = DB::table('event_user')->where('event_id', '=', $request->download)->get();

            if ($pd->isEmpty()) {
                toastr()->error(trans("event.Oops"));
                return redirect()->back();
            } else {
                $pdf = Pdf::loadView('forms.events.pdf', compact('pd'));
                return $pdf->download('users.pdf');
            }

        }

        if ($request->ajax()) {
            $data = Event::select('id', 'title', 'date', 'added_by', 'status')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return  Str::limit($data->title,20) ;
                })
                ->addColumn('added_by', function ($data) {
                    return Admin::find($data->added_by)->name;
                })
                ->addColumn('status', function ($data) {
                    return ($data->status == 1) ? '<div class="badge badge-light-success">'.trans("event.Active").'</div>' : '<div class="badge badge-light-danger">'.trans("event.Inactive").'</div>';
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
									</span>'.trans("event.Actions").'
                                  </button>
                                  <div class="dropdown-menu">';

                    $action = $action . '<div class="menu-item px-3">
                                  <a href="' . url('event/register/' . $data->id) . '"
                                     class="menu-link px-3">'.trans("event.Register").'</a>
                              </div>';
                    $action = $action . '<div class="menu-item px-3">
                                            <a href="' . route('events.show', $data->id) . '"
                                               class="menu-link px-3">'.trans("event.Show").'</a>
                                        </div>';
                    if (\auth()->user()->can('event-edit')) {
                        $action = $action . '<div  class="menu-item px-3">
                                        <a id="edit" data-id="' . $data->id . '" data-name="' . $data->title . '" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_event"
                                           class="menu-link px-3">' . trans("event.Edit_table") . '</a>
                                    </div>';
                    }
                    if (\auth()->user()->can('event-delete')) {
                        $action = $action . '<div id="delete" data-id="' . $data->id . '" data-name="' . $data->title . '" class="menu-item px-3" data-kt-docs-table-filter="delete_row">
                                        <a data-kt-docs-table-filter="delete_row"
                                           class="menu-link px-3">' . trans("event.Delete") . '</a>
                                    </div>';
                    }

                    $action = $action . '</div></div></div>';
                        return $action;

                })
                ->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }
        return view('forms.events.index');
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
                'address_en' => 'required|string',
                'address_ar' => 'required|string',
                'date' => 'required',
                'time' => 'required',
                'fileupload' => 'mimes:jpeg,jpg,png|required',
                'default_latitude' => 'required|numeric',
                'default_longitude' => 'required|numeric',

            ], [
                'title_en.required' => trans("event.required"),
                'title_en.string' => trans("event.string"),
                'title_en.max' => trans("event.max"),
                'title_ar.required' => trans("event.required"),
                'title_ar.string' => trans("event.string"),
                'title_ar.max' => trans("event.max"),

                'description_en.required' => trans("event.required"),
                'description_en.string' => trans("event.string"),
                'description_en.max' => trans("event.max"),
                'description_ar.required' => trans("event.required"),
                'description_ar.string' => trans("event.string"),
                'description_ar.max' => trans("event.max"),

                'address_en.required' => trans("event.required"),
                'address_en.string' => trans("event.string"),
                'address_en.max' => trans("event.max"),
                'address_ar.required' => trans("event.required"),
                'address_ar.string' => trans("event.string"),
                'address_ar.max' => trans("event.max"),

                'date.required' => trans("event.required"),
                'date.date_format' => trans("event.string"),

                'time.required' => trans("event.required"),

                'default_latitude.required' => trans("event.required"),
                'default_latitude.numeric' => trans("admin.numeric"),

                'default_longitude.required' => trans("event.required"),
                'default_longitude.numeric' => trans("admin.numeric"),


                'fileupload.required' => trans("event.required"),
                'fileupload.mimes' => trans("event.mimes"),
                'fileupload.uploaded' => trans("event.uploaded"),

            ]);
            if ($validator->passes()) {
                $data = new Event();
                $data->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
                $data->description = ['en' => $request->description_en, 'ar' => $request->description_ar];
                $data->date = $request->date;
                $data->lat = $request->default_latitude;
                $data->long = $request->default_longitude;
                $data->address = ['en' => $request->address_en, 'ar' => $request->address_ar];
                $data->added_by = Auth::user()->id;
                $data->status = '1';
                $data->time = $request->time;

                $imageuploaded = request()->file('image');
                $imagename = time() . '.' . $imageuploaded->getClientOriginalExtension();
                $imagepath = public_path('/images/events');
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
        $event = Event::find($id);
        $initialMarkers = [
            [
                'position' => [
                    'lat' => (double) $event->lat,
                    'lng' => (double) $event->long,
                ],
                'label' => ['color' => 'white', 'text' => 'M'],
                'draggable' => false
            ],
        ];
        return view('forms.events.show',compact('event','initialMarkers'));

    }

    public function edit(Request $request,$id)
    {
        if ($request->ajax()) {
            $event = Event::find($id);
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
        $data = Event::query()->find($request->event_id);
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'title_en_edit' => 'required|string',
                'title_ar_edit' => 'required|string',
                'description_en_edit' => 'required|string',
                'description_ar_edit' => 'required|string',
                'address_en_edit' => 'required|string',
                'address_ar_edit' => 'required|string',
                'date_u' => 'required|date_format:Y-m-d',
                'time_edit' => 'required',
                'status' => 'required',
                'fileuploads' => 'mimes:jpeg,jpg,png|sometimes',
                'default_latitude_u' => 'required|numeric',
                'default_longitude_u' => 'required|numeric',

            ], [
                'title_en_edit.required' => trans("event.required"),
                'title_en_edit.string' => trans("event.string"),
                'title_en_edit.max' => trans("event.max"),
                'title_ar_edit.required' => trans("event.required"),
                'title_ar_edit.string' => trans("event.string"),
                'title_ar_edit.max' => trans("event.max"),

                'description_en_edit.required' => trans("event.required"),
                'description_en_edit.string' => trans("event.string"),
                'description_en_edit.max' => trans("event.max"),
                'description_ar_edit.required' => trans("event.required"),
                'description_ar_edit.string' => trans("event.string"),
                'description_ar_edit.max' => trans("event.max"),

                'address_en_edit.required' => trans("event.required"),
                'address_en_edit.string' => trans("event.string"),
                'address_en_edit.max' => trans("event.max"),
                'address_ar_edit.required' => trans("event.required"),
                'address_ar_edit.string' => trans("event.string"),
                'address_ar_edit.max' => trans("event.max"),

                'date_u.required' => trans("event.required"),
                'date_u.date_format' => trans("event.string"),

                'time_edit.required' => trans("event.required"),

                'status.required' => trans("event.required"),

                'default_latitude_u.required' => trans("event.required"),
                'default_latitude_u.numeric' => trans("admin.numeric"),

                'default_longitude_u.required' => trans("event.required"),
                'default_longitude_u.numeric' => trans("admin.numeric"),


                'fileuploads.mimes' => trans("event.mimes"),
                'fileuploads.uploaded' => trans("event.uploaded"),


            ]);
            if ($validator->passes()) {
                $data = Event::query()->find($request->event_id);
                $data->title = ['en' => $request->title_en_edit, 'ar' => $request->title_ar_edit];
                $data->description = ['en' => $request->description_en_edit, 'ar' => $request->description_ar_edit];
                $data->date = $request->date_u;
                $data->lat = $request->default_latitude_u;
                $data->long = $request->default_longitude_u;
                $data->address = ['en' => $request->address_en_edit, 'ar' => $request->address_ar_edit];
                $data->updated_by = Auth::user()->id;
                $data->status = $request->status;
                $data->time = $request->time_edit;

                if ($request->input('image') != 'undefined'){
                $imageuploaded = request()->file('image');
                $imagename = time() . '.' . $imageuploaded->getClientOriginalExtension();
                $imagepath = public_path('/images/events');
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
            $data = Event::query()->find($id)->delete();
            $data2 = DB::table('event_user')->where('event_id',$id)->delete();

            return response()->json(['success' => "success"]);
        }
        return response()->json(['error' => "error"]);
    }

    public function register(Request $request, $id)
    {
        $event = Event::find($id);
        if ($request->ajax()) {
            $event = Event::find($request->id)->id;
            $data = DB::table('event_user')->where('event_id', '=', $event)->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('full_name', function ($data) {
                    return User::find($data->user_id)->full_name;
                })
                ->addColumn('mobile', function ($data) {
                    return User::find($data->user_id)->mobile;
                })
                ->addColumn('email', function ($data) {
                    return User::find($data->user_id)->email;
                })->addColumn('email_verified', function ($data) {
                    $user =  User::find($data->user_id)->email_verified;
                    return ($user == 'true') ? '<div class="badge badge-light-success">'.trans("user.true").'</div>' : '<div class="badge badge-light-danger">'.trans("user.false").'</div>';

                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('forms.events.register', compact('event'));
    }

    public function sendMessage(Request $request)
    {
        $data = DB::table('event_user')->where('event_id', '=', $request->id)->get();
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'erorr' => $validator->errors()->toArray()]);
        } else {

            if ($request->ajax()) {

                $data = DB::table('event_user')->where('event_id', '=', $request->id)->get();
                if ($data->count() > 0) {
                    foreach ($data as $key => $value) {
                        if (!empty($value->user_id)) {
                            $details = $request->message;
                                $user = DB::table('users')->where('id',$value->user_id)->where('email_verified','==','ture')->get();
                                if ($user->isNotEmpty()){
                                    Mail::to($user[0]->email)->send(new MessageMail($details));
                                }
                        }
                    }
                    return response()->json(['status' => 1, 'msg' => 'Messages has been sent to all users']);
                } else {
                    return response()->json(['status' => 2, 'msg' => 'No users register in this event']);
                }
            }
        }

    }


}

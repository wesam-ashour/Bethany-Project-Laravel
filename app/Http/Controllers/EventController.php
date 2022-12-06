<?php

namespace App\Http\Controllers;

use App\Mail\MessageMail;
use App\Models\Admin;
use App\Models\Event;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:event-list|event-create|event-edit|event-delete', ['only' => ['index','show']]);
        $this->middleware('permission:event-create', ['only' => ['create','store']]);
        $this->middleware('permission:event-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:event-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->has('download')) {
            // dd(1);
            $pd = DB::table('event_user')->where('event_id', '=', $request->download)->get();

            if ($pd->isEmpty()) {
                toastr()->error('Oops! No users found!');
                return redirect()->back();
            } else {
                $pdf = Pdf::loadView('forms.events.pdf', compact('pd'));
                return $pdf->download('users.pdf');
            }

        }

        if ($request->ajax()) {
            $data = Event::select('id', 'title', 'date', 'added_by', 'status')->get();
            return DataTables::of($data)->addIndexColumn()

                ->addColumn('added_by', function ($data) {
                    return Admin::find($data->added_by)->name;
                })
                ->addColumn('status', function ($data) {
                    return ($data->status == 1) ? '<div class="badge badge-light-success">Active</div>' : '<div class="badge badge-light-danger">Not Active</div>';
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
                                  <a href="' . url('event/register/' . $data->id) . '"
                                     class="menu-link px-3">Register User</a>
                              </div>';
                    $action = $action . '<div class="menu-item px-3">
                                            <a href="' . route('events.show', $data->id) . '"
                                               class="menu-link px-3">show</a>
                                        </div>';
                    $action = $action . '<div  class="menu-item px-3">
                                        <a id="edit" data-id="' . $data->id . '" data-name="' . $data->title . '" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_event"
                                           class="menu-link px-3">edit</a>
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
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'date' => 'required|date_format:Y-m-d',
                'default_latitude' => 'required|numeric|max:255',
                'default_longitude' => 'required|numeric|max:255',
                'address' => 'required|string|max:255',
            ], [
//                'name.required' => trans("str.Name is required"),
            ]);
            if ($validator->passes()) {
                $data = new Event();
                $data->title = $request->title;
                $data->description = $request->description;
                $data->date = $request->date;
                $data->lat = $request->default_latitude;
                $data->long = $request->default_longitude;
                $data->address = $request->address;
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
                'title_u' => 'required|string|max:255',
                'description_u' => 'required|string|max:500',
                'date_u' => 'required|date_format:Y-m-d',
                'default_latitude_u' => 'required|numeric|max:255',
                'default_longitude_u' => 'required|numeric|max:255',
                'address_u' => 'required|string|max:255',
            ], [
//                'name.required' => trans("str.Name is required"),
            ]);
            if ($validator->passes()) {
                $data = Event::query()->find($request->event_id);
                $data->title = $request->title_u;
                $data->description = $request->description_u;
                $data->date = $request->date_u;
                $data->lat = $request->default_latitude_u;
                $data->long = $request->default_longitude_u;
                $data->address = $request->address_u;
                $data->updated_by = Auth::user()->id;
                $data->status = $request->status;
                $data->time = $request->time_u;

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
                ->addColumn('email', function ($data) {
                    return User::find($data->user_id)->email;
                })->addColumn('user_name', function ($data) {
                    return User::find($data->user_id)->user_name;
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
                            $user = User::find($value->user_id)->email;
                            Mail::to($user)->send(new MessageMail($details));
                        }
                    }
                    return response()->json(['status' => 1, 'msg' => 'Messages has been sent to all uesrs']);
                } else {
                    return response()->json(['status' => 2, 'msg' => 'No users register in this event']);
                }
            }
        }

    }


}

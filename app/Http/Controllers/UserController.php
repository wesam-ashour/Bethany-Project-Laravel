<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerified;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
//    function __construct()
//    {
//        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
//        $this->middleware('permission:user-create', ['only' => ['create','store']]);
//        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
//    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id','full_name','email','mobile','email_verified','address','user_name')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('user_name', function ($data) {
                    return ($data->email_verified == 'true') ? '<div class="badge badge-light-success">'.trans("user.true").'</div>' : '<div class="badge badge-light-danger">'.trans("user.false").'</div>';
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
									</span>'.trans("admin.Actions").'
                                  </button>
                                  <div class="dropdown-menu">';
//                    if (\auth()->user()->can('question-edit')) {
                        $action = $action . '<div  class="menu-item px-3">
                                        <a id="edit" data-id="' . $data->id . '" data-name="' . $data->full_name . '" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_user"
                                           class="menu-link px-3">' . trans("admin.edit") . '</a>
                                    </div>';
//                    }
//                    if (\auth()->user()->can('question-delete')) {
                        $action = $action . '<div id="delete" data-id="' . $data->id . '" data-name="' . $data->full_name . '" class="menu-item px-3" data-kt-docs-table-filter="delete_row">
                                        <a data-kt-docs-table-filter="delete_row"
                                           class="menu-link px-3">' . trans("admin.delete") . '</a>
                                    </div>';
//                    }

                    $action = $action . '</div></div></div>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }
        return view('forms.users.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|max:255|unique:users,email',
                'mobile' => 'required|numeric|unique:users,email',
                'address' => 'required|string',
                'events' => 'required|array'
            ], [
                'name.required' => trans("event.required"),
                'name.email' => trans("event.email"),
                'name.max' => trans("event.max"),

                'email.required' => trans("event.required"),
                'email.string' => trans("event.string"),
                'email.max' => trans("event.max"),
                'email.unique' => trans("event.unique"),

                'mobile.required' => trans("event.required"),
                'mobile.numeric' => trans("event.numeric"),
                'mobile.unique' => trans("event.unique"),

                'address.required' => trans("event.required"),
                'address.string' => trans("event.string"),

                'events.required' => trans("event.required"),
                'events.array' => trans("event.array"),

            ]);
            if ($validator->passes()) {
                $data = new User();
                $data->full_name = $request->name;
                $data->email = $request->email;
                $data->mobile = $request->mobile;
                $data->address = $request->address;
                $data->email_verified = "true";
                $data->save();

                foreach ($request->events as $event){
                    $userExists = DB::table('event_user')
                        ->where('user_id', $data->id)
                        ->where('event_id', $event)
                        ->exists();
                    if (!$userExists) {
                        $result = DB::table('event_user')->insert([
                            'user_id' => $data->id,
                            'event_id' => $event,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
                return response()->json(['success' => $data]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }
    }

    public function show(User $tourist)
    {
        //
    }

    public function edit(Request $request, User $user)
    {
        $selected = [];
        $user = User::find($user->id);
        $event_user_rows = DB::table('event_user')->where('user_id', $user->id)->get();
        foreach ($event_user_rows as $value) {
            $selected[] = $value->event_id;
        }
        return response()->json(['user' => $user, 'selected' => $selected]);
    }

    public function update(Request $request, User $user)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name_edit' => 'required|string',
                'email_edit' => 'required|email|max:255|unique:users,email,' . $user->id,
                'mobile_edit' => 'required|numeric|unique:users,email',
                'address_edit' => 'required|string',
                'events_edit' => 'required|array'
            ], [
                'name_edit.required' => trans("event.required"),
                'name_edit.email' => trans("event.email"),
                'name_edit.max' => trans("event.max"),

                'email_edit.required' => trans("event.required"),
                'email_edit.string' => trans("event.string"),
                'email_edit.max' => trans("event.max"),
                'email_edit.unique' => trans("event.unique"),

                'mobile_edit.required' => trans("event.required"),
                'mobile_edit.numeric' => trans("event.numeric"),
                'mobile_edit.unique' => trans("event.unique"),

                'address_edit.required' => trans("event.string"),
                'address_edit.string' => trans("event.string"),

                'events_edit.required' => trans("event.required"),
                'events_edit.array' => trans("event.array"),

            ]);
            if ($validator->passes()) {
                $data = User::find($user->id);
                $data->full_name = $request->name_edit;
                $data->email = $request->email_edit;
                $data->mobile = $request->mobile_edit;
                $data->address = $request->address_edit;
                $data->email_verified = "true";
                $data->save();

                $events = DB::table('event_user')
                    ->where('user_id', $data->id)
                    ->get();
                if ($events){
                    foreach ($events as $event){
                        DB::table('event_user')->where('id', $event->id)->delete();
                    }
                }

                if (!is_null($request->events_edit)) {
                    foreach ($request->events_edit as $event){

                        $userExists = DB::table('event_user')
                            ->where('user_id', $data->id)
                            ->where('event_id', $event)
                            ->exists();
                        if (!$userExists) {
                            $result = DB::table('event_user')->insert([
                                'user_id' => $data->id,
                                'event_id' => $event,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                }

                return response()->json(['success' => $data]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }
    }

    public function destroy(Request $request,User $user)
    {
        if ($request->ajax()) {
            $users = User::find($user->id)->delete();
            $events = DB::table('event_user')
                ->where('user_id', $user->id)
                ->get();
            if ($events){
                foreach ($events as $event){
                    DB::table('event_user')->where('id', $event->id)->delete();
                }
            }
            return response()->json(['success' => $events]);

        }
    }
}

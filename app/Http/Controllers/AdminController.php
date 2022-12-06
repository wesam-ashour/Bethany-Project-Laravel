<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Event;
use App\Models\Place;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $roles = Role::pluck('name', 'name')->all();

        if ($request->ajax()) {
            $data = Admin::query()->latest();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('roles', function ($data) {
                    if (count($data->getRoleNames()) > 0)
                        return '<div class="badge badge-light-primary">' . implode(', ', $data->roles->pluck('name')->toArray()) . '</div>';
                    else
                        return '<div class="text-center text-gray-600"><div>no roles</div></div>';

                })
                ->addColumn('status', function ($data) {
                    return ($data->status == 1) ? '<div class="badge badge-light-success">Active</div>' : '<div class="badge badge-light-danger">Not Active</div>';
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->diffForHumans();
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

                    $action = $action . '<div  class="menu-item px-3">
                                        <a href="' . route('admins.edit', $data->id) . '"
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
        return view('forms.admins.index', compact('roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:admins,email',
                'user_name' => 'required|unique:admins,user_name',
                'password' => 'required',
                'roles' => 'required'
            ], [
//                'name.required' => trans("str.Name is required"),
            ]);
            if ($validator->passes()) {
                $data = new Admin();
                $data->name = $request->name;
                $data->mobile = $request->mobile;
                $data->email = $request->email;
                $data->user_name = $request->user_name;
                $data->address = $request->address;
                $data->password = Hash::make($request->password);;
                $data->status = 1;
                $data->save();
                $data->assignRole($request->roles);

                return response()->json(['success' => $data]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }

    }

    public function show(Admin $admin)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $user = Admin::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('forms.admins.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
//            dd($request->input());
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:3|max:255',
                'mobile' => 'required|string|min:8|max:20',
                'user_name' => 'required|string|min:4|max:100',
                'address' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:admins,email,' . $request->id,
                'password' => $request->password != null ? 'sometimes|required|min:8' : '',
                'roles' => 'required'
            ], [
//                'name.required' => trans("str.Name is required"),
            ]);
            if ($validator->passes()) {
                $data = Admin::query()->find($request->id);

                $data->name = $request->name;
                $data->mobile = $request->mobile;
                $data->email = $request->email;
                $data->user_name = $request->user_name;
                $data->address = $request->address;
                if (!empty($request->password)) {
                    $data->password = Hash::make($request->password);;
                } else {
                    $input = Arr::except($request, array('password'));
                }
                $data->status = 1;

                if (!str_contains($request->image, env("APP_URL"))) {
                    $file = base64_decode($request['image']);
                    $folderName = '/images/admins/';
                    $safeName = uniqid() . '.' . 'png';
                    $destinationPath = public_path() . $folderName;
                    file_put_contents(public_path() . '/images/admins/' . $safeName, $file);
                    $data->image = $safeName;
                }

                $data->save();

                DB::table('model_has_roles')->where('model_id', $request->id)->delete();

                $data->assignRole($request->input('roles'));
                return response()->json(['success' => $data]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Admin::query()->find($id)->delete();
            return response()->json(['success' => "success"]);
        }
        return response()->json(['error' => "error"]);
    }

    public function dashboard(Request $request)
    {
        $events = Event::all();
        $d = [];
        $visit = Visit::orderBy('id', 'DESC')->get();
        foreach ($visit as $value) {
            $d[] = Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->year;

        }
        $dates = collect($d)->unique();
        if ($request->ajax()) {

            if (!$request->start) {

                $data2 = DB::table('visits')->select('id', 'created_at')->get()->groupBy(function ($data2) {
                    return Carbon::parse($data2->created_at)->format('M');
                });
                $months2 = [];
                $monthCount2 = [];
                foreach ($data2 as $month => $values) {
                    $months2[] = $month;
                    $monthCount2[] = count($values);
                }
                return response(['months2' => $months2, 'monthCount2' => $monthCount2]);
            }
            if ($request->start) {

                $startDate = $request->start;
                $data2 = Visit::whereYear('created_at', $startDate)->get()->groupBy(function ($data2) {
                    return Carbon::parse($data2->created_at)->format('M');
                });
                $months2 = [];
                $monthCount2 = [];
                foreach ($data2 as $month => $values) {
                    $months2[] = $month;
                    $monthCount2[] = count($values);
                }
                return response(['months2' => $months2, 'monthCount2' => $monthCount2]);
            }
        }
        if ($request->input('start')) {
            $startDate = $request->start;
            $endDate = $request->end;

            $data = DB::table('event_user')->select('id', 'event_id')->take(6)->get()->groupBy(function ($data) {
                return Event::find($data->event_id)->title;
            });

            $data2 = Visit::whereBetween('created_at', [$startDate, $endDate])->select('id', 'admin_id')->get()->groupBy(function ($data2) {
                return Admin::find($data2->admin_id)->full_name;
            });

            $months = [];
            $monthCount = [];
            foreach ($data as $month => $values) {
                $months[] = $month;
                $monthCount[] = count($values);
            }

            $months2 = [];
            $monthCount2 = [];
            foreach ($data2 as $month => $values) {
                $months2[] = $month;
                $monthCount2[] = count($values);
            }
            return view("dashboard", compact('events', 'months', 'monthCount', 'months2', 'monthCount2'));

        }
        if ($request->input('select')) {
            if (Auth::user()) {
                if (Auth::user()) {
                    $months = [];
                    $monthCount = [];
                    foreach ($request->select as $values) {
                        $data = DB::table('event_user')->select('id', 'event_id')->where('event_id', '=', $values)->get()->groupBy(function ($data) {
                            return Event::find($data->event_id)->title;
                        });
                        foreach ($data as $month => $values) {
                            $months[] = $month;
                            $monthCount[] = count($values);
                        }
                    }

                    $data2 = DB::table('visits')->select('id', 'created_at')->get()->groupBy(function ($data2) {
                        return Carbon::parse($data2->created_at)->format('M');
                    });
                    $months2 = [];
                    $monthCount2 = [];
                    foreach ($data2 as $month => $values) {
                        $months2[] = $month;
                        $monthCount2[] = count($values);
                    }

                    $data3 = DB::table('scanneds')->select('id', 'place_id')->get()->groupBy(function ($data3) {
                        return Place::find($data3->place_id)->title;
                    });
                    $months3 = [];
                    $monthCount3 = [];
                    foreach ($data3 as $month => $values) {
                        $months3[] = $month;
                        $monthCount3[] = count($values);
                    }

                    return view('dashboard', compact('events', 'months', 'monthCount', 'months2', 'monthCount2', 'months3', 'monthCount3', 'dates'));
                } else {
                    return redirect("/");
                }
            }
        }

        if (Auth::user()) {
            if (Auth::user()) {
                $data = DB::table('event_user')->select('id', 'event_id')->take(6)->get()->groupBy(function ($data) {
                    return Event::find($data->event_id)->title;
                });

                $data2 = DB::table('visits')->select('id', 'created_at')->get()->groupBy(function ($data2) {
                    return Carbon::parse($data2->created_at)->format('M');
                });

                $months = [];
                $monthCount = [];
                foreach ($data as $month => $values) {
                    $months[] = $month;
                    $monthCount[] = count($values);
                }

                $months2 = [];
                $monthCount2 = [];
                foreach ($data2 as $month => $values) {
                    $months2[] = $month;
                    $monthCount2[] = count($values);
                }

                $data3 = DB::table('scanneds')->select('id', 'place_id')->get()->groupBy(function ($data3) {
                    return Place::find($data3->place_id)->title;
                });
                $months3 = [];
                $monthCount3 = [];
                foreach ($data3 as $month => $values) {
                    $months3[] = $month;
                    $monthCount3[] = count($values);
                }
                return view('dashboard', compact('events', 'months', 'monthCount', 'months2', 'monthCount2', 'months3', 'monthCount3', 'dates'));

            }
        }
    }
}

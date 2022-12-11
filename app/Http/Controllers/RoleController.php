<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $permission = Permission::get();
        if ($request->ajax()) {
            $data = Role::query()->latest();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if ($data->id !== 1){
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

                    $action = $action . '<div  class="menu-item px-3">
                                        <a href="'. route('roles.edit', $data->id ) .'" class="menu-link px-3">'.trans("admin.edit").'</a>
                                    </div>';
                    $action = $action . '<div id="delete" data-id="' . $data->id . '" data-name="' . $data->title . '" class="menu-item px-3" data-kt-docs-table-filter="delete_row">
                                        <a data-kt-docs-table-filter="delete_row"
                                           class="menu-link px-3">'.trans("admin.delete").'</a>
                                    </div>';


                    $action = $action . '</div></div></div>';
                    return $action;
                    }
                })
                ->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }
        return view('forms.roles.index',compact('permission'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:roles,name',
                'permission' => 'required',
            ], [
                'name.required' => trans("role.required"),
                'name.max' => trans("role.max"),
                'name.unique' => trans("role.unique"),
                'permission.required' => trans("role.required"),
            ]);
            if ($validator->passes()) {

                $role = Role::create(['name' => $request->input('name')]);
                $role->syncPermissions($request->input('permission'));

                return response()->json(['success' => $role]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }

    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    public function edit(Request $request,$id)
    {
        $validate = Role::find($id)->id;
        if ($validate == 1){
            toastr()->error('Can not edit Admin role');
            return redirect()->back();

        }else{
            $role = Role::find($id);
            $permission = Permission::get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();
            return view('forms.roles.edit',compact('role','permission','rolePermissions'));
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $validator   = Validator::make($request->all(), [
            'name' => 'required',
            'permission' => 'required',
        ],[
            'name.required' => trans("role.required"),
            'permission.required' => trans("role.roleReq"),
        ]);
            if ($validator->passes()) {
                $role = Role::find($id);
                $role->name = $request->input('name');
                $role->save();

                $role->syncPermissions($request->input('permission'));
                return response()->json(['success' => $role]);
            }
        }
        return response()->json(['error' => $validator->errors()->toArray()]);
    }
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $validate = Role::find($id)->id;
            if ($validate == 1){
                return response()->json(['error' => "error"]);

            }else {
                DB::table("roles")->where('id', $id)->delete();
                return response()->json(['success' => "success"]);
            }
        }

    }


}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('full_name','email','mobile','email_verified','address','user_name')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('user_name', function ($data) {
                    return ($data->email_verified == 'true') ? '<div class="badge badge-light-success">'.trans("user.true").'</div>' : '<div class="badge badge-light-danger">'.trans("user.false").'</div>';
                })

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
        //
    }

    public function show(User $tourist)
    {
        //
    }

    public function edit(User $tourist)
    {
        //
    }

    public function update(Request $request, User $tourist)
    {
        //
    }

    public function destroy(User $tourist)
    {
        //
    }
}

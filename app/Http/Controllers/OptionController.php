<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class OptionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:option-list|option-create|option-edit|option-delete', ['only' => ['index','store']]);
        $this->middleware('permission:option-create', ['only' => ['create','store']]);
        $this->middleware('permission:option-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:option-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $options = Option::find(1);
        return view('forms.options.index',compact('options'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'foundation' => 'required|string|max:500',
                'history' => 'required|string|max:500',
                'fileupload' => 'sometimes',
            ], [
//                'name.required' => trans("str.Name is required"),
            ]);
            if ($validator->passes()) {
                $data = Option::query()->find(1);
                $data->foundation = $request->foundation;
                $data->history = $request->history;

                if ($request->input('fileupload') != 'undefined') {
                    $imageuploaded = request()->file('fileupload');
                    $imagename = time() . '.' . $imageuploaded->getClientOriginalExtension();
                    $imagepath = public_path('/images/main');
                    $imageuploaded->move($imagepath, $imagename);
                    $data->image = $imagename;
                }

                $data->save();
                return response()->json(['success' => $data]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }
    }

    public function show()
    {
        //
    }

    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $event = Option::find($id);
            return response()->json(['event' => $event]);
        }
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Option::query()->find(1)->delete();
            return response()->json(['success' => "success"]);
        }
        return response()->json(['error' => "error"]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:question-list|question-create|question-edit|question-delete', ['only' => ['index','store']]);
        $this->middleware('permission:question-create', ['only' => ['create','store']]);
        $this->middleware('permission:question-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:question-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::query()->latest();
            return DataTables::of($data)->addIndexColumn()
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
                                            <a id="show" data-id="' . $data->id . '" data-name="' . $data->title . '" data-bs-toggle="modal" data-bs-target="#kt_modal_show_event"
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
        return view('forms.faq.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'question' => 'required|string|min:5|max:255',
                'answer' => 'required|string|min:5|max:500',
            ], [
//                'name.required' => trans("str.Name is required"),
            ]);
            if ($validator->passes()) {
                $data = new Faq();
                $data->question = $request->question;
                $data->answer = $request->answer;

                $data->save();
                return response()->json(['success' => $data]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }
    }

    public function show(Request $request,$id)
    {
        if ($request->ajax()) {
            $question = Faq::find($id);
            return response()->json($question);
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $event = Faq::find($id);

            return response()->json(['event' => $event]);
        }
    }

    public function update(Request $request)
    {
        $data = Faq::query()->find($request->question_id);
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'question_u' => 'required|string|min:5|max:255',
                'answer_u' => 'required|string|min:5|max:500',
            ], [
//                'name.required' => trans("str.Name is required"),
            ]);
            if ($validator->passes()) {
                $data = Faq::query()->find($request->question_id);
                $data->question = $request->question_u;
                $data->answer = $request->answer_u;

                $data->save();
                return response()->json(['success' => $data]);
            }
            return response()->json(['error' => $validator->errors()->toArray()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Faq::query()->find($id)->delete();
            return response()->json(['success' => "success"]);
        }
        return response()->json(['error' => "error"]);
    }
}

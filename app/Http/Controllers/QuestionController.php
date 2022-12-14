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
                ->addColumn('question', function ($data) {
                    return $data->question;
                })
                ->addColumn('answer', function ($data) {
                    return $data->question;
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


                    $action = $action . '<div class="menu-item px-3">
                                            <a id="show" data-id="' . $data->id . '" data-name="' . $data->title . '" data-bs-toggle="modal" data-bs-target="#kt_modal_show_event"
                                               class="menu-link px-3">'.trans("place.Show").'</a>
                                        </div>';
                    if (\auth()->user()->can('question-edit')) {
                        $action = $action . '<div  class="menu-item px-3">
                                        <a id="edit" data-id="' . $data->id . '" data-name="' . $data->title . '" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_event"
                                           class="menu-link px-3">' . trans("admin.edit") . '</a>
                                    </div>';
                    }
                    if (\auth()->user()->can('question-delete')) {
                        $action = $action . '<div id="delete" data-id="' . $data->id . '" data-name="' . $data->title . '" class="menu-item px-3" data-kt-docs-table-filter="delete_row">
                                        <a data-kt-docs-table-filter="delete_row"
                                           class="menu-link px-3">' . trans("admin.delete") . '</a>
                                    </div>';
                    }

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
//            dd($request->input());
            $validator = Validator::make($request->all(), [
                'question_en' => 'required|string',
                'question_ar' => 'required|string',
                'answer_en' => 'required|string',
                'answer_ar' => 'required|string',
            ], [
                'question_en.required' => trans("faq.required"),
                'question_en.string' => trans("faq.string"),
                'question_en.max' => trans("faq.max"),

                'question_ar.required' => trans("faq.required"),
                'question_ar.string' => trans("faq.string"),
                'question_ar.max' => trans("faq.max"),

                'answer_en.required' => trans("faq.required"),
                'answer_en.string' => trans("faq.string"),
                'answer_en.max' => trans("faq.max"),

                'answer_ar.required' => trans("faq.required"),
                'answer_ar.string' => trans("faq.string"),
                'answer_ar.max' => trans("faq.max"),
            ]);
            if ($validator->passes()) {
                $data = new Faq();
                $data->question = ['en' => $request->question_en, 'ar' => $request->question_ar];
                $data->answer =  ['en' => $request->answer_en, 'ar' => $request->answer_ar];

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

        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'question_u_en' => 'required|string',
                'question_u_ar' => 'required|string',
                'answer_u_en' => 'required|string',
                'answer_u_ar' => 'required|string',
            ], [
                'question_u_en.required' => trans("faq.required"),
                'question_u_en.string' => trans("faq.string"),
                'question_u_en.max' => trans("faq.max"),

                'question_u_ar.required' => trans("faq.required"),
                'question_u_ar.string' => trans("faq.string"),
                'question_u_ar.max' => trans("faq.max"),

                'answer_u_en.required' => trans("faq.required"),
                'answer_u_en.string' => trans("faq.string"),
                'answer_u_en.max' => trans("faq.max"),

                'answer_u_ar.required' => trans("faq.required"),
                'answer_u_ar.string' => trans("faq.string"),
                'answer_u_ar.max' => trans("faq.max"),
            ]);
            if ($validator->passes()) {
                $data = Faq::query()->find($request->question_id);
                $data->question = ['en' => $request->question_u_en, 'ar' => $request->question_u_ar];
                $data->answer =  ['en' => $request->answer_u_en, 'ar' => $request->answer_u_ar];

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

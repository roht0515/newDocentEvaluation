<?php

namespace App\Http\Controllers;

use App\Category;
use App\Evaluation;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FormEvaluationRequest;
use DataTables;
use DateTime;
use Validator;
use DB;

class EvaluationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //obtener los datos
        if ($request->ajax()) {
            $data = Evaluation::latest()->get();
            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->id;
                    return $row;
                })
                ->make(true);
        }
        return view('admin.adminEvaluation.Evaluation.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormEvaluationRequest $request)
    {
        //
        if ($request->ajax()) {
            $evaluation = new Evaluation();
            //obetener los valors
            $evaluation->name = $request->name;
            $evaluation->version = $request->version;
            $evaluation->saveOrFail();
            return response()->json(["sucess" => 'Evaluacion Registrada']);
        }
    }
    public function get($id)
    {
        $evaluation = Evaluation::where('id', '=', $id)->first();
        $categories = Category::all();
        return view('admin.adminEvaluation.EvaluationCategory.list', compact('categories'))->with([
            'id' => $evaluation->id,
            'name' => $evaluation->name,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function listState(Request $request)
    {
        if ($request->ajax()) {
            $data = Evaluation::latest()->get();
            return DataTables::of($data)
                ->addColumn('State', function ($row) {
                    if ($row->state == false) {
                        $btn = '
                        <a href="' . route('evaluations.getState', ["id" => $row->id]) . '">
                        <button class="btn btn-info">Detalles</button>
                        </a>';
                    } else {
                        $btn = '<h5 class="text-success">Habilitado</h5>';
                    }
                    return $btn;
                })
                ->rawColumns(['State'])
                ->make(true);
        }
        return view('admin.adminActivate.Evaluations.list');
    }
    public function getEvaluationState($id)
    {
        $data = Evaluation::where('id', '=', $id)->first();
        return view('admin.adminActivate.Evaluations.option', compact('data'));
    }
    //obtener los datos
    public function getEvaluationsDates(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Evaluation::join('evaluationcategory', 'evaluation.id', '=', 'evaluationcategory.idEvaluation')
                ->join('category', 'evaluationcategory.idCategory', '=', 'category.id')
                ->join('question', 'category.id', '=', 'question.idCategory')
                ->select(['question.text', 'category.name'])
                ->where('evaluation.id', '=', $id);
            return DataTables::of($data)->make(true);
        }
    }
    //activar la evaluacion
    public function ChangeState(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $data = Evaluation::where('id', '=', $id)->first();
            $data->state = true;
            $data->saveOrFail();
            return response()->json(['success' => 'Evaluacion Habilitada']);
        }
        return view('admin.adminActivate.Evaluations.option');
    }
}

<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FormQuestionRequest;
use DataTables;
use DateTime;
use Validator;
use DB;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //
        if ($request->ajax()) {
            $data = Question::where('idCategory', '=', $id)->latest()->get();
            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->id;
                    return $row;
                })->make(true);
            return view('admin.adminEvaluation.Questions.list');
        }
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
    public function store(FormQuestionRequest $request)
    {
        //agregar nuevas preguntas
        if ($request->ajax()) {
            $question = new Question();
            $question->idCategory = $request->idCategory;
            $question->text = $request->text;
            $question->saveOrFail();

            return response()->json(['sucess' => 'Pregunta registrada']);
        }
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
    public function edit(Request $request)
    {
        //editar pregunta
        if ($request->ajax()) {
            $id = $request->id;
            $question = Question::find($id);
            $question->text = $request->text;
            $question->saveOrFail();
            return response()->json(["Pregunta Actualizada"]);
        }
    }
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $question = DB::table('question')->where('id', '=', $id)->first();
            return response()->json($question);
        }
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
        //eliminar
        $question = Question::find($id);
        $question->delete();
        return response()->json(['Success' => 'Pregunta Eliminada']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModuleStudent;
use App\Question;
use App\Student;
use App\evaluationstudentnotes;
use DB;

class EvaluationStudentNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
        if ($request->ajax()) {
            $question = Question::where('id', '=', $request->idQuestion)->first();
            $modulestudent = $request->idModuleStudent;
            $note = evaluationstudentnotes::where('idCategory', '=', $question->idCategory)
                ->where('idModuleStudent', '=', $modulestudent)->first();
            if ($note) {
                $score = $note->score;
                $score = $score + $request->scoreCategory;
                $note->score = $score;
                $note->update();
                return response()->json(['Success' => 'Se actualizo el puntaje']);
            } else {
                $data = new evaluationstudentnotes();
                $data->idCategory = $question->idCategory;
                $data->idModuleStudent = $modulestudent;
                $data->score = $request->scoreCategory;
                $data->save();
                return response()->json(['Success' => 'Se registro la respuesta']);
            }
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
}

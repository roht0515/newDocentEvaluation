<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\Evaluation;
use App\EvaluationStudent;
use DateTime;
use DataTables;

class EvaluationStudentController extends Controller
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
            $data = DB::table('question')
                ->join('category', 'question.idCategory', '=', 'category.id')
                ->join('evaluationcategory', 'evaluationcategory.idCategory', '=', 'category.id')
                ->join('evaluation', 'evaluationcategory.idEvaluation', '=', 'evaluation.id')
                ->join('evaluationmodule', 'evaluationmodule.idEvaluation', '=', 'evaluation.id')
                ->join('module', 'evaluationmodule.idModule', '=', 'module.id')
                ->join('modulestudent', 'module.id', '=', 'modulestudent.idModule')
                ->join('student', 'modulestudent.idStudent', '=', 'student.id')
                ->select(['question.text as pregunta'])
                ->where('student.id', '=', $id);
            return DataTables::of($data)
                ->make(true);
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
    public function store(Request $request)
    {
        //
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

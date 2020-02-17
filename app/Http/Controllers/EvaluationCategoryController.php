<?php

namespace App\Http\Controllers;

use App\Category;
use App\EvaluationCategory;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use DateTime;
use Validator;
use DB;

class EvaluationCategoryController extends Controller
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
            $data = DB::table('evaluationcategory')
                ->join('category', 'evaluationcategory.idCategory', '=', 'category.id')
                ->join('evaluation', 'evaluationcategory.idEvaluation', '=', 'evaluation.id')
                ->select(['category.name as nameCategory'])
                ->where('evaluationcategory.idEvaluation', '=', $id);
            return DataTables::of($data)
                ->make(true);
        }
    }
    public function listQuestion($id)
    {
        $data = Question::where('idCategory', '=', $id)->get();
        return response()->json($data);
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
            $evaluationcategory = new EvaluationCategory();
            $evaluationcategory->idEvaluation = $request->idEvaluation;
            $evaluationcategory->idCategory = $request->idCategory;
            $evaluationcategory->saveOrFail();
            return response()->json(['success', 'Se asigno correctamente la categoria']);
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

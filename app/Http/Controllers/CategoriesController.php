<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use DateTime;
use Validator;
use DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->id;
                    return $row;
                })
                ->make(true);
        }
        return view('admin.adminEvaluation.Categories.list');
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
        //agregar una nueva categoria
        $now = new DateTime();
        if ($request->ajax()) {
            $category = new Category();
            //pedir los datos
            $category->name = $request->name;
            $category->year = $now;
            $category->saveOrFail();
            return response()->json(['sucess' => 'Categoria Creada']);
        }
    }
    public function get($id)
    {
        //agregar preguntas a la categoria
        $category = DB::table('category')->where('id', '=', $id)->first();
        return view('admin.adminEvaluation.Questions.list')->with([
            'id' => $category->id,
            'name' => $category->name
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
}

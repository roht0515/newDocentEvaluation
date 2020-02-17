<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;


class ModuleController extends Controller
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

    public function createModule(Request $request){

        if ($request->ajax()) {
         dd($request->all());


         $moduleData = $request->moduleData;

        $module = new Module;
        $module->idProfessor = $moduleData["docente"];
        $module->idDiplomat = $moduleData["diplomat"];
        $module->name = $moduleData["moduleName"];
        $module->number = $moduleData["moduleNumber"];
        $module->turn = $moduleData["turn"];
        $module->startDate = $moduleData["startDate"];
        $module->endDate = $moduleData["endDate"];
        $module->saveOrFail();
         return response()->json(['sucess' => 'Pregunta registrada']);
        }
     
    }
}

<?php

namespace App\Http\Controllers;

use App\Diplomat;
use App\Student;
use App\DiplomatStudent;
use App\Module;
use DB;
use DateTime;
use Validator;
use Illuminate\Http\Request;

class DiplomatStudentController extends Controller
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
    public function store(Request $request, $idModule)
    {
        //
        if ($request->ajax()) {
            $id = Module::where('id', '=', $idModule)->first();
            $diplomatstudent = new DiplomatStudent();
            $diplomatstudent->idDiplomat = $id->idDiplomat;
            $diplomatstudent->idStudent = $request->idStudent;
            $diplomatstudent->saveOrFail();
            return response()->json(['success' => 'Estudiante registrado en el Diplomado']);
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

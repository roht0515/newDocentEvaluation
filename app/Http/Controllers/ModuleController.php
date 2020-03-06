<?php

namespace App\Http\Controllers;

use App\Module;
use App\Diplomat;
use App\EvaluationDiplomat;
use App\EvaluationStudent;
use App\Student;
use App\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FormDiplomatModuleRequest;
use DataTables;
use DateTime;
use Validator;
use DB;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listModuleDate(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('professor')
                ->join('module', 'professor.id', '=', 'module.idProfessor')
                ->join('diplomat', 'module.idDiplomat', '=', 'diplomat.id')
                ->select([DB::raw('CONCAT(professor.name," ",professor.lastname) as fullname'), 'diplomat.name as nameDiplomat', 'module.name as nameModule', 'module.number as nroModule', 'module.group as group', 'module.classroomNumber as classRoom', 'module.startDate as startDate'])
                ->where('module.idDiplomat', '=', $id)
                ->get();
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

    public function createModule(FormDiplomatModuleRequest $request)
    {
        if ($request->ajax()) {

            $id = EvaluationDiplomat::where('idDiplomat', '=', $request->idDiplomat)->first();
            $module = new Module();
            $module->idProfessor = $request->professor;
            $module->idDiplomat = $id->id;
            $module->name = $request->name;
            $module->number = $request->number;
            //fechas del modulo
            $module->startDate = $request->startDateModule;
            $module->endDate = $request->endDateModule;
            //fechas de evaluacion
            $module->startDateEvaluation = $request->startDateEvaluation;
            $module->endDateEvaluation = $request->endDateEvaluation;
            $module->group = $request->group;
            $module->classroomNumber = $request->classroom;
            $module->saveOrFail();
            return response()->json(['sucess' => 'Modulo Registrado']);
        }
    }
}

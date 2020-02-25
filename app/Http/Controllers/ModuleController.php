<?php

namespace App\Http\Controllers;

use App\Module;
use App\Diplomat;
use App\EvaluationModule;
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
    public function index()
    {
        //
        $students = Student::all();
        return view('admin.adminEvaluation.Module.listmd', compact('students'));
    }
    public function listDiplomat(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('module')->join('diplomat', 'module.idDiplomat', '=', 'diplomat.id')
                ->select(['module.id', 'module.number', 'module.name', 'diplomat.name as nameD', 'module.startDate'])
                ->get();
            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->id;
                    return $row;
                })
                ->make(true);
        }
    }
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
            $evaluationmodule = new EvaluationModule();
            $module = new Module();
            $module->idProfessor = $request->professor;
            $module->idDiplomat = $request->idDiplomat;
            $module->name = $request->name;
            $module->number = $request->number;
            $module->startDate = $request->startDateModule;
            $module->endDate = $request->endDateModule;
            $module->group = $request->group;
            $module->classroomNumber = $request->classroom;
            $module->saveOrFail();

            $data = Module::all();
            $idmodule = $data->last()->id;
            $evaluationmodule->idModule = $idmodule;
            $evaluationmodule->idEvaluation = $request->evaluation;
            $evaluationmodule->startDate = $request->startDateEvaluation;
            $evaluationmodule->endDate = $request->endDateEvaluation;
            $evaluationmodule->saveOrFail();

            return response()->json(['sucess' => 'Modulo Registrado']);
        }
    }
}

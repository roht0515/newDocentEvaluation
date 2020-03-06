<?php

namespace App\Http\Controllers;

use App\EvaluationModule;
use Illuminate\Http\Request;
use App\Student;
use App\Module;
use App\ModuleStudent;
use App\EvaluationStudent;
use Carbon\Carbon;
use DataTables;
use DB;
use Validator;

class ModuleStudentController extends Controller
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
    public function list(Request $request)
    {
        if ($request->ajax()) {

            $data = Module::join('evaluationdiplomat', 'module.idDiplomat', '=', 'evaluationdiplomat.id')
                ->join('diplomat', 'evaluationdiplomat.idDiplomat', '=', 'diplomat.id')
                ->select(['module.number', 'module.name', 'diplomat.name as nameDiplomat', 'module.startDate', 'module.id']);
            return DataTables::of($data)
                ->addColumn('RegisterStudent', function ($row) {
                    $btn = '<a href="' . route('moduleStudent.listStudent', ["id" => $row->id]) . '"><button class="btn btn-success">Registrar Estudiantes</button></a>';
                    return $btn;
                })
                ->addColumn('BtnReport', function ($row) {
                    $btn = '<a href="' . route('modules.report', ["id" => $row->id]) . '">
                    <button  class="btn btn-success">Generar Reporte</button>
                    </a>';
                    return $btn;
                })
                ->rawColumns(['RegisterStudent', 'BtnReport'])
                ->make(true);
        }
        //mostrar la vista
        return view('admin.adminEvaluation.ModuleStudent.list');
    }
    public function getModule($id)
    {
        //estudiantes
        $students = Student::all();
        //datos del modulo
        $dataM = Module::where('id', '=', $id)->first();
        return view('admin.adminEvaluation.ModuleStudent.register', compact('dataM', 'students'));
    }
    public function listModuleStudent(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = ModuleStudent::join('student', 'modulestudent.idStudent', '=', 'student.id')
                ->select(['student.ci', DB::raw('CONCAT(student.name," ",student.lastname) as fullname'), 'modulestudent.registerDate'])
                ->where('modulestudent.idModule', '=', $id)->get();
            return DataTables::of($data)->make(true);
        }
    }
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $now = new Carbon();
            $data = ModuleStudent::where('idModule', '=', $request->idModule)
                ->where('idStudent', '=', $request->idStudent)
                ->first();
            if ($data == null) {
                //registrar el estudiante al modulo
                $moduleStudent = new ModuleStudent();
                $moduleStudent->idModule = $request->idModule;
                $moduleStudent->idStudent = $request->idStudent;
                $moduleStudent->registerDate = $now;
                $moduleStudent->saveOrFail();
                //registrar al estudiante para la evaluacion
                $id = ModuleStudent::all();
                $id = $id->last()->id;
                $evaluationstudent = new EvaluationStudent();
                $evaluationstudent->idModuleStudent = $id;
                $evaluationstudent->saveOrFail();
                return response()->json(['success' => 'Se registro el Estudiante']);
            } else {
                return response()->json(['error' => 'El estudiante ya fue registrado']);
            }
        }
    }
    //funcion para generar el reporte
    public function generateReport($id)
    {
        /*
        Notas de cada categoria
        nombre del diplomado
        nombre del modulo
        nombre del docente
        fecha de inicio
        fecha final
        nota del modulo
        */
        $data = ModuleStudent::where('idModuleStudent', '=', $id)->first();
        $pdf = \PDF::loadview('admin.adminEvaluation.Reports.module', compact('data'));
        return $pdf->download('module.pdf');
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

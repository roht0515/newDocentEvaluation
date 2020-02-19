<?php

namespace App\Http\Controllers;

use App\Module;
use App\Diplomat;
use App\Student;
use App\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                ->select([DB::raw('CONCAT(professor.name," ",professor.lastname) as fullname'), 'diplomat.name as nameDiplomat', 'module.name as nameModule', 'module.number', 'module.group', 'module.classroomNumber', 'module.turn', 'module.startDate'])
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

    public function createModule(Request $request)
    {

        if ($request->ajax()) {
            //  dd($request->all());


            $moduleData = $request->moduleData;

            $module = new Module;
            $module->idProfessor = $moduleData["docente"];
            $module->idDiplomat = $moduleData["diplomat"];
            $module->name = $moduleData["moduleName"];
            $module->number = $moduleData["moduleNumber"];
            $module->turn = $moduleData["turn"];
            $module->startDate = $moduleData["startDate"];
            $module->endDate = $moduleData["endDate"];
            $module->group = $moduleData["group"];
            $module->classroomNumber = $moduleData["classroomNumber"];
            $turn = $moduleData["turn"];
            if ($turn == "mañana") {
                $module->startTime = "08:45:00";
                $module->endTime =  "12:15:00";
            } else if ($turn == "tarde") {
                $module->startTime = '15:15:00';
                $module->endTime = '18:15:00';
            } else if ($turn == "noche") {
                $module->startTime = '19:00:00';
                $module->endTime = '22:00:00';
            }
            $module->saveOrFail();
            return response()->json(['sucess' => 'Modulo Registrado']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Module;
<<<<<<< HEAD
use App\EvaluationModule;

=======
use App\Diplomat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use DateTime;
use Validator;
use DB;
use PhpParser\Node\Expr\AssignOp\Mod;
>>>>>>> dbeba083165d6308188e904e8fee61b7015457de

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        //
        return view('admin.adminEvaluation.Module.listmd');
    }
    public function listDiplomat(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('module')->join('diplomat', 'module.idDiplomat', '=', 'diplomat.id')
                ->select(['module.number', 'module.name', 'diplomat.name as nameD', 'module.startDate', 'diplomat.id as idD', 'module.id as idM']);
            return DataTables::of($data)
                ->addColumn('DT_RowIdDiplomat', function ($row) {
                    $row = $row->idD;
                    return $row;
                })
                ->addColumn('DT_RowIdModule', function ($row) {
                    $row = $row->idM;
                    return $row;
                })
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

<<<<<<< HEAD
        $module = new Module;
        $evaluationModule = new EvaluationModule;
        $module->idProfessor = $moduleData["docente"];
        $module->idDiplomat = $moduleData["diplomat"];
        $module->name = $moduleData["moduleName"];
        $module->number = $moduleData["moduleNumber"];
        $module->turn = $moduleData["turn"];
        $module->startDate = $moduleData["startDate"];
        $module->endDate = $moduleData["endDate"];
        $turn =$moduleData["turn"];
        if($turn =="mañana")
        {
            $module->startTime ="08:45:00";
            $module->endTime =  "12:15:00";
        }
        else if($turn =="tarde")
        {
            $module->startTime ='15:15:00';
            $module->endTime ='18:15:00';
        }
        else if($turn =="noche"){
            $module->startTime = '19:00:00';
            $module->endTime ='22:00:00';
        }
        $module->saveOrFail();


        $modules= Module::all();
        $modules =$modules->last()->id;
        $evaluationModule->idEvaluation = $moduleData['evaluation'];     
        $evaluationModule->idModule = $modules;
        $evaluationModule->saveOrFail();
        
         return response()->json(['sucess' => 'modulo registrado']);
=======
            $module = new Module;
            $module->idProfessor = $moduleData["docente"];
            $module->idDiplomat = $moduleData["diplomat"];
            $module->name = $moduleData["moduleName"];
            $module->number = $moduleData["moduleNumber"];
            $module->turn = $moduleData["turn"];
            $module->startDate = $moduleData["startDate"];
            $module->endDate = $moduleData["endDate"];
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
            return response()->json(['sucess' => 'Pregunta registrada']);
>>>>>>> dbeba083165d6308188e904e8fee61b7015457de
        }
    }
}

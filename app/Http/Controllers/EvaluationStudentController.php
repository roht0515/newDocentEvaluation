<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Evaluation;
use App\EvaluationStudent;
use App\EvaluationModule;
use App\evaluationstudentnotes;
use App\Module;
use App\ModuleStudent;
use App\Question;
use DateTime;
use DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class EvaluationStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //mostrar los modulos de los estudiantes

    }
    public function listModule(Request $request, $id)
    {
        if ($request->ajax()) {
            $student = Student::where('idUser', '=', $id)->first();
            $data = ModuleStudent::join('module', 'modulestudent.idModule', '=', 'module.id')
                ->join('evaluationstudent', 'modulestudent.id', '=', 'evaluationstudent.idModuleStudent')
                ->join('evaluationdiplomat', 'module.idDiplomat', '=', 'evaluationdiplomat.id')
                ->join('diplomat', 'evaluationdiplomat.id', '=', 'diplomat.id')
                ->select(['module.number', 'module.name', 'diplomat.name as nameDiplomat', 'module.startDateEvaluation', 'module.endDateEvaluation', 'evaluationstudent.resolved', 'evaluationdiplomat.idEvaluation'])
                ->where('modulestudent.idStudent', '=', $student->id);
            return DataTables::of($data)
                ->addColumn('buttons', function ($row) {
                    $now = Carbon::now();
                    $now = $now->toDateString();
                    if ($now >= $row->startDateEvaluation && $now <= $row->endDateEvaluation && $row->resolved == false) {
                        $row = '<a href="' . route('student.getEvaluation', ["id" => $row->idEvaluation]) . '"><button name="BH" type="button" class="btn btn-success" value="1">
                        Habilitado
                        </button></a>';
                    } else if ($row->resolved == true) {
                        $row = '<button type="button" class="btn btn-info disabled">Calificado</button>';
                    } else {
                        $row = '<button name="BHN" type="button" class="btn btn-danger disabled" value="1">No Habilitado</button>';
                    }
                    return $row;
                })
                ->rawColumns(['buttons'])
                ->make(true);
        }
        return view('Student.list');
    }
    //obtener obtener los datos de la evaluacion
    public function getEvaluation($id)
    {
        $questioncount = Question::join('category', 'question.idCategory', '=', 'category.id')
            ->join('evaluationcategory', 'category.id', '=', 'evaluationcategory.idCategory')
            ->join('evaluation', 'evaluationcategory.idEvaluation', '=', 'evaluation.id')
            ->join('evaluationdiplomat', 'evaluation.id', '=', 'evaluationdiplomat.idEvaluation')
            ->distinct('question.text')->count('question.text');


        $evaluation = Evaluation::join('evaluationdiplomat', 'evaluation.id', '=', 'evaluationdiplomat.idEvaluation')
            ->join('module', 'evaluationdiplomat.id', '=', 'module.idDiplomat')
            ->join('modulestudent', 'module.id', '=', 'modulestudent.idModule')
            ->select(['evaluation.id as idE', 'modulestudent.id as idMS', 'module.name as ModuleName'])
            ->where('evaluation.id', '=', $id)
            ->first();
        return view('Student.evaluation', compact('evaluation', 'questioncount'));
    }
    public function listQuestions(Request $request, $id)
    {
        if ($request->ajax()) {
            $evaluation = Evaluation::where('id', '=', $id)->first();
            $data = Question::join('category', 'question.idCategory', '=', 'category.id')
                ->join('evaluationcategory', 'category.id', '=', 'evaluationcategory.idCategory')
                ->join('evaluation', 'evaluationcategory.idEvaluation', '=', 'evaluation.id')
                ->join('evaluationdiplomat', 'evaluation.id', '=', 'evaluationdiplomat.idEvaluation')
                ->join('diplomat', 'evaluationdiplomat.idDiplomat', '=', 'diplomat.id')
                ->join('module', 'evaluationdiplomat.id', '=', 'module.idDiplomat')
                ->select(['question.text', 'question.id as idQ', 'question.idCategory as idC'])
                ->where('evaluation.id', '=', $evaluation->id)
                ->orderBy('idC', 'asc');
            return DataTables::of($data)
                ->addColumn('nunca', function ($row) {
                    $radio = '
                    <input class="require" form="formEvaluationStudent"  type="radio" name="' . $row->idQ . '" value="1" required>
                    ';
                    return $radio;
                })
                ->addColumn('poco', function ($row) {
                    $radio = '
                    <input class="require" form="formEvaluationStudent"  type="radio" name="' . $row->idQ . '" value="2" required>
                    ';
                    return $radio;
                })
                ->addColumn('regular', function ($row) {
                    $radio = '
                   
                    <input class="require" form="formEvaluationStudent"" type="radio" name="' . $row->idQ . '" value="3" required>
                    ';
                    return $radio;
                })
                ->addColumn('general', function ($row) {
                    $radio = '
                    <input class="require" form="formEvaluationStudent"  type="radio" name="' . $row->idQ . '" value="4" required>
                    ';
                    return $radio;
                })
                ->addColumn('siempre', function ($row) {
                    $radio = '
                    <input class="require" form="formEvaluationStudent"  type="radio" name="' . $row->idQ . '" value="5" required>
                    ';
                    return $radio;
                })
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->idQ;
                    return $row;
                })
                ->rawColumns(['nunca', 'poco', 'regular', 'general', 'siempre'])
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
        //registrar el total de la nota de la evaluacion
        if ($request->ajax()) {
            $now = new Carbon();
            $now = $now->toDateString();
            $evaluation = EvaluationStudent::where('idModuleStudent', '=', $request->idModuleStudent)->first();
            $evaluation->score = $request->score;
            $evaluation->resolved = true;
            $evaluation->dateResolved = $now;
            $evaluation->SaveorFail();
            //actualizar la nota del modulo
            $module = ModuleStudent::where('id', '=', $request->idModuleStudent);
            $data = Module::where('id', '=', $module->idModule);
            $score = $data->score;
            $score = $score + $request->score;
            $data->score = $score;
            $data->update();
            return response()->json(['success' => 'Evaluacion Terminada']);
        }
    }
    public function storeNotes(Request $request)
    {
        if ($request->ajax()) {
            $count = Question::Where();
            $evsn = new evaluationstudentnotes();
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

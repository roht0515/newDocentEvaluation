<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Evaluation;
use App\EvaluationStudent;
use App\EvaluationModule;
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
            $data = Student::join('modulestudent', 'student.id', '=', 'modulestudent.idStudent')
                ->join('module', 'modulestudent.idModule', '=', 'module.id')
                ->join('diplomat', 'module.idDiplomat', '=', 'diplomat.id')
                ->join('evaluationmodule', 'module.id', '=', 'evaluationmodule.idModule')
                ->join('evaluationstudent', 'evaluationmodule.id', '=', 'evaluationstudent.idEvaluationModule')
                ->join('evaluation', 'evaluationmodule.idEvaluation', '=', 'evaluation.id')
                ->select(['module.number', 'module.name as moduleName', 'diplomat.name as diplomatName', 'evaluationmodule.startDate as startDateEvaluation', 'evaluationmodule.endDate as endDateEvaluation', 'evaluation.id as idE', 'evaluationstudent.resolved'])
                ->where('student.id', '=', $student->id)
                ->get();
            return DataTables::of($data)
                ->addColumn('buttons', function ($row) {
                    $now = Carbon::now();
                    $now = $now->toDateString();
                    if ($now >= $row->startDateEvaluation && $now <= $row->endDateEvaluation && $row->resolved == false) {
                        $row = '<a href="' . route('student.getEvaluation', ["id" => $row->idE]) . '"><button name="BH" type="button" class="btn btn-success" value="1">
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
    public function getEvaluation($id)
    {
        $count = Question::count();
        $evaluation = Evaluation::join('evaluationmodule', 'evaluation.id', '=', 'evaluationmodule.idEvaluation')
            ->join('module', 'evaluationmodule.idModule', '=', 'module.id')
            ->join('evaluationstudent', 'evaluationmodule.id', '=', 'evaluationstudent.idEvaluationModule')
            ->join('student', 'evaluationstudent.idStudent', '=', 'student.id')
            ->select(['student.id as idS', 'evaluation.id', 'evaluationmodule.id as idEM', 'module.name as ModuleName'])
            ->where('evaluation.id', '=', $id)->first();
        return view('Student.evaluation', compact('evaluation', 'count'));
    }
    public function listQuestions(Request $request, $id)
    {
        if ($request->ajax()) {
            $evaluation = Evaluation::where('id', '=', $id)->first();
            $data = Evaluation::join('evaluationcategory', 'evaluation.id', '=', 'evaluationcategory.idEvaluation')
                ->join('category', 'evaluationcategory.idCategory', '=', 'category.id')
                ->join('question', 'category.id', '=', 'question.idCategory')
                ->select(['question.text', 'evaluation.id', 'question.id as idQ', 'question.idCategory'])
                ->where('evaluation.id', '=', $evaluation->id)
                ->get();
            return DataTables::of($data)
                ->addColumn('p1', function ($row) {
                    $radio = '
                    <div class="form-check">
                    <input form="formEvaluationStudent"  type="radio" name="question' . $row->idQ . '" value="1" required>
                  </div>
                    ';
                    return $radio;
                })
                ->addColumn('p2', function ($row) {
                    $radio = '
                    <div class="form-check">
                    <input form="formEvaluationStudent"  type="radio" name="question' . $row->idQ . '" value="2" required>
                  </div>
                    ';
                    return $radio;
                })
                ->addColumn('p3', function ($row) {
                    $radio = '
                    <div class="form-check">
                    <input form="formEvaluationStudent"" type="radio" name="question' . $row->idQ . '" value="3" required>
                  </div>
                    ';
                    return $radio;
                })
                ->addColumn('p4', function ($row) {
                    $radio = '
                    <div class="form-check">
                    <input form="formEvaluationStudent"  type="radio" name="question' . $row->idQ . '" value="4" required>
                  </div>
                    ';
                    return $radio;
                })
                ->addColumn('p5', function ($row) {
                    $radio = '
                    <div class="form-check">
                    <input form="formEvaluationStudent"  type="radio" name="question' . $row->idQ . '" value="5" required>
                  </div>
                    ';
                    return $radio;
                })
                ->rawColumns(['p1', 'p2', 'p3', 'p4', 'p5'])
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
        if ($request->ajax()) {
            $now = new DateTime();
            $evaluation = EvaluationStudent::where(
                'idEvaluationModule',
                '=',
                $request->idEvaluationM,
                'and',
                'idStudent',
                '=',
                $request->idStudent
            )->first();
            $evaluation->score = $request->score;
            $evaluation->resolved = true;
            $evaluation->dateResolved = $now;
            $evaluation->SaveorFail();
            return response()->json(['success' => 'Evaluacion Terminada']);
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

<?php

namespace App\Http\Controllers;

use App\Diplomat;
use App\Professor;
use App\Evaluation;
use App\EvaluationDiplomat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FormDiplomatRequest;
use DataTables;
use DB;

class DiplomatsController extends Controller
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
            $data = Diplomat::latest()->get();
            return DataTables::of($data)
                ->addColumn('BtnModule', function ($row) {
                    $btn = '<a href="' . route('diplomats.get', ["id" => $row->id]) . '">
                            <button class="btn btn-success">Registrar Modulos</button>
                            </a>';
                    return $btn;
                })
                ->rawColumns(['BtnModule'])
                ->make(true);
        }
        $evaluations = Evaluation::where('state', '=', true)->get();
        return view('admin.adminEvaluation.Diplomats.list', compact('evaluations'));
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
    public function store(FormDiplomatRequest $request)
    {
        //agregar datos
        if ($request->ajax()) {
            //registrar el diplomado
            $diplomat = new Diplomat();
            $diplomat->name = $request->name;
            $diplomat->version = $request->version;
            $diplomat->startDate = $request->startDate;
            $diplomat->saveOrFail();
            //registrar el evaluationdiplomat
            $id = Diplomat::all();
            $id = $id->last()->id;
            $evaluationdiplomat = new EvaluationDiplomat();
            $evaluationdiplomat->idDiplomat = $id;
            $evaluationdiplomat->idEvaluation = $request->evaluation;
            $evaluationdiplomat->saveOrFail();
            return response()->json(['sucess' => 'Diplomado Registrado']);
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

    public function createModel()
    { }

    public function get($id)
    {

        $diplomats = Diplomat::all();
        $professors = Professor::all();
        $evaluations = Evaluation::all();
        $category = DB::table('diplomat')->where('id', '=', $id)->first();
        return view('admin.adminEvaluation.Module.list', compact('diplomats', 'professors', 'evaluations'))->with([
            'id' => $category->id,
            'name' => $category->name
        ]);
    }
}

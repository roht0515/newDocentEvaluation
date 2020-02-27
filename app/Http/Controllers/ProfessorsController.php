<?php

namespace App\Http\Controllers;

use App\Professor;
use App\User;
use App\EvaluationStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FormDocentEvaluation;
use App\Module;
use DataTables;
use DateTime;
use DB;
use Illuminate\Support\Carbon;
use SebastianBergmann\Environment\Console;

class ProfessorsController extends Controller
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
            $data = Professor::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $row = '<a class="btn" id="' . $row->id . '">Detalles</a>';
                    return $row;
                })
                ->make(true);
        }
        return view('admin.adminEvaluation.Professors.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.adminEvaluation.Professors.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormDocentEvaluation $request)
    {
        //
        if ($request->ajax()) {
            $now = new DateTime();
            $user = new User();
            //guardar el usuario
            $pos = strpos($request->name, " "); //obtener si existe un espacio y obtener la posicion de ese espacio
            if ($pos != 0) {
                $username = substr($request->name, 0, $pos) . strtoupper(substr($request->lastname, 0, 1)); //obteneer la primera letra de su apellido
            } else {
                $username = $request->name . strtoupper(substr($request->lastname, 0, 1)); // si no tiene mas de dos nombres
            }
            $password = strtoupper(substr($request->name, 0, 1)) . substr(strval($request->ci), 0, 3) . substr($request->lastname, 0, 2); //crear contraseña
            $user->username = $username;
            $user->password = Hash::make($password);
            $user->role = 'Professor';
            $user->email = $request->email;
            $user->email_verified_at = $now;
            $user->saveOrFail();
            //obtener el ultimo id
            $data = User::all();
            $data = $data->last()->id;
            //llenar la tabla
            $professor = new Professor();
            $professor->idUser = $data;
            $professor->ci = $request->ci;
            $professor->name = $request->name;
            $professor->lastname = $request->lastname;
            $professor->email = $request->email;
            $professor->phone = $request->phone;
            $professor->address = $request->address;
            $professor->startDate = $request->startDate;
            $professor->career = $request->career;
            $professor->turn = $request->turn;
            $professor->saveOrFail();

            return response()->json(['sucess' => 'Docente registrado correctamente']);
        }
        return view('admin.adminEvaluation.Professors.list');
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
    //Funciones para Professor
    public function indexProfessor()
    {
        return view('Professor.index');
    }
    public function studentsList()
    {

        return view('Professor.list');
    }
    public function studentsHistory()
    {
        return view('Professor.studentsList');
    }

    public function studentsEvaluation(Request $request,$id)
    {     
        $ProfessorModule = Professor::where('idUser',$id)->first();
        $idProfessor = $ProfessorModule->id; 
        $module = Module::where('idProfessor',$idProfessor)->first();
        $idModuleStudent = $module->id;
        $contador=0;
        if ($request->ajax()) {
          
            $now = Carbon::now();
            
            $now = $now->toDateString();
            $data = DB::table('modulestudent')
                ->join('student', 'student.id','=','modulestudent.idStudent')
                ->join('module','module.id','=','modulestudent.idModule')    
                ->join('evaluationstudent','evaluationstudent.idStudent','=','student.id')
                ->join('evaluationmodule','evaluationmodule.id','=','evaluationstudent.idEvaluationModule')                      
                ->select([DB::raw('CONCAT(student.name," ",student.lastname) as fullname'),'modulestudent.id as module', 'evaluationstudent.resolved as resolved' ])   
                ->where('modulestudent.idModule','=',$idModuleStudent)
                ->where('module.startDate','<=',$now,'&&','module.endDate','>=',$now)
                
                ->get();
            return DataTables::of($data)
            ->addColumn('buttons', function ($row) {
               
                if($row->resolved == true)
                {
                    $row = '<button type="button" class="btn btn-success disabled"><i class="fas fa-check-circle"></i> Calificado</button>';
                }else{
                    $row = '<button type="button" class="btn btn-danger disabled"><i class="fas fa-times-circle"></i> Pendiente</button>';
                }
                return $row;
            })
            ->addColumn('contador', function(){
                global $contador;
                $contador++;
                return $contador;
                
            })
                ->rawColumns(['contador'])
                ->rawColumns(['buttons'])
                ->make(true);
        }
    }
}

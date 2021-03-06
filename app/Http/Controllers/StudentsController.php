<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FormStudentRequest;
use DataTables;
use DateTime;
use Validator;
use DB;

class StudentsController extends Controller
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
            $data = Student::latest()->get();
            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->id;
                    return $row;
                })
                ->make(true);
        }
        return view('admin.adminEvaluation.Students.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mandar a la vista de registro
        return view('admin.adminEvaluation.Students.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormStudentRequest $request)
    {
        //registrar estudiante
        $now = new DateTime();
        if ($request->ajax()) {
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
            $user->role = 'Student';
            $user->email = $request->email;
            $user->email_verified_at = $now;
            $user->saveOrFail();
            //obtener el ultimo id
            $data = User::all();
            $data = $data->last()->id;
            //llenar la tabla
            $student = new Student();
            $student->idUser = $data;
            $student->ci = $request->ci;
            $student->name = $request->name;
            $student->lastname = $request->lastname;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->registrationDate = $now;
            $student->career = $request->career;
            $student->turn = $request->turn;
            $student->saveOrFail();

            return response()->json(['sucess' => 'Professor creado']);
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
    //VISTA PARA ESTUDAINTES
    public function indexStudent()
    {
        return view('Student.index');
    }
    public function showEvaluation()
    {
        return view('Student.list');
    }
}

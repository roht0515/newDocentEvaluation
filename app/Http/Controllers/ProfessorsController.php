<?php

namespace App\Http\Controllers;

use App\Professor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use DateTime;
use DB;

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
    public function store(Request $request)
    {
        //
        $now = new DateTime();
        if ($request->ajax()) {
            $user = new User();
            //guardar el usuario
            $user->username = $request->username;
            $user->password = $request->password;
            $user->role = 'Docente';
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
}

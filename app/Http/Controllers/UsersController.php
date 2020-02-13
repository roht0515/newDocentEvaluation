<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use DateTime;
use Validator;
use DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //mostrar los datos
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->id;
                    return $row;
                })
                ->make(true);
        }
        return view('admin.adminUsers.list');
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
        //guardar usuario
        if ($request->ajax()) {
            //declarar el nuevo objeto
            $user = new User();
            //insertar los datos
            $user->username = $request->username;
            $user->password = $request->password;
            $user->role = $request->role;
            $user->email = $request->email;
            //guardar los datos
            $user->saveOrFail();
            return response()->json(['success' => 'Usuario guardado']);
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
    public function edit(Request $request)
    {
        //actualizar usuario
        if ($request->ajax()) {
            DB::table('users')->where('id', '=', $request->input('id'))
                ->update([
                    'username' => $request->input('username'),
                    'password' => $request->input('password'),
                    'role' => $request->input('role'),
                    'email' => $request->input('email')
                ]);
            return response()->json(["Usuario Actualizado"]);
        }
    }
    public function get($id)
    {
        //mandar datos de los usuarios
        $user = DB::table('users')->where('id', '=', $id)->first();
        return view('admin.adminUsers.detaill')->with([
            'id' => $user->id,
            'username' => $user->username,
            'password' => $user->password,
            'role' => $user->role,
            'email' => $user->email
        ]);
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

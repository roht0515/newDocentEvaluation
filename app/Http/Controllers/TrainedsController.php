<?php

namespace App\Http\Controllers;

use App\Trained;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use DateTime;
use Validator;
use DB;

class TrainedsController extends Controller
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
            $data = Trained::latest()->get();
            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($row) {
                    $row = $row->id;
                    return $row;
                })
                ->make(true);
        }
        return view('admin.adminSecretary.Trained.list');
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
            $trained = new Trained();
            $trained->ci = $request->ci;
            $trained->name = $request->name;
            $trained->lastname = $request->lastname;
            $trained->email = $request->email;
            $trained->saveOrFail();
            return response()->json(['success' => 'Estudiante registrado']);
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

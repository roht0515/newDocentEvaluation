<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Trained;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use DateTime;
use Validator;
use DB;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return view('admin.adminSecretary.Certificate.list');
    }
    public function listDiplomat()
    {
        return view('admin.adminSecretary.Diplomat.list');
    }
    public function indexCertificate()
    {
        //
        $data = DB::table('certificate')->join('trained', 'certificate.idTrained', '=', 'trained.id')
            ->select([DB::raw('CONCAT(trained.name," ",trained.lastname) as fullname'), 'certificate.name as Nombrecito', 'certificate.reason', 'certificate.delivered', 'certificate.id as idc'])
            ->where('type', 'certificado');
        return DataTables::of($data)->make(true);
    }
    public function indexDiplomat()
    {
        $data = DB::table('certificate')->join('trained', 'certificate.idTrained', '=', 'trained.id')
            ->select([DB::raw('CONCAT(trained.name," ",trained.lastname) as fullname'), 'certificate.name as Nombrecito', 'certificate.reason', 'certificate.delivered', 'certificate.id as idc'])
            ->where('type', 'diploma');
        return DataTables::of($data)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCertificate()
    {
        //
        return view('admin.adminSecretary.Certificate.register');
    }
    public function createDiplomat()
    {
        return view('admin.adminSecretary.Diplomat.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCertificate(Request $request)
    {
        //
        if ($request->ajax()) {
            $now = new Datetime();
            $trained = new Trained();
            $trained->ci = $request->ci;
            $trained->name = $request->name;
            $trained->lastname = $request->lastname;
            $trained->career = $request->career;
            $trained->email = $request->email;
            $trained->saveOrFail(); //guardar el dato de del capacitado
            $id = Trained::all();
            $id = $id->last()->id;
            $certificate = new Certificate();
            $certificate->idTrained = $id;
            $certificate->name = $request->namec;
            $certificate->type = 'Certificado';
            $certificate->reason = $request->reason;
            $certificate->delivered = false;
            $certificate->dateMade = $now;
            $certificate->saveOrFail();
            return response()->json(['sucess' => 'Certificado Registrado']);
        }
        return view('admin.adminSecretary.Certificate.list');
    }
    public function storeDiplomat(Request $request)
    {
        //
        if ($request->ajax()) {
            $now = new Datetime();
            $trained = new Trained();
            $trained->ci = $request->ci;
            $trained->name = $request->name;
            $trained->lastname = $request->lastname;
            $trained->career = $request->career;
            $trained->email = $request->email;
            $trained->saveOrFail(); //guardar el dato de del capacitado
            $id = Trained::all();
            $id = $id->last()->id;
            $certificate = new Certificate();
            $certificate->idTrained = $id;
            $certificate->name = $request->namec;
            $certificate->type = 'Diploma';
            $certificate->reason = $request->reason;
            $certificate->delivered = false;
            $certificate->dateMade = $now;
            $certificate->saveOrFail();
            return response()->json(['sucess' => 'Diplomado Registrado']);
        }
        return view('admin.adminSecretary.Certificate.list');
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

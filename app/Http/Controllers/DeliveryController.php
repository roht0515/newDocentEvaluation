<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use App\Trained;
use App\Delivery;
use App\Accredited;
use Carbon\Carbon;
use App\Http\Requests\FormAccrediited;
use DateTime;
use DB;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function storeTutor(FormAccrediited $request)
    {
        if ($request->ajax()) {

            $now = new Carbon();
            $delivery = new Delivery();
            $certificate = new Certificate();
            $accredited = new Accredited();

            //registrar al acreditado
            $accredited->ci = $request->ci;
            $accredited->name = $request->name;
            $accredited->lastname = $request->lastname;
            $accredited->phone = $request->phone;
            $accredited->email = $request->email;
            $accredited->relationship = $request->relationship;
            $accredited->saveOrFail();

            $data = Accredited::all();
            $data = $data->last()->id;
            //registrar la entrega
            $delivery->idSecretary = $request->idSecretary;
            $delivery->idCertificate = $request->idCertificate;
            $delivery->idAccredited = $data;
            $delivery->deliveryDate = $now;
            $delivery->recivedTrained = false;
            $delivery->saveOrFail();
            //actualizar el estado de entrega del certificado
            $certificate = Certificate::where('id', '=', $request->idCertificate)->first();
            $certificate->delivered = true;
            $certificate->saveOrFail();

            return response()->json(["success" => 'Entrega Registrada']);
        }
    }
    public function storeStudent(Request $request)
    {
        if ($request->ajax()) {

            $now = new Carbon();

            $delivery = new Delivery();

            $accredited = new Accredited();

            $certificate = Certificate::where('id', '=', $request->id)->first();
            $trained = Trained::where('id', '=', $certificate->idTrained)->first();

            $accredited->ci = $trained->ci;
            $accredited->name = $trained->name;
            $accredited->lastname = $trained->lastname;
            $accredited->email = $trained->email;
            $accredited->phone = $trained->phone;
            $accredited->relationship = "Estudiante Capacitado";
            $accredited->saveOrFail();

            $data = Accredited::all();
            $data = $data->last()->id;
            //registrar la entrega
            $delivery->idSecretary = $request->idSecretary;
            $delivery->idCertificate = $certificate->id;
            $delivery->idAccredited = $data;
            $delivery->deliveryDate = $now;
            $delivery->recivedTrained = true;
            $delivery->saveOrFail();
            //cambiar esto del certificado
            $certificate->delivered = true;
            $certificate->saveorFail();
            return response()->json(["Success" => 'Entrega Registrada']);
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

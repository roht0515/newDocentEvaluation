<?php

namespace App\Http\Controllers;

use App\Accredited;
use App\Certificate;
use App\Delivery;
use App\Trained;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FormCertificateRequest;
use App\Http\Requests\FormDiplomatSRequest;
use DataTables;
use DateTime;
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
        return DataTables::of($data)
            ->addColumn('Delivery', function ($row) {
                if ($row->delivered == false) {
                    $row = '<h5 class="text-danger">No Entregado</h5>';
                } else {
                    $row = '<h5 class="text-success">Entregado</h5>';
                }
                return $row;
            })
            ->addColumn('BtnStudent', function ($row) {
                if ($row->delivered == false) {
                    $btn = '<button id="' . $row->idc . '" class="btn btn-primary">Estudiante</button>';
                } else {
                    $btn = '<h5 class="text-success">Entregado</h5>';
                }
                return $btn;
            })
            ->addColumn('BtnTutor', function ($row) {
                if ($row->delivered == false) {
                    $btn = '<a href="' . route('certificates.getCertificate', ["id" => $row->idc]) . '"><button class="btn btn-primary">Tutor</button></a>';
                } else {
                    $btn = '<h5 class="text-success">Entregado</h5>';
                }
                return $btn;
            })
            ->addColumn('DT_RowId', function ($row) {
                $row = $row->idc;
                return $row;
            })
            ->rawColumns(['Delivery', 'BtnStudent', 'BtnTutor'])
            ->make(true);
    }
    public function indexDiplomat()
    {
        $data = DB::table('certificate')->join('trained', 'certificate.idTrained', '=', 'trained.id')
            ->select([DB::raw('CONCAT(trained.name," ",trained.lastname) as fullname'), 'certificate.name as Nombrecito', 'certificate.reason', 'certificate.delivered', 'certificate.id as idc'])
            ->where('type', 'diploma');
        return DataTables::of($data)
            ->addColumn('Delivery', function ($row) {
                if ($row->delivered == false) {
                    $row = '<h5 class="text-danger">No Entregado</h5>';
                } else {
                    $row = '<h5 class="text-success">Entregado</h5>';
                }
                return $row;
            })
            ->addColumn('BtnStudent', function ($row) {
                if ($row->delivered == false) {
                    $btn = '<button id="' . $row->idc . '" class="btn btn-primary">Estudiante</button>';
                } else {
                    $btn = '<h5 class="text-success">Entregado</h5>';
                }
                return $btn;
            })
            ->addColumn('BtnTutor', function ($row) {
                if ($row->delivered == false) {
                    $btn = '<a href="' . route('certificates.getDiplomat', ["id" => $row->idc]) . '">
                    <button class="btn btn-primary">Tutor</button>
                    </a>';
                } else {
                    $btn = '<h5 class="text-success">Entregado</h5>';
                }
                return $btn;
            })
            ->addColumn('DT_RowId', function ($row) {
                $row = $row->idc;
                return $row;
            })
            ->rawColumns(['Delivery', 'BtnStudent', 'BtnTutor'])
            ->make(true);
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
    public function storeCertificate(FormCertificateRequest $request)
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
            $trained->phone = $request->phone;
            $trained->saveOrFail(); //guardar el dato de del capacitado
            $id = Trained::all();
            $id = $id->last()->id;

            $certificate = new Certificate();
            $certificate->idTrained = $id;
            $certificate->name = $request->nameCertificate;
            $certificate->type = 'Certificado';
            $certificate->reason = $request->reason;
            $certificate->delivered = false;
            $certificate->dateMade = $now;
            $certificate->saveOrFail();

            return response()->json(['sucess' => 'Certificado Registrado']);
        }
        return view('admin.adminSecretary.Certificate.list');
    }
    public function storeDiplomat(FormDiplomatSRequest $request)
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
            $trained->phone = $request->phone;
            $trained->saveOrFail(); //guardar el dato de del capacitado
            $id = Trained::all();
            $id = $id->last()->id;
            $certificate = new Certificate();
            $certificate->idTrained = $id;
            $certificate->name = $request->nameDiplomat;
            $certificate->type = 'Diploma';
            $certificate->reason = $request->reason;
            $certificate->delivered = false;
            $certificate->dateMade = $now;
            $certificate->saveOrFail();
            return response()->json(['sucess' => 'Diplomado Registrado']);
        }
        return view('admin.adminSecretary.Certificate.list');
    }
    public function getCertificate($id)
    {
        $certificate = Certificate::where('id', '=', $id)->first();
        return view('admin.adminSecretary.Certificate.delivery', compact('certificate'));
    }
    public function HistoryCertificateStudent(Request $request)
    {
        if ($request->ajax()) {
            $data = Accredited::join('delivery', 'accredited.id', '=', 'delivery.idAccredited')
                ->join('certificate', 'delivery.idCertificate', '=', 'certificate.id')
                ->join('trained', 'certificate.idTrained', '=', 'trained.id')
                ->select([DB::raw('CONCAT(trained.name," ",trained.lastname) as fullname'), 'certificate.name', 'certificate.reason', 'delivery.deliveryDate'])
                ->where('certificate.type', '=', 'Certificado')
                ->where('delivery.recivedTrained', '=', true);
            return DataTables::of($data)->make(true);
        }
        return view('admin.adminSecretary.Certificate.History.student');
    }
    public function HistoryCertificateTutor(Request $request)
    {
        if ($request->ajax()) {
            $data = Accredited::join('delivery', 'accredited.id', '=', 'delivery.idAccredited')
                ->join('certificate', 'delivery.idCertificate', '=', 'certificate.id')
                ->join('trained', 'certificate.idTrained', '=', 'trained.id')
                ->select([DB::raw('CONCAT(accredited.name," ",accredited.lastname) as fullnameTutor'), 'accredited.relationship', DB::raw('CONCAT(trained.name," ",trained.lastname) as fullname'), 'certificate.name', 'certificate.reason', 'delivery.deliveryDate'])
                ->where('certificate.type', '=', 'Certificado')
                ->where('delivery.recivedTrained', '=', false);
            return DataTables::of($data)->make(true);
        }
        return view('admin.adminSecretary.Certificate.History.tutor');
    }
    public function getDiplomat($id)
    {
        $certificate = Certificate::where('id', '=', $id)->first();
        return view('admin.adminSecretary.Diplomat.delivery', compact('certificate'));
    }
    public function HistoryDiplomatStudent(Request $request)
    {
        if ($request->ajax()) {
            $data = Accredited::join('delivery', 'accredited.id', '=', 'delivery.idAccredited')
                ->join('certificate', 'delivery.idCertificate', '=', 'certificate.id')
                ->join('trained', 'certificate.idTrained', '=', 'trained.id')
                ->select([DB::raw('CONCAT(trained.name," ",trained.lastname) as fullname'), 'certificate.name', 'certificate.reason', 'delivery.deliveryDate'])
                ->where('certificate.type', '=', 'Diploma')
                ->where('delivery.recivedTrained', '=', true);
            return DataTables::of($data)->make(true);
        }
        return view('admin.adminSecretary.Diplomat.History.student');
    }
    public function HistoryDiplomatTutor(Request $request)
    {
        if ($request->ajax()) {
            $data = Accredited::join('delivery', 'accredited.id', '=', 'delivery.idAccredited')
                ->join('certificate', 'delivery.idCertificate', '=', 'certificate.id')
                ->join('trained', 'certificate.idTrained', '=', 'trained.id')
                ->select([DB::raw('CONCAT(accredited.name," ",accredited.lastname) as fullnameTutor'), 'accredited.relationship', DB::raw('CONCAT(trained.name," ",trained.lastname) as fullname'), 'certificate.name', 'certificate.reason', 'delivery.deliveryDate'])
                ->where('certificate.type', '=', 'Diploma')
                ->where('delivery.recivedTrained', '=', false);
            return DataTables::of($data)->make(true);
        }
        return view('admin.adminSecretary.Diplomat.History.tutor');
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

@extends('layouts.adminLayout')

@section('content')
<!-- datatable con todos los diplomas -->
<div class="container-fluid">
    <div class="row p-3">
        <div class="col-10">
            <h3>Lista de Usuarios</h3>
        </div>
        <div class="col-2">
            <button id="btnRegister" type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal"
                data-target="#modeluser">Registrar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="dataTable table table-bordered table-hover" id="diplomattable">
                        <thead class="bg-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Version</th>
                                <th>Fecha de Inicio</th>
                                <th>Id #</th>
                            </tr>
                        </thead>
                        <tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
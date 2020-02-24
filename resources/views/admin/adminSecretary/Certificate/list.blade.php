@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">Certificados</h1>
                    </div>
                    <div class="col-6">
                        <ol  class=" float-sm-right">
                        <a href="{{route('certificates.register')}}" class="btn btn-primary">Registrar Estudiante Capacitado</a>
                        </ol>
                    </div>
                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="certificateTable">
                    <thead>
                        <tr>
                            <th>Nombre del Trained</th>
                            <th>Certificado</th>
                            <th>Razon</th>
                            <th>Entregado</th>
                            <th>id</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
<!--SECCION PÁRA CODIGO JS--->
@section('script')
<script>
    $(document).ready(function ()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //ver los datos de la categorias
    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:"{{route('certificates.indexcertificate')}}",
        columns: [
                {data:'fullname',name:'fullname'},  
                {data:'Nombrecito',name:'certificate.name'},
                {data:'reason',name:'certificate.reason'},
                {data:'delivered',name:'certificate.delivered'},
                {data:'idc',name:'certificate.id',visible:false}
            ]    
    });
})
</script>
@endsection
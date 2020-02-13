@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="dataTable table table-bordered table-hover" id="certificateTable">
                    <thead>
                        <tr>
                            <th>Trained</th>
                            <th>Nombre</th>
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
<a href="{{route('certificates.registerdiplomat')}}" class="btn btn-primary">Registrar Estudiante Capacitado</a>
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
        ajax:"{{route('certificates.indexdiplomat')}}",
        columns:
        [
            {data:'idTrained',name:'idTrained'},
            {data:'name',name:'name'},
            {data:'reason',name:'reason'},
            {data:'delivered',namE:'delivered'},
            {data:'DT_RowId',name:'DT_RowId',visible:false}
        ]        
    });
})
</script>
@endsection
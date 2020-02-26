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
                            <th>Nombre del Trained</th>
                            <th>Certificado</th>
                            <th>Razon</th>
                            <th>Fecha Entregada</th>
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
        ajax:"{{route('certificates.historyStudent')}}",
        columns: [
                {data:'fullname',name:'fullname'},  
                {data:'name',name:'name'},
                {data:'reason',name:'reason'},
                {data:'deliveryDate',name:'deliveryDate'}
            ]    
    });
})
</script>
@endsection
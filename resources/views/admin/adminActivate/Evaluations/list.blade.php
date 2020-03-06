@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- datatable con categorias boton de registro -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">Evaluaciones</h1>
                    </div>
                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="evaluationTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Version</th>
                            <th>Estado</th>
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
@section('script')
<script>
    $(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:"{{route('evaluations.listState')}}",
        columns:
        [
            {data:'name',name:'name'},
            {data:'version',name:'version'},
            {data:'State',name:'State'}
        ]
    });



//final del document ready
})
</script>

@endsection
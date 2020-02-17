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
                    <div class="col-10">
                        <h1 class="m-0 text-dark">Estudiantes</h1>
                    </div>
                    <div class="col-2">
                        {{-- Registrar Estidiante --}}
                        <a class="btn btn-primary" href="{{route('students.register')}}" role="button">Registrar Estudiante</a>

                    </div>
                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="questionTable">
                    <thead>
                        <tr>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Carrera</th>
                            <th>Correo</th>
                            <th name="id">id</th>
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

    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:"{{route('students.list')}}",
        columns:
        [
            {data:'ci',name:'ci'},
            {data:'name',name:'name'},
            {data:'lastname',name:'lastname'},
            {data:'career',name:'career'},
            {data:'email',name:'email'},
            {data:'DT_RowId',name:'DT_RowId',visible:false}
        ]        
    });
 
//final del document ready
})
</script>

@endsection
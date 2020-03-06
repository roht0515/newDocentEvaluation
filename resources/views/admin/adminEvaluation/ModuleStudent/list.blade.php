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
                        <h1 class="m-0 text-dark">Modulos</h1>
                    </div>

                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="modulesTable">
                    <thead>
                        <tr>
                            <th>N° #</th>
                            <th>Nombre</th>
                            <th>Nombre del Diploma</th>
                            <th>Fecha de Inicio</th>
                            <th>Acciones</th>
                            <th>Plus</th>
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
        ajax:"{{route('modulesStudent.list')}}",
        columns: 
        [
            {data:'number',name:'number'},
            {data:'name',name:'name'},
            {data:'nameDiplomat',name:'nameDiplomat'},
            {data:'startDate',name:'startDate'},
            {data:'RegisterStudent',name:'RegisterStudent'},
            {data:'BtnReport',name:'BtnReport'}
        ]
    });
    //click en la tabla
    var id;
    $('#modulesTable').on('click', 'tr', function () {
        id = table.row(this).id();
        if (id)
        {
            var url = '{{ route("categories.get","") }}';
            url+=`/${id}`;
            window.location.href=url;
        }
        
    });
//final del document ready
})
</script>
@endsection
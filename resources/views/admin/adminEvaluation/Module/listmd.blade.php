@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="dataTable table table-bordered table-hover" id="modulesTable">
                    <thead>
                        <tr>
                            <th>N° #</th>
                            <th>Nombre</th>
                            <th>Nombre del Diploma</th>
                            <th>Fecha de Inicio</th>
                            <th>idDiplomat</th>
                            <th>idModule</th>
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
        ajax:"{{route('modules.listDiplomat')}}",
        columns: 
        [
            {data:'number',name:'number'},
            {data:'name',name:'name'},
            {data:'nameD',name:'nameD'},
            {data:'startDate',name:'startDate'},
            {data:'DT_RowIdDiplomat',name:'DT_RowIdDiplomat',visible:false},
            {data:'DT_RowIdModule',name:'DT_RowIdModule',visible:false}
        ]
    });
    

//final del document ready
})
</script>
@endsection
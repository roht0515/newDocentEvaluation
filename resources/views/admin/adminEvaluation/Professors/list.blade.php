@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="dataTable table table-bordered table-hover" id="usertable">
          <thead>
            <tr>
              <th>Carnet de Identidad</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Carrera</th>
              <th>Detalles</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="{{route('professors.create')}}">Registrar Professor</a>
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
      ajax:"{{route('professors.list')}}",
      columns:[
          {data:'ci',name:'ci'},
          {data:'name',name:'name'},
          {data:'lastname',name:'lastname'},
          {data:'career',name:'career'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
      ]
  });


//final del document ready
})
</script>
@endsection
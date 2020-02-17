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
          <div class="col-8">
              <h1 class="m-0 text-dark">Evaluaciones</h1>
          </div>
          <div class="col-4">
              {{-- Registrar solo Evaluations --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalevaluation">
              Registrar Evaluaciones
            </button>
            <a href="" id="assingCategory" type="button" class="btn btn-primary">
              Asignar Categorias
            </a>
          </div>
      </div>
      <br>
        <table class="dataTable table table-bordered table-hover" id="evaluationTable">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Version</th>
              <th>Fecha de Inicio</th>
              <th>Fecha de Termino</th>
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
<!-- Modal -->
<div class="modal fade" id="modalevaluation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="evaluationForm" name="evaluationForm" class="form-horizontal" method="POST"
          action="{{route('evaluations.store')}}">
          @csrf
          <div class="form-group">
            <label for="name">Nombre: </label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
              placeholder="Ingrese nombre de Evaluacion">
          </div>
          <div class="form-group">
            <label for="version">Version: </label>
            <input type="number" class="form-control" name="version" id="version" aria-describedby="helpId"
              placeholder="Ingresar Version">
          </div>
          <div class="form-group">
            <label for="startDate">Fecha de Inicio</label>
            <input type="date" class="form-control" name="startDate" id="startDate" aria-describedby="helpId"
              placeholder="">
          </div>
          <div class="form-group">
            <label for="endDate">Fecha Final</label>
            <input type="date" class="form-control" name="endDate" id="endDate" aria-describedby="helpId"
              placeholder="">
          </div>
          <button id="saveEvaluation" type="submit" class="btn btn-primary">Registrar Evaluacion</button>
        </form>
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
    //ver los datos de la categorias
    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:"{{route('evaluations.list')}}",
        columns:
        [
            {data:'name',name:'name'},
            {data:'version',name:'version'},
            {data:'startDate',name:'startDate'},
            {data:'endDate',name:'endDate'},
            {data:'DT_RowId',name:'DT_RowId',visible:false}
        ]        
    });
    $('#saveEvaluation').click(function (e)
    {
      e.preventDefault();

      $.ajax({
        type: "POST",
        url: "{{route('evaluations.store')}}",
        data: $('#evaluationForm').serialize(),
        dataType: "JSON",
        success: function (data) {
          $('#evaluationForm').trigger('reset');
          $('#modalevaluation').modal('hide');
          table.ajax.reload();
        },
        error: function(data)
        {
          console.log('Error',data);
        }
      });
    })


//final del document ready
})
</script>

@endsection
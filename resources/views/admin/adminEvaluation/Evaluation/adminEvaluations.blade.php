@extends('layouts.adminLayout')
@section('meta')

@endsection
@section('content')
<!-- datatable con evaluaciones boton de registro -->
<div class="container-fluid">
  <div class="row p-3">
    <div class="col-10">
      <h3>Lista de Usuarios</h3>
    </div>
    <div class="col-2">
      <button id="btnRegister" type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal"
        data-target="#modelEvaluation">Registrar</button>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body table-responsive">
          <table class="dataTable table table-bordered table-hover" id="diplomattable">
            <thead class="bg-primary">
              <tr>
                <th>Nombre </th>
                <th>Version</th>
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
  <!-- /.template modal evaluation -->
  <div class="modal fade" id="modelEvaluation">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar Evaluacion</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="Name">Nombre</label>
            <input type="text" class="form-control" id="name" placeholder="Pregunta">
          </div>
          <div class="form-group">
            <label for="Name">Version</label>
            <input type="text" class="form-control" id="version" placeholder="Pregunta">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Añadir Categoria</label>
            <select class="form-control">
              <option>categoria 1</option>
              <option>categoria 2</option>
              <option>categoria 3</option>
              <option>categoria 4</option>
              <option>categoria 5</option>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
@endsection
@extends('layouts.adminLayout')
@section('meta')

@endsection
@section('content')
<!-- datatable con categorias boton de registro -->
<div class="container-fluid">
  <div class="row p-3">
    <div class="col-6">
      <h3>Lista de Categorias</h3>
    </div>
    <div class="col-3">
      <button id="btnRegister" type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal"
        data-target="#modelQuestion">Registrar preguntas</button>
    </div>
    <div class="col-3">
      <button id="btnRegister" type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal"
        data-target="#modelCategory">Registrar categorias</button>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body table-responsive">
          <table class="dataTable table table-bordered table-hover" id="categorytable">
            <thead class="bg-primary">
              <tr>
                <th>Nombre</th>
                <th>Año</th>
                <th>Id #</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.template modal quiestion -->
  <div class="modal fade" id="modelQuestion">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar pregunta</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Categoria</label>
            <select class="form-control">
              <option>categoria 1</option>
              <option>categoria 2</option>
              <option>categoria 3</option>
              <option>categoria 4</option>
              <option>categoria 5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Pregunta</label>
            <input type="text" class="form-control" id="question" placeholder="Pregunta">
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
  <!-- /.template modal Categoria -->
  <div class="modal fade" id="modelCategory">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar categoria</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputPassword1">Nombre</label>
            <input type="text" class="form-control" id="categoryName" placeholder="Nombre">
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
@section('script')
<script>
</script>

@endsection
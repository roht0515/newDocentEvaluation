@extends('layouts.adminLayout')

@section('content')
<!-- datatable con estudiantes boton de registro -->
<div class="container-fluid">
    <div class="row p-3">
        <div class="col-4">
            <h3>Lista de Usuarios</h3>
        </div>
        <div class="col-2">
            <button id="btnRegister" type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal"
                data-target="#modelProfessor">Registrar</button>
        </div>
        <div class="col-4">
            <h3>Lista de Usuarios</h3>
        </div>
        <div class="col-2">
            <button id="btnRegister" type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal"
                data-target="#modelStudent">Registrar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="dataTable table table-bordered table-hover" id="diplomattable">
                        <thead class="bg-primary">
                            <tr>
                                <th>Nombre </th>
                                <th>Carrera</th>
                                <th>Turno</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="dataTable table table-bordered table-hover" id="diplomattable">
                        <thead class="bg-primary">
                            <tr>
                                <th>Nombre </th>
                                <th>Carrera</th>
                                <th>Turno</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.template modal Professor -->
    <div class="modal fade" id="modelProfessor">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar Docente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Name">CI</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Apellidos</label>
                        <input type="text" class="form-control" id="version" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Carrera</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Turno</label>
                        <select class="form-control">
                            <option>Mañana</option>
                            <option>Tarde</option>
                            <option>Noche</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Name">Telefono</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Direccion</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
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
    <!-- /.template modal Professor -->
    <div class="modal fade" id="modelStudent">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar Estudiante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Name">CI</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Apellidos</label>
                        <input type="text" class="form-control" id="version" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Carrera</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Turno</label>
                        <select class="form-control">
                            <option>Mañana</option>
                            <option>Tarde</option>
                            <option>Noche</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Name">Telefono</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
                    </div>
                    <div class="form-group">
                        <label for="Name">Direccion</label>
                        <input type="text" class="form-control" id="name" placeholder="Pregunta">
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
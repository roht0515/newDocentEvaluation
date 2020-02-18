@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<form id="professorForm" name="professorForm" action="{{route('professors.store')}}" method="POST">
    @csrf
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <h3>Datos Personales del Docente</h3>
                <div class="form-group">
                    <label for="ci">Carnet de Identidad: </label>
                    <input type="text" class="form-control" name="ci" id="ci" aria-describedby="helpId"
                        placeholder="Ingrese Carnet de Identidad">
                </div>
                <div class="form-group">
                    <label for="name">Nombre Completo: </label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                        placeholder="Ingrese nombres completos">
                </div>
                <div class="form-group">
                    <label for="lastname">Apellido Completo: </label>
                    <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId"
                        placeholder="Ingrese apellidos completos">
                </div>
                <div class="form-group">
                    <label for="email">Correo Electronico: </label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
                        placeholder="Correo Electronico">
                </div>
                <div class="form-group">
                    <label for="phone">Celular: </label>
                    <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpId"
                        placeholder="Ingrese su numero de celular">
                </div>
                <div class="form-group">
                    <label for="address">Direccion: </label>
                    <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId"
                        placeholder="Ingrese la direccion de Domicilio">
                </div>
                <div class="form-group">
                    <label for="startDate">Fecha de Inicio: </label>
                    <input type="date" class="form-control" name="startDate" id="StartDate" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="career">Carrera Profesional: </label>
                    <input type="text" class="form-control" name="career" id="career" aria-describedby="helpId"
                        placeholder="Ingrese la carrera del Docente">
                </div>
                <div class="form-group">
                    <label for="turn">Turnos: </label>
                    <select class="form-control" name="turn" id="turn">
                        <option value="0">Seleccione Turno</option>
                        <option name="turn" value="Mañana">Mañana</option>
                        <option name="turn" value="Tarde">Tarde</option>
                        <option name="turn" value="Noche">Noche</option>
                    </select>
                </div>
                <button id="saveDate" type="submit" class="btn btn-primary">Registrar Docente</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')
<script>
    $(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //obtener los datos de los nombres de usuarios

    //guardar los datos
    $('#saveDate').click(function (e)
    {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            data: $('#professorForm').serialize(),
            url: "{{route('professors.store')}}",
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('#professorForm').trigger('reset');
                window.location.href="{{route('professors.list')}}";
            },
            error:function(response)
            {
                console.log(error);
            }
        });
    });
})
</script>
@endsection
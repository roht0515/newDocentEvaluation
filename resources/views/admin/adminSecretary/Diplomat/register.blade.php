@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
<form id="diplomatForm" name="diplomatForm" action="{{route('certificates.storediplomat')}}" method="post">
    @csrf
    <h3>Datos del Estudiante Capacitado</h3>
    <div class="form-group row">
        <div class="col-12 col-md-6">
        <label for="ci">Carnet de Identidad: </label>
        <input type="text" class="form-control" name="ci" id="ci" aria-describedby="helpId"
            placeholder="Carnet de Identidad">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 col-md-6">
        <label for="name">Nombre: </label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
            placeholder="Nombre Completo">
        </div>
        <div class="col-12 col-md-6">
        <label for="lastname">Apellido: </label>
        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId"
            placeholder="Apellidos Completos">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 col-md-6">
        <label for="career">Carrera: </label>
        <input type="text" class="form-control" name="career" id="career" aria-describedby="helpId"
            placeholder="Carrera Profesional">
        </div>
        <div class="col-12 col-md-6">
        <label for="email">Correo Electronico: </label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
            placeholder="Correo Electronico">
        </div>
    </div>
    <h3>Datos del Certificado</h3>
    <div class="form-group">
        <label for="namec">Nombre: </label>
        <input type="text" class="form-control" name="namec" id="namec" aria-describedby="helpId"
            placeholder="Nombre del Certificado">
    </div>
    <div class="form-group">
        <label for="reason">Motivo del Certificado: </label>
        <input type="text" class="form-control" name="reason" id="reason" aria-describedby="helpId"
            placeholder="Motivo">
    </div>
    <div class="form-group">
        <button id="saveDiplomat" type="submit" class="btn btn-primary">Registrar Certificado</button>
    </div>
</form>
</div>
</div>
</div>
</div>
@endsection
<!--SECCION PÁRA CODIGO JS--->
@section('script')
<script>
    $(document).ready(function ()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //registrar Certificado
    $('#saveDiplomat').click(function (e)
    {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{route('certificates.storediplomat')}}",
            data: $('#diplomatForm').serialize(),
            dataType: "JSON",
            success: function (data) {
                $('#diplomatForm').trigger('reset');
                window.location.href="{{route('certificates.indexdiplomat')}}";
            },
            error:function(response)
            {
                console.log(error);
            }
        });
    })
})
</script>
@endsection
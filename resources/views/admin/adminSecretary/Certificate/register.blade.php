@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<form id="certificateForm" name="certificateForm" action="{{route('certificates.store')}}" method="post">
    @csrf
    <h3>Datos del Estudiante Capacitado</h3>
    <div class="form-group">
        <label for="ci">Carnet de Identidad: </label>
        <input type="text" class="form-control" name="ci" id="ci" aria-describedby="helpId"
            placeholder="Carnet de Identidad">
    </div>
    <div class="form-group">
        <label for="name">Nombre: </label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
            placeholder="Nombre Completo">
    </div>
    <div class="form-group">
        <label for="lastname">Apellido: </label>
        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId"
            placeholder="Apellidos Completos">
    </div>
    <div class="form-group">
        <label for="career">Carrera: </label>
        <input type="text" class="form-control" name="career" id="career" aria-describedby="helpId"
            placeholder="Carrera Profesional">
    </div>
    <div class="form-group">
        <label for="email">Correo Electronico: </label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
            placeholder="Correo Electronico">
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
        <button id="saveCertificate" type="submit" class="btn btn-primary">Registrar Certificado</button>
    </div>
</form>
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
    $('#saveCertificate').click(function (e)
    {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{route('certificates.store')}}",
            data: $('#certificateForm').serialize(),
            dataType: "JSON",
            success: function (data) {
                $('#certificateForm').trigger('reset');
                window.location.href="{{route('certificates.indexcertificate')}}";
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
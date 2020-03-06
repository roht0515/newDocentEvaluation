@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<form id="certificateForm" name="certificateForm" action="{{route('certificates.store')}}" method="post"
    autocomplete="off">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                @csrf
                <h3>Datos del Estudiante Capacitado</h3>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="ci">Carnet de Identidad: </label>
                        <input type="text" class="form-control" name="ci" id="ci" aria-describedby="helpId"
                            placeholder="Carnet de Identidad">
                        <div id="ValidateCi" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="name">Nombre: </label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                            placeholder="Nombre Completo">
                        <div id="ValidateName" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="lastname">Apellido: </label>
                        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId"
                            placeholder="Apellidos Completos">
                        <div id="ValidateLastName" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="career">Carrera: </label>
                        <input type="text" class="form-control" name="career" id="career" aria-describedby="helpId"
                            placeholder="Carrera Profesional">
                        <div id="ValidateCareer" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="email">Correo Electronico: </label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
                            placeholder="Correo Electronico">
                        <div id="ValidateEmail" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="career">Celular: </label>
                        <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpId"
                            placeholder="Numero de Celular">
                        <div id="ValidatePhone" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <h3>Datos del Certificado</h3>
                <div class="form-group">
                    <label for="namec">Nombre: </label>
                    <input type="text" class="form-control" name="nameCertificate" id="nameCertificate"
                        aria-describedby="helpId" placeholder="Nombre del Certificado">
                    <div id="ValidateNameCertificate" class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label for="reason">Motivo del Certificado: </label>
                    <input type="text" class="form-control" name="reason" id="reason" aria-describedby="helpId"
                        placeholder="Motivo">
                    <div id="ValidateReason" class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registrar
                        Certificado</button>
                </div>
            </div>
        </div>
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
        //agregar y quitar clases
     $(document).on("keyup", "input", function () {
        if ($(this).val().length <= 0)
        {
            $(this).addClass('is-invalid');
        }
        else
        {
             $(this).removeClass("is-invalid");
             $(this).addClass("is-valid");
        }
    });
    //mensajes de confirmacion
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    var form = document.getElementById('certificateForm');
    form.addEventListener("submit",function (event)
    {
        event.preventDefault();
        event.stopPropagation();

        $.ajax({
            type: "POST",
            url: "{{route('certificates.store')}}",
            cache:false,
            data: $('#certificateForm').serialize(),
            dataType: "JSON",
            success: function (data) {
                Toast.fire({
                        type: 'success',
                        title: 'Estudiante capacitado registrado exitosamente.'
                });
                $('#certificateForm').trigger('reset');
                window.location.href="{{route('certificates.list')}}";
            },
            error:function(error)
            {
                if(error.responseJSON.hasOwnProperty('errors'))
                {
                    if(error.responseJSON.errors.ci)
                    {
                        $('#ci').addClass('is-invalid');
                        $('#ValidateCi').html(error.responseJSON.errors.ci);
                    }
                    if(error.responseJSON.errors.name)
                    {
                        $('#name').addClass('is-invalid');
                        $('#ValidateName').html(error.responseJSON.errors.name);
                    }
                    if(error.responseJSON.errors.lastname)
                    {
                        $('#lastname').addClass('is-invalid');
                        $('#ValidateLastName').html(error.responseJSON.errors.lastname);
                    }
                    if(error.responseJSON.errors.career)
                    {
                        $('#career').addClass('is-invalid');
                        $('#ValidateCareer').html(error.responseJSON.errors.career);
                    }
                    if(error.responseJSON.errors.email)
                    {
                        $('#email').addClass('is-invalid');
                        $('#ValidateEmail').html(error.responseJSON.errors.email);
                    }
                    if(error.responseJSON.errors.phone)
                    {
                        $('#phone').addClass('is-invalid');
                        $('#ValidatePhone').html(error.responseJSON.errors.phone);
                    }
                    if(error.responseJSON.errors.nameCertificate)
                    {
                        $('#nameCertificate').addClass('is-invalid');
                        $('#ValidateNameCertificate').html(error.responseJSON.errors.nameCertificate);
                    }
                    if(error.responseJSON.errors.reason)
                    {
                        $('#reason').addClass('is-invalid');
                        $('#ValidateReason').html(error.responseJSON.errors.reason);
                    }
                }
            }
        });
    })
})
</script>
@endsection
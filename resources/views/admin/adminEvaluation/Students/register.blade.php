@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<form id="studentForm" name="studentForm" action="{{route('students.store')}}" method="POST">
    @csrf
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <h3>Datos Personales del Estudiante</h3>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="ci">Carnet de Identidad: </label>
                        <input type="text" class="form-control" name="ci" id="ci" aria-describedby="helpId"
                            placeholder="Ingrese Carnet de Identidad">
                        <div id="ValidateCi" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="name">Nombre Completo: </label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                            placeholder="Ingrese nombres completos">
                        <div id="ValidateName" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="lastname">Apellido Completo: </label>
                        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId"
                            placeholder="Ingrese apellidos completos">
                        <div id="ValidateLastName" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="email">Correo Electronico: </label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
                            placeholder="Correo Electronico">
                        <div id="ValidateEmail" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="phone">Celular: </label>
                        <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpId"
                            placeholder="Ingrese su numero de celular">
                        <div id="ValidatePhone" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="address">Direccion: </label>
                        <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId"
                            placeholder="Ingrese la direccion de Domicilio">
                        <div id="ValidateAddress" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="career">Carrera Profesional: </label>
                        <input type="text" class="form-control" name="career" id="career" aria-describedby="helpId"
                            placeholder="Ingrese la carrera del Docente">
                        <div id="ValidateCareer" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="turn">Turnos: </label>
                        <select class="form-control" name="turn" id="turn">
                            <option value="0">Seleccione Turno</option>
                            <option name="turn" value="Mañana">Mañana</option>
                            <option name="turn" value="Tarde">Tarde</option>
                            <option name="turn" value="Noche">Noche</option>
                        </select>
                        <div id="ValidateTurn" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Registrar Estudiante</button>
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
        //agregar y quitar clases para el control de los textobx
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
    //agregar y quitar clases del select
    $(document).on("change","select",function ()
    {
        if ($(this).val() != 0 )
        {
            $('#ValidateTurn').removeClass('d-block');
             $(this).removeClass("is-invalid");
             $(this).addClass("is-valid");
        }
        else
        {
            $('#ValidateTurn').addClass('d-block');
            $(this).addClass('is-invalid');
        }
    })
    var form = document.getElementById('studentForm');
    form.addEventListener("submit",function (event)
    {
        $("input").removeClass("is-invalid");
        event.preventDefault();
        event.stopPropagation();
        $.ajax({
            data: $('#studentForm').serialize(),
            url: "{{route('students.store')}}",
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('#studentForm').trigger('reset');
                window.location.href="{{route('students.list')}}";
            },
            error:function(error)
            {
                if(error.responseJSON.hasOwnProperty('errors'))
                {
                    if (error.responseJSON.errors.ci)
                    {
                        $('#ci').addClass('is-invalid');
                        $('#ValidateCi').html(error.responseJSON.errors.ci);
                    }
                    if (error.responseJSON.errors.name)
                    {
                        $('#name').addClass('is-invalid');
                        $('#ValidateName').html(error.responseJSON.errors.name); 
                    }   
                    if (error.responseJSON.errors.lastname)
                    {
                        $('#lastname').addClass('is-invalid');
                        $('#ValidateLastName').html(error.responseJSON.errors.lastname); 
                    }
                    if (error.responseJSON.errors.email)
                    {
                        $('#email').addClass('is-invalid');
                        $('#ValidateEmail').html(error.responseJSON.errors.email);
                    }   
                    if (error.responseJSON.errors.phone)
                    {
                        $('#phone').addClass('is-invalid');
                        $('#ValidatePhone').html(error.responseJSON.errors.phone);
                    }
                    if (error.responseJSON.errors.address)
                    {
                        $('#address').addClass('is-invalid');
                        $('#ValidateAddress').html(error.responseJSON.errors.address);
                    }
                    if (error.responseJSON.errors.career)
                    {
                        $('#career').addClass('is-invalid');
                        $('#ValidateCareer').html(error.responseJSON.errors.career);
                    }
                    if (error.responseJSON.errors.turn)
                    {
                        $('#ValidateTurn').addClass('d-block');
                        $('#ValidateTurn').html(error.responseJSON.errors.turn);
                    }
                }
            }
        });
    });


//final del document ready
})
</script>

@endsection
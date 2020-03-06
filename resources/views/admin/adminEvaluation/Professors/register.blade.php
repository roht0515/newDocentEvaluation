@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<form id="professorForm" name="professorForm" action="{{route('professors.store')}}" method="POST" autocomplete="off">
    @csrf
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <h3>Datos Personales del Docente</h3>
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
                        <label for="name">Nombre: </label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                            placeholder="Ingrese nombres completos">
                        <div id="ValidateName" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="lastname">Apellido: </label>
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
                    <div class="col-12 col-md-12">
                        <label for="address">Direccion: </label>
                        <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId"
                            placeholder="Ingrese la direccion de Domicilio">
                        <div id="ValidateAddress" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="career">Carrera Profesional: </label>
                        <input type="text" class="form-control" name="career" id="career" aria-describedby="helpId"
                            placeholder="Ingrese la carrera del Docente">
                        <div id="ValidateCareer" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="startDate">Fecha de Inicio: </label>
                        <input type="date" class="form-control" name="startDate" id="startDate"
                            aria-describedby="helpId">
                        <div id="ValidateStartDate" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="turn">Turnos: </label>
                        <select class="form-control" name="turn" id="turn">
                            <option value="0">Seleccione Turno</option>
                            <option value="Mañana">Mañana</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Noche">Noche</option>
                        </select>
                        <div id="ValidateTurn" class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Registrar Docente</button>
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
    //agregar y quitar clases para el control de fecha
    $('#startDate').change(function ()
    {
        var now = new Date();
        
        if ($(this).val() <= now.getDate())
        {
            $('#ValidateStartDate').addClass('d-block');
            $(this).addClass('is-invalid');
        }
        else
        {
            $(this).addClass('is-valid');
            $('#ValidateStartDate').removeClass('d-block');
            $(this).removeClass('is-invalid');
        }
    })
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
        //mensajes de confirmacion
        const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    var form = document.getElementById('professorForm');
    form.addEventListener("submit",function (event)
    {
        $("input").removeClass("is-invalid");
        event.preventDefault();
        event.stopPropagation();
        //ajax para guardar los datos
        $.ajax({
            data: $('#professorForm').serialize(),
            url: "{{route('professors.store')}}",
            type: "POST",
            dataType: "JSON",
            cache:false,
            success: function (data) {
                Toast.fire({
                    type: 'success',
                    title: 'Se registro correctamente el Docente.'
              });
                $('#professorForm').trigger('reset');
                window.location.href="{{route('professors.list')}}";
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
                    if (error.responseJSON.errors.startDate)
                    {
                        $('#startDate').addClass('is-invalid');
                        $('#ValidateStartDate').addClass('d-block');
                        $('#ValidateStartDate').html(error.responseJSON.errors.startDate);
                    }
                    if (error.responseJSON.errors.turn)
                    {
                        $('#ValidateTurn').addClass('d-block');
                        $('#ValidateTurn').html(error.responseJSON.errors.turn);
                    }
                }
            }
        });
    })
})
</script>
@endsection
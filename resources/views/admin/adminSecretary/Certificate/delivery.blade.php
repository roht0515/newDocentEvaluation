@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body table-responsive">
            <h3 class="text-center">Certificado {{$certificate->name}}</h3>
            <form id="storeDelivery" action="{{route('deliveryTutor.store')}}" method="post" autocomplete="off">
                <input type="hidden" id="idCertificate" name="idCertificate" value="{{$certificate->id}}">
                <input type="hidden" id="idSecretary" name="idSecretary" value="{{auth()->user()->id}}">
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                    <label for="name">Ci: </label>
                    <input type="text" name="ci" id="ci" class="form-control" placeholder="Cedula de Identidad"
                        aria-describedby="helpId">
                    <div id="ValidateCi" class="invalid-feedback">
                    </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                    <label for="name">Nombre: </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del Tutor"
                        aria-describedby="helpId">
                    <div id="ValidateName" class="invalid-feedback">
                    </div>
                    </div>
                    <div class="col-12 col-md-6">
                    <label for="lastname">Apellido: </label>
                    <input type="text" name="lastname" id="lastname" class="form-control"
                        placeholder="Apellido del tutor" aria-describedby="helpId">
                    <div id="ValidateLastName" class="invalid-feedback">
                    </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                    <label for="phone">Correo Electronico: </label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo Electronico"
                        aria-describedby="helpId">
                    <div id="ValidateEmail" class="invalid-feedback">
                    </div>
                    </div>
                    <div class="col-12 col-md-6">
                    <label for="phone">Celular: </label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Numero de Celular"
                        aria-describedby="helpId">
                    <div id="ValidatePhone" class="invalid-feedback">
                    </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 col-md-6">
                    <label for="relationship">Relacion: </label>
                    <input type="text" name="relationship" id="relationship" class="form-control"
                        placeholder="Tipo de Relacion" aria-describedby="helpId">
                    <div id="ValidateRelationship" class="invalid-feedback">
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registrar Entrega</button>
                </div>
            </form>
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
    var form = document.getElementById('storeDelivery');
    form.addEventListener("submit",function (event)
    {
        event.preventDefault();
        event.stopPropagation();

        $.ajax({
            type: "POST",
            url: "{{route('deliveryTutor.store')}}",
            data: $('#storeDelivery').serialize(),
            dataType: "JSON",
            success: function (response) {
                window.location.href="{{route('certificates.list')}}";
            },
            error: function (error)
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
                    if (error.responseJSON.errors.relationship)
                    {
                        $('#relationship').addClass('is-invalid');
                        $('#ValidateRelationship').html(error.responseJSON.errors.relationship);
                    }
                }
            }
        });
    })
  
})
</script>
@endsection
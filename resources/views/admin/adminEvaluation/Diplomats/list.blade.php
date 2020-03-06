@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- datatable con categorias boton de registro -->
<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">Diplomados</h1>
                    </div>
                    <div class="col-6">
                        {{-- Registrar DIplomado --}}
                        <ol class=" float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modaldiplomat">
                                Registrar Diplomado
                            </button>
                        </ol>
                    </div>
                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="diplomatTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Version</th>
                            <th>Fecha de Inicio</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaldiplomat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Diplomado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="diplomatForm" name="diplomatForm" class="form-horizontal" method="POST"
                    action="{{route('diplomats.store')}}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre: </label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                            placeholder="Ingrese nombre del Diplomado">
                        <div id="ValidateName" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="version">Version: </label>
                        <input type="number" class="form-control" name="version" id="version">
                        <div id="ValidateVersion" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="startDate" id="StartDate">
                        <div id="ValidateStartDate" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="idEvaluation">Evaluacion</label>
                        <select name="evaluation" id="evaluation" class="form-control custom-select">
                            <option value="0" selected>Seleccione la evaluacion</option>
                            @foreach ($evaluations as $evaluation)
                            <option value="{{ $evaluation['id'] }}">{{ $evaluation['name'] }}</option>
                            @endforeach
                        </select>
                        <div id="ValidateEvaluation" class="invalid-feedback"></div>
                    </div>
                    <button type="submit" class="btn btn-primary swalDefaultSuccess">Registrar Diplomado</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     //mensajes de confirmacion
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    //ver los datos de la categorias
    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:"{{route('diplomats.list')}}",
        columns:
        [
            {data:'name',name:'name'},
            {data:'version',name:'version'},
            {data:'startDate',name:'startDate'},
            {data:'BtnModule',name:'BtnModule'}
        ]        
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
    //cambio de fecha
    $('#StartDate').change(function ()
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
    //cambio del select
    $('#idEvaluation').change(function ()
    {
        if ($(this).val() != 0)
        {
            $('#ValidateEvaluation').removeClass('d-block');
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
        else
        {
            $('#ValidateEvaluation').addClass('d-block');
            $(this).addClass('is-invalid');
        }
    })
    var form = document.getElementById('diplomatForm');
    form.addEventListener("submit",function (event)
    {
        
        event.preventDefault();
        event.stopPropagation();
        //agregar por ajax
        $.ajax({
            type: "POST",
            url: "{{route('diplomats.store')}}",
            data: $('#diplomatForm').serialize(),
            dataType: "JSON",
            success: function (data) {
                Toast.fire({
                    type: 'success',
                    title: 'Se registro correctamente el Diplomado.'
                });
                table.ajax.reload();
                $('#diplomatForm').trigger('reset');
                $('#modaldiplomat').modal('hide');
                $("input").removeClass("is-invalid");
                $("input").removeClass('is-valid');
            },
            error:function (error)
            {
                console.log(error);
                if(error.responseJSON.hasOwnProperty('errors'))
                {
                    if (error.responseJSON.errors.name)
                    {
                        $('#name').addClass('is-invalid');
                        $('#ValidateName').html(error.responseJSON.errors.name); 
                    }
                    if (error.responseJSON.errors.version)
                    {
                        $('#version').addClass('is-invalid');
                        $('#ValidateVersion').html(error.responseJSON.errors.version);
                    }
                    if (error.responseJSON.errors.startDate)
                    {
                        $('#StartDate').addClass('is-invalid');
                        $('#ValidateStartDate').addClass('d-block');
                        $('#ValidateStartDate').html(error.responseJSON.errors.startDate);
                    }
                    if(error.responseJSON.errors.evaluation)
                    {
                        $('#ValidateEvaluation').addClass('d-block');
                        $('#ValidateEvaluation').html(error.responseJSON.errors.evaluation);
                        
                    }
                }
            }
        });
    })


//final del document ready
})
</script>

@endsection
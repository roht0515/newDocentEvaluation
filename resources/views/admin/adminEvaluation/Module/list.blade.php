@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">

      <div class="card-body table-responsive">
        <div class="row">
          <div class="col-6">
            <h3>Diplomado: {{$name}}</h3>
            <input type="hidden" id="idDiplomat" value="{{$id}}">
          </div>
          <div class="col-6">
            <ol class="float-sm-right">
              {{-- Registrar solo Modulos --}}
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalmodule">
                Registrar Modulo
              </button>
            </ol>
          </div>
        </div>
        <table class="dataTable table table-bordered table-hover" id="moduleTable">
          <thead>
            <tr>
              <th name="number">Numero Modulo</th>
              <th name="idProfessor">nombre docente</th>
              <th name="idDiplomat">Nombre Diplomado</th>
              <th name="idModule">Nombre modulo</th>

              <th name="group">Grupo</th>
              <th name="classRoom">Aula</th>
              <th name="startDate">Fecha de inicio</th>

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
<div class="modal fade" id="modalmodule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Modulo-Materia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="moduleRegister" method="POST" accion="{{ route('diplomatModule') }}" autocomplete="off">
          @csrf
          <input type="hidden" value="{{$id}}" id="idDiplomat" name="idDiplomat">
          <div class="container">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="docentes">Docentes</label>
                <select id="professor" name="professor" class="custom-select">
                  <option value="0" selected>Seleccione el docente</option>
                  @foreach ($professors as $professor)
                  <option value="{{ $professor['id'] }}">{{ $professor['name'] }} {{$professor['lastname']}}</option>
                  @endforeach
                </select>
                <div id="ValidateProfessor" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="moduleName">Nombre modulo</label>
                <input type="text" id="moduleName" name="name" class="form-control" id="inputName">
                <div id="ValidateName" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="moduleNumber">Numero modulo</label>
                <input type="text" id="number" name="number" class="form-control" id="inputModuleNumber">
                <div id="ValidateNumber" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group col-md-12">
                <h5>Fechas de Evaluacion</h5>
              </div>
              <div class="form-group col-md-6">
                <label for="StartDate">Fecha de Inicio: </label>
                <input type="date" id="startDateEvaluation" name="startDateEvaluation" class="form-control">
                <div id="ValidateStartDateEvaluation" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="endDate">Fecha de Finalizacion: </label>
                <input type="date" id="endDateEvaluation" name="endDateEvaluation" class="form-control">
                <div id="ValidateEndDateEvaluation" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group col-md-12">
                <h5>Fecha del Modulo</h5>
              </div>
              <div class="form-group col-md-6">
                <label for="StartDate">Fecha de Inicio: </label>
                <input type="date" id="startDateModule" name="startDateModule" class="form-control">
                <div id="ValidateStartDateModule" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="endDate">Fecha de Finalizacion: </label>
                <input type="date" id="endDateModule" name="endDateModule" class="form-control">
                <div id="ValidateEndDateModule" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="group">Grupo: </label>
                <input type="text" id="group" name="group" class="form-control">
                <div id="ValidateGroup" class="invalid-feedback">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="classroomNumber">Aula: </label>
                <input type="text" id="classroom" name="classroom" class="form-control">
                <div id="ValidateClassroom" class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Registrar modulo</button>
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
    var idDiplomat=document.getElementById('idDiplomat').value;
    var url='{{route("modules.listDate","")}}';
    url+=`/${idDiplomat}`;
    var table=$('.dataTable').DataTable({
      serverside:true,
      processing:true,
      ajax:url,
      columns:
      [
        {data:'nroModule',name:'nroModule'},
        {data:'fullname',name:'fullname'},
        {data:'nameDiplomat',name:'nameDiplomat'},
        {data:'nameModule',name:'nameModule'},   
//{data:'moduleTurn',name:'moduleTurn'},
        {data:'group',name:'group'},
        {data:'classRoom',name:'classRoom'},
        {data:'startDate',name:'startDate'}
      ]
    })
    //agregar y quitar clases inputs
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
    $('input[type=date]').change(function ()
    {
      var now = new Date();
      switch ($(this).attr('id')) {
        case 'startDateEvaluation':
        if ($(this).val() <= now.getDate())
        {
            $('#ValidateStartDateEvaluation').addClass('d-block');
            $(this).addClass('is-invalid');
        }
        else
        {
            $(this).addClass('is-valid');
            $('#ValidateStartDateEvaluation').removeClass('d-block');
            $(this).removeClass('is-invalid');
        }
      break;
      case 'endDateEvaluation':
      if ($(this).val() < now.getDate() || $(this).val() < $('#startDateEvaluation').val())
        {
            $('#ValidateEndDateEvaluation').addClass('d-block');
            $(this).addClass('is-invalid');
        }
        else
        {
            $(this).addClass('is-valid');
            $('#ValidateEndDateEvaluation').removeClass('d-block');
            $(this).removeClass('is-invalid');
        }
      break;
      case 'startDateModule':
      if ($(this).val() <= now.getDate())
        {
            $('#ValidateStartDateModule').addClass('d-block');
            $(this).addClass('is-invalid');
        }
        else
        {
            $(this).addClass('is-valid');
            $('#ValidateStartDateModule').removeClass('d-block');
            $(this).removeClass('is-invalid');
        }
        break;
      case 'endDateModule':
      if ($(this).val() < now.getDate() || $(this).val() < $('#startDateModule').val())
        {
            $('#ValidateEndDateModule').addClass('d-block');
            $(this).addClass('is-invalid');
        }
        else
        {
            $(this).addClass('is-valid');
            $('#ValidateEndDateModule').removeClass('d-block');
            $(this).removeClass('is-invalid');
        }
        break;
      
       
      }
    });
    //selects
    $(document).on("change","select",function ()
    {
        if ($(this).attr('id') == 'professor')
        {
            if ($(this).val() != 0 )
            {
                $('#ValidateProfessor').removeClass('d-block');
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
            }
            else
            {
                $('#ValidateProfessor').addClass('d-block');
                $(this).addClass('is-invalid');
            }
        }
    })
    var form = document.getElementById('moduleRegister');
    form.addEventListener("submit",function (event)
    {
      event.preventDefault();
      event.stopPropagation();

      $.ajax({
          data: $('#moduleRegister').serialize(),
          url: "{{ route('diplomatModule') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            Toast.fire({
                    type: 'success',
                    title: 'Se ha registrador correctamente el Modulo.'
                });
              table.ajax.reload();
              $('#moduleRegister').trigger("reset");
              $('#modalmodule').modal('hide');
              $("input").removeClass("is-invalid");
              $("input").removeClass('is-valid');

          },
          error: function (error) {
            if(error.responseJSON.hasOwnProperty('errors'))
            {
              if (error.responseJSON.errors.professor)
              {
                $('#ValidateProfessor').addClass('d-block');
                $('#ValidateProfessor').html(error.responseJSON.errors.professor);
              }
              if(error.responseJSON.errors.name)
              {
                $('#moduleName').addClass('is-invalid');
                $('#ValidateName').html(error.responseJSON.errors.name)
              }
              if(error.responseJSON.errors.number)
              {
                $('#number').addClass('is-invalid');
                $('#ValidateNumber').html(error.responseJSON.errors.number)
              }
              if (error.responseJSON.errors.evaluation)
              {
                $('#ValidateEvaluation').addClass('d-block');
                $('#ValidateEvaluation').html(error.responseJSON.errors.evaluation);
              }
              if (error.responseJSON.errors.startDateEvaluation)
              {
                  $('#startDateEvaluation').addClass('is-invalid');
                  $('#ValidateStartDateEvaluation').addClass('d-block');
                  $('#ValidateStartDateEvaluation').html(error.responseJSON.errors.startDateEvaluation);
              }
              if (error.responseJSON.errors.endDateEvaluation)
              {
                  $('#endDateEvaluation').addClass('is-invalid');
                  $('#ValidateEndDateEvaluation').addClass('d-block');
                  $('#ValidateEndDateEvaluation').html(error.responseJSON.errors.endDateEvaluation);
              }
              if (error.responseJSON.errors.startDateModule)
              {
                $('#startDateModule').addClass('is-invalid');
                $('#ValidateStartDateModule').addClass('d-block');
                $('#ValidateStartDateModule').html(error.responseJSON.errors.startDateModule);
              }
              if (error.responseJSON.errors.endDateModule)
              {
                $('#endDateModule').addClass('is-invalid');
                $('#ValidateEndDateModule').addClass('d-block');
                $('#ValidateEndDateModule').html(error.responseJSON.errors.endDateModule);
              }
              if (error.responseJSON.errors.group)
              {
                $('#group').addClass('is-invalid');
                $('#ValidateGroup').html(error.responseJSON.errors.group);
              }
              if (error.responseJSON.errors.classroom)
              {
                $('#classroom').addClass('is-invalid');
                $('#ValidateClassroom').html(error.responseJSON.errors.classroom);
              }
            }
          }
      });
    })

   

    })
    
   
  
</script>

@endsection
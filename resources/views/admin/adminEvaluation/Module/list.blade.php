@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <h3>Diplomado: {{$name}}</h3>
      <input type="hidden" id="idDiplomat" value="{{$id}}">
      <div class="card-body table-responsive">
        <table class="dataTable table table-bordered table-hover" id="moduleTable">
          <thead>
            <tr>
              <th name="number">Numero Modulo</th>
              <th name="idProfessor">nombre docente</th>
              <th name="idDiplomat">Nombre Diplomado</th>
              <th name="idModule">Nombre modulo</th>
              <th name="turn">Turno</th>
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

{{-- Registrar solo Modulos --}}
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalmodule">
  Registrar Modulo
</button>



<!-- Modal -->
<div class="modal fade" id="modalmodule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="moduleRegister" method="POST" accion="{{ route('diplomatModule') }}">
          @csrf
          <div class="container">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="docentes">Docentes</label>
                <select id="docente" name="moduleData[docente]" class="custom-select">
                  <option selected>Seleccione el docente</option>
                  @foreach ($professors as $professor)
                  <option value="{{ $professor['idUser'] }}">{{ $professor['name'] }}</option>
                  @endforeach
                </select>
              </div>
              <input type="hidden" value="{{$id}}" name="moduleData[diplomat]">

              <div class="form-group col-md-6">
                <label for="moduleName">nombre modulo</label>
                <input type="text" id="moduleName" name="moduleData[moduleName]" class="form-control" id="inputName">
              </div>
              <div class="form-group col-md-6">
                <label for="moduleNumber">numero modulo</label>
                <input type="text" id="number" name="moduleData[moduleNumber]" class="form-control"
                  id="inputModuleNumber">
              </div>
              <div class="form-group col-md-6">
                <label for="turn">turno</label>
                <select id="turn" name="moduleData[turn]" class="custom-select">
                  <option selected>Seleccione el horario</option>
                  <option value="mañana">mañana</option>
                  <option value="tarde">tarde</option>
                  <option value="noche">noche</option>
                </select>
              </div>
              <div class="form-group col-md-12">
                <label for="evaluation">Evaluacion</label>
                <select id="evaluation" name="moduleData[evaluation]" class="custom-select">
                  <option selected>Seleccione la evaluacion</option>
                  @foreach ($evaluations as $diplomat)
                  <option value="{{ $diplomat['id'] }}">{{ $diplomat['name'] }}</option>
                  @endforeach

                </select>
              </div>

              <div class="form-group col-md-6">

                <label for="StartDate">fecha de inicio</label>
                <input type="date" id="startDate" name="moduleData[startDate]" class="form-control">

              </div>
              <div class="form-group col-md-6">
                <label for="endDate">fecha de finalizacion</label>
                <input type="date" id="endDate" name="moduleData[endDate]" class="form-control">

              </div>
              <div class="form-group col-md-6">
                <label for="group">Grupo: </label>
                <input type="text" id="group" name="moduleData[group]" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label for="classroomNumber">Aula: </label>
                <input type="text" id="classroomNumber" name="moduleData[classroomNumber]" class="form-control">
              </div>
            </div>
          </div>
          <button type="submit" id="saveModule" class="btn btn-primary">Registrar modulo</button>
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
        {data:'moduleTurn',name:'moduleTurn'},
        {data:'group',name:'group'},
        {data:'classRoom',name:'classRoom'},
        {data:'startDate',name:'startDate'}
      ]
    }) 
    $('#saveModule').click(function (e)
    {
        e.preventDefault();
        $.ajax({
          data: $('#moduleRegister').serialize(),
          url: "{{ route('diplomatModule') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log('Success:', data);
            table.ajax.reload();
            $('#moduleRegister').trigger("reset");
              $('#modalmodule').modal('hide');

          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
    })

   

    })
    
   
  
</script>

@endsection
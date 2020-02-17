@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <h3>Diplomado: {{$name}}</h3>
            <div class="card-body table-responsive">
                <table class="dataTable table table-bordered table-hover" id="questionTable">
                    <thead>
                        <tr>
                            <th>Texto</th>
                            <th name="id">N°</th>
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
        <form id="moduleRegister" method="POST" accion="{{ route('diplomatModule') }}" >
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
              <div class="form-group col-md-6">
                <label for="diplomat">Diplomados</label>
                <select id="diplomat" name="moduleData[diplomat]" class="custom-select">
                  <option selected>Seleccione el diplomado</option>
                  @foreach ($diplomats as $diplomat)
                      <option value="{{ $diplomat['id'] }}">{{ $diplomat['name'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="moduleName">nombre modulo</label>
                <input type="text" id="moduleName"name="moduleData[moduleName]" class="form-control" id="inputName">
              </div>
              <div class="form-group col-md-4">
                <label for="moduleNumber">numero modulo</label>
                <input type="text" id="number" name="moduleData[moduleNumber]" class="form-control" id="inputModuleNumber">
              </div>
              <div class="form-group col-md-4">
                <label for="turn">turno</label>
                <select id="turn" name="moduleData[turn]" class="custom-select">
                  <option selected>Seleccione el horario</option>
                    <option value="mañana">mañana</option>
                    <option value="tarde">tarde</option>
                    <option value="noche">noche</option>
                </select>
               </div>

              <div class="form-group col-md-6">
             
                <label for="StartDate">fecha de inicio</label>
                <input type="date" id="startDate"name="moduleData[startDate]" class="form-control" name="fecha">
             
            </div>     
            <div class="form-group col-md-6">
              <label for="endDate">fecha de finalizacion</label>
                <input type="date" id="endDate" name="moduleData[endDate]"  class="form-control" name="fecha">
             
            </div> 
            </div>
                
            <button type="submit"   id="saveModule" class="btn btn-primary">Registrar modulo</button>

          </div>
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
  
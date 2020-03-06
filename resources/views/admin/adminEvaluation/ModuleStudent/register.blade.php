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
                        <h1 class="m-0 text-dark">Modulo: {{$dataM->name}}</h1>
                    </div>
                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="modulesTable">
                    <thead>
                        <tr>
                            <th>Carnet Identidad</th>
                            <th>Nombre del Estudiante</th>
                            <th>Fecha de Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalstudent">
    Registrar Estudiante
</button>
<div class="modal fade" id="modalstudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form id="moduleStudent" name="moduleStudent" action="{{route('moduleStudent.store')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$dataM->id}}" id="idModule" name="idModule">
                    <select name="idStudent" id="idStudent" class="form-control custom-select">
                        <option value="0">Seleccione Estudiante</option>;
                        @foreach ($students as $student)
                        <option value="{{$student->id}}">{{$student->name}} {{$student->lastname}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success" type="submit">Registrar
                        Estudiante</button>
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
  var id = document.getElementById('idModule').value;
  var url = '{{ route("moduleStudent.listRegister","") }}';
    url+=`/${id}`;
  var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:url,
        columns: 
        [
            {data:'ci',name:'ci'},
            {data:'fullname',name:'fullname'},
            {data:'registerDate',name:'registerDate'}
        ]
    });
       //mensajes de confirmacion
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    //formulario
    var form = document.getElementById('moduleStudent');
    form.addEventListener("submit",function (event)
    {
        event.preventDefault();
        event.stopPropagation();
        $.ajax({
            type: "POST",
            url: "{{route('moduleStudent.store')}}",
            data: $('#moduleStudent').serialize(),
            dataType: "JSON",
            success: function (response) {
                if (response.error == "El estudiante ya fue registrado")
                {
                    Toast.fire({
                        type: 'error',
                        title: 'El estudiante esta registrado.'
                    })
                }
                else
                {
                    Toast.fire({
                        type: 'success',
                        title: 'Se ha registrado al estudiante.'
                    })
                    table.ajax.reload();
                    $('#ModuleStudent').trigger("reset");
                    $('#modalstudent').modal('hide');
                }

            }
        });
    })
//final del document ready
})
</script>
@endsection
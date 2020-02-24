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
                        <h1 class="m-0 text-dark">Modulos</h1>
                    </div>

                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="modulesTable">
                    <thead>
                        <tr>
                            <th>N° #</th>
                            <th>Nombre</th>
                            <th>Nombre del Diploma</th>
                            <th>Fecha de Inicio</th>
                            <th>idModule</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalModuleStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-12">
                        <div class="col-12">
                            <label for="name">Estudiantes: </label>
                        </div>
                        <div class="col-6">
                            <select class="form-control" name="idStudent" id="idStudent">
                                <option value="0">Seleccione Estudiante</option>
                                @foreach ($students as $student)
                                <option name="{{$student->name}} {{$student->lastname}}" id="{{$student->id}}"
                                    value="{{$student->id}}">{{$student->name}} {{$student->lastname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button id="SaveStudent" class="btn btn-primary" type="submit">Registrar Estudiante</button>
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
  var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:"{{route('modules.listDiplomat')}}",
        columns: 
        [
            {data:'number',name:'number'},
            {data:'name',name:'name'},
            {data:'nameD',name:'nameD'},
            {data:'startDate',name:'startDate'},
            {data:'DT_RowId',name:'DT_RowId',visible:false}
        ]
    });
    //click en la tabla
    var id;
    $('#modulesTable').on('click', 'tr', function () {
        id = table.row(this).id();
        if (id)
        {
            $('#modalModuleStudent').modal("show");
        }
        
    });
    //guardar los datos de ModuleStudent y Diplomat Student
    $('#SaveStudent').click(function (e)
    {
            e.preventDefault();
            //registrar Modulo Estudiante
            var idStudent=document.getElementById('idStudent').value;
            var url = '{{ route("moduleStudent.store","") }}';
                    url+=`/${id}`;
            //registrar modulo estudiante
            $.ajax({
                type: "POST",
                url: url,
                data:
                {idStudent:idStudent},
                dataType: "JSON",
                success: function (response) {
                    $('#modalModuleStudent').modal("hide");
                }
            });
            //REGISTRAR DIPLOMADO STUDENT
            var urlS = '{{ route("diplomatStudent.store","") }}';
            urlS+=`/${id}`;
            $.ajax({
                type: "POST",
                url: urlS,
                data: 
                {idStudent:idStudent},
                dataType: "JOSN",
                success: function (response) {
                    $('#modlModuleStudent').modal("hide");
                }
            });
    })
    

//final del document ready
})
</script>
@endsection
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
                        <h3>Categoria: {{$name}}</h3>
                        <input type="hidden" id="idCategory" name="{{$id}}" value="{{$id}}">
                    </div>
                    <div class="col-6">
                        <ol class="float-sm-right">
                            {{-- Registrar solo Categorias --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalquestion">
                                Registrar Preguntas
                            </button>   
                        </ol>
                    </div>
                </div>
                <table class="dataTable table table-bordered table-hover" id="questionTable">
                    <thead>
                        <tr>
                            <th>Texto</th>
                            <th>N°</th>
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
<div class="modal fade" id="modalquestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Pregunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="questionForm" name="questionForm" class="form-horizontal" method="POST"
                    action="{{route('questions.store')}}">
                    @csrf
                    <input type="hidden" name="idCategory" id="idCategory" value="{{$id}}">
                    <div class="form-group">
                        <label for="text">Texto</label>
                        <input type="text" class="form-control" name="text" id="text" aria-describedby="helpId"
                            placeholder="Ingrese nombre de Categoria">
                    </div>
                    <button id="saveQuestion" type="submit" class="btn btn-primary">Registrar Pregunta</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- MODAL DE CRUD DE QUESTIONS --}}
<div id="detailquestionModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Detalle de Pregunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <ul class="nav nav-tabs2 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tabQuestionDetail">Detalle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabUserEdit">Editar</a>
                    </li>
                    <li class="nav-item">
                        <a id="deleteQuestion" class="btn btn-danger text-white">Eliminar</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show vivify flipInX active" id="tabQuestionDetail">
                        <div class="row pt-4 px-3">
                            <div class="col-6 form-group">
                                <strong class="text-black">N°: </strong>
                                <span id="questionId" class=""></span>
                            </div>
                            <div class="col-6 form-group">
                                <strong class="text-black">Texto: </strong>
                                <span id="questionText"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane vivify flipInX" id="tabUserEdit">
                        <div class="pt-4 px-3">
                            {{-- aqui debe estar editar --}}
                            <form id="updateQuestion" name="updateQuestion" action="{{route('questions.update')}}"
                                method="POST" autocomplete="off">
                                @csrf
                                <input type="hidden" name="id" id="id" value="id">
                                <div class="form-group">
                                    <label for="text">Texto: </label>
                                    <input type="text" class="form-control" name="text" aria-describedby="helpId">
                                </div>
                                <button id="updateQuestionBtn" type="submit" class="btn btn-primary">Guardar
                                    Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
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
    var idCategory=document.getElementById('idCategory').value;
    var url = '{{ route("questions.list","") }}';
        url+=`/${idCategory}`;
    //ver los datos de las preguntas
    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:url,
        columns:[
            {data:'text',name:'text'},
            {data:'DT_RowId',name:'DT_RowId',visible:false}
        ]
    });
    //registrar Pregunta
    $('#saveQuestion').click(function (e)
    {
        e.preventDefault();
        $.ajax({
          data: $('#questionForm').serialize(),
          url: "{{ route('questions.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log('Success:', data);
              $('#questionForm').trigger("reset");
              $('#modalquestion').modal('hide');
              table.ajax.reload();

          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
    })
    //eliminar pregunta
    $('#deleteQuestion').click(function (e)
    {
        e.preventDefault();
        let id = document.getElementById('questionId');
        id = id.value;
        if (id)
        {
            console.log(id);
            var url = '{{ route("questions.delete","") }}';
            url+=`/${id}`;
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "JSON",
                success: function () {
                    console.log("Pregunta Eliminada");
                    $('#modalquestion').modal('hide');
                    table.ajax.reload();
                }
            });
        }
        else
        {
            console.log("No se logro eliminar la pregunta");
        }
        
    });
    //Ver detalles de modal de la pregunta
    $('#questionTable').on('click', 'tr', function () {
        var id = table.row(this).id();
        if (id)
        {
            CargarQuestion(id);
        }
        
    });
    function CargarQuestion(id) {
            var attr = $('#deleteQuestion').attr('id');

            if (typeof attr !== typeof undefined && attr !== false) {
                $('#deleteQuestion').data('id', id);//envia un valor
            } else {
                $('#deleteQuestion').attr('data-id', id);
            }

            $.ajax({
                type: "GET",
                url: "{{ route('questions.get') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: "JSON",
                success: function (data) {
                    $('#questionId').val(data.id);
                    $('#questionId').html(data.id);
                    $('#questionText').html(data.text);

                    $('#updateQuestion').find('input[name=id]').val(data.id);
                    $('#updateQuestion').find('input[name=text]').val(data.text);
                },
                error: function (err) {
                    console.log(err);
                    return false;
                },
                complete: function() {
                    $('#detailquestionModal').modal('show');
                }
            });

        }
        //actualizar pregunta
    $('#updateQuestionBtn').click(function (e)
    {
        e.preventDefault();
        $.ajax({
          data: $('#updateQuestion').serialize(),
          url: "{{ route('questions.update') }}",
          type: "POST",
          dataType: "JSON",
            success: function (data) {
                $('#updateQuestion').trigger("reset");
                $('#detailquestionModal').modal('hide');
                table.ajax.reload();
            },
            error: function(data)
            {
                console.log(error);
            }
        });
    });

//final del document ready
})
</script>

@endsection
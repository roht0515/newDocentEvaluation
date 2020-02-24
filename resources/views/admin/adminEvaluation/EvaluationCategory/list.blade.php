@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="text-center">
                    {{$name}}
                </h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<h3 class="px-5"> </h3>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-6">
                        <h3 class="m-0 text-dark">Categorias Asignadas:</h3>
                        <input type="hidden" id="idEvaluation" name="{{$id}}" value="{{$id}}">
                        {{-- ESTE ES EL ID DE LA EVALUACION --}}
                    </div>
                    <div class="col-6">
                        <ol class="float-sm-right">
                            <button id="showCategories" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modaluser">
                                Asignar Categorias
                            </button>
                        </ol>
                    </div>
                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="evaluationTable">
                    <thead>
                        <tr>
                            <th>Nombre de la Categoria</th>
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
<div class="modal fade" id="modaluser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Categorias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <select class="form-control" name="name" id="cbcategory">
                            {{-- AQUI SE LLENARAN LAS CAEGORIAS --}}
                            <option value="">Seleccione Categoria</option>
                            @foreach ($categories as $category)
                            <option name="{{$category->id}}" id="{{$category->id}}" value="{{$category->id}}">
                                {{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- AQUI SE VAN A VER LAS PREGUNTAS DE ESA CATEGORIA --}}
                <div class="row">
                    <div class="col-12">
                        <h5>Preguntas de la Categoria</h5>
                        {{-- ESTE UL ES TODAS LAS PREGUNTAS QUE SE CAMBIARAN MEDIANTE EL ONCHANGE DEL SELECT --}}
                        <ul id="questions">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveDate" type="submit" class="btn btn-primary">Asignar Categoria</button>
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
    var idEvaluation=document.getElementById('idEvaluation').value;
    var url = '{{ route("evaluationcategories.list","") }}';
        url+=`/${idEvaluation}`;
    //ver los datos de las preguntas
    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:url,
        columns:[
            {data:'nameCategory',name:'nameCategory'},
        ]
    });
    //ver las categorias
    $('#cbcategory').on('change',function()
    {
        $("#questions").empty();
        let id = this.value;//en el cbcategory su value es el ID de la categoria
        console.log(id);
        var url = '{{ route("evaluationcategories.listQuestion","") }}';
        url+=`/${id}`;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            success: function (response) {
                for (let x = 0; x< response.length; x++) 
               {
                    var li = document.createElement("li");
                    var text = document.createTextNode(response[x].text);
                    li.appendChild(text);                               
                    document.getElementById("questions").appendChild(li); 
               }  
            },
            error:function()
            {
                console.log(error);
            }
        });
    
    })
    //REGISTRAR EVALUACION Y CATEGORIA EN LA TABLA M-N
    $('#saveDate').click(function (e)
    {
        e.preventDefault();
        let idCategory=document.getElementById('cbcategory').value; //obtenemos el id de la cateogria
        let idEvaluation={{$id}};//obtenemos el id de la evaluacion que estamos registrando sus categorias
        console.log(idCategory);
        console.log(idEvaluation);
        $.ajax({
            type: "POST",
            url: "{{route('evaluationcategories.store')}}",
            data: 
            {
                _token: "{{ csrf_token() }}",
                    idCategory: idCategory,
                    idEvaluation:idEvaluation
            },
            dataType: "JSON",
            success: function (data) {
                table.ajax.reload();
                $('#modaluser').modal('hide');
            }
        });
    });

//final del document ready
})
</script>

@endsection
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
                        <h1 class="m-0 text-dark">{{$data->name}}</h1>
                        <input type="hidden" id="idEvaluation" name="idEvaluation" value="{{$data->id}}">
                    </div>
                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="evaluationTable">
                    <thead>
                        <tr>
                            <th>Pregunta</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <form id="evaluationState" name="evaluationState" method="post">
                    @csrf
                    <button class="btn btn-success swalDefaultSuccess" type="submit">Habilitar Evaluacion</button>

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
    //obtener los datos
    var id = document.getElementById('idEvaluation').value;
    var url = '{{ route("evaluations.getDatesState","") }}';
    url+=`/${id}`;
    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:url,
        columns:
        [
            {data:'text',name:'text'},
            {data:'name',name:'name'}
        ]
    });
    //mensajes de confirmacion
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    var form = document.getElementById('evaluationState');
    form.addEventListener("submit",function(event){
        event.preventDefault();
        event.stopPropagation();
        //cambiar el estado
        $.ajax({
            type: "POST",
            url: "{{route ('evaluations.changeState')}}",
            data:
            {
                _token: "{{ csrf_token() }}",
                    id: id
            },
            dataType: "JSON",
            success: function (response) {
                Toast.fire({
                    type: 'success',
                    title: 'Se habilitado la evaluacion.'
                });
                window.location.href="{{route('evaluations.listState')}}";
            },
            error:function(error)
            {
                Toast.fire({
                    type: 'error',
                    title: 'No se logro habilitar le evaluacion'
                })
            }
        });
    })



//final del document ready
})
</script>

@endsection
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
                    <input type="hidden" id="idSecretary" name="idSecretary" value="{{auth()->user()->id}}">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Diplomas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class=" float-sm-right">
                            <a href="{{route('certificates.registerdiplomat')}}" class="btn btn-primary">Registrar
                                Estudiante Capacitado</a>
                        </ol>
                    </div>
                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="certificateTable">
                    <thead>
                        <tr>
                            <th>Nombre del Trained</th>
                            <th>Certificado</th>
                            <th>Razon</th>
                            <th>Tipo de Entrega</th>
                            <th>id</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
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
    //ver los datos de la categorias
    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:"{{route('certificates.indexdiplomat')}}",
        columns: [
                {data:'fullname',name:'fullname'},  
                {data:'Nombrecito',name:'certificate.name'},
                {data:'reason',name:'certificate.reason'},
                {data:'Btns',name:'Btns'},
                {data:'DT_RowId',name:'DT_RowId',visible:false}
            ]    
    });
    $(document).on("click","button",function (event)
    {
        var id = $(this).attr("id");
        var tutor = $(this).text();
        if (tutor == "Tutor")
        {
        }
        else
        {
            var idSecretary=document.getElementById('idSecretary').value;
            event.preventDefault();
            event.stopPropagation();
            //agregar
            $.ajax({
                type: "POST",
                data:{
                    id:id,
                    idSecretary:idSecretary,
                    _token: "{{ csrf_token() }}"
                },
                url: '{{route("deliveryStudent.store")}}',
                dataType: "JSON",
                success: function (response) {
                    table.ajax.reload();
                },
                error:function(error)
                {
                    console.log(error);
                }
            });
        }
    })
})
</script>
@endsection
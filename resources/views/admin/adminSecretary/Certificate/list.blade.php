@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <input type="hidden" id="idSecretary" name="idSecretary" value="{{auth()->user()->id}}">
                <div class="row">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">Certificados</h1>
                    </div>
                    <div class="col-6">
                        <ol class=" float-sm-right">
                            <a href="{{route('certificates.register')}}" class="btn btn-primary">Registrar Estudiante
                                Capacitado</a>
                        </ol>
                    </div>
                </div>
                <br>
                <table class="dataTable table table-bordered table-hover" id="certificateTable">
                    <thead>
                        <tr>
                            <th>Nombre del Trained</th>
                            <th>Certificado</th>
                            <th>Motivo</th>
                            <th>Tipo de Entrega</th>
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
        ajax:"{{route('certificates.indexcertificate')}}",
        columns: [
                {data:'fullname',name:'fullname'},  
                {data:'Nombrecito',name:'certificate.name'},
                {data:'reason',name:'certificate.reason'},
                {data:'Btns',name:'Btns'}
            ]    
    });
        //mensajes de confirmacion
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    $(document).on("click","button",function (event)
    {
        var id = $(this).attr("id");
        var text = $(this).text();
        if(text != "Tutor")
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
                    Toast.fire({
                        type: 'success',
                        title: 'Entrega registrada correctamente.'
                    });
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
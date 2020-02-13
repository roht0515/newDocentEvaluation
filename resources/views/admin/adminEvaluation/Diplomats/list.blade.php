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
                <table class="dataTable table table-bordered table-hover" id="diplomatTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Version</th>
                            <th>Fecha de Inicio</th>
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
{{-- Registrar DIplomado --}}
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaldiplomat">
    Registrar Diplomado
</button>

<!-- Modal -->
<div class="modal fade" id="modaldiplomat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form id="diplomatForm" name="diplomatForm" class="form-horizontal" method="POST"
                    action="{{route('diplomats.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre: </label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                            placeholder="Ingrese nombre de Categoria">
                    </div>
                    <div class="form-group">
                        <label for="version">Version: </label>
                        <input type="number" class="form-control" name="version" id="version">
                    </div>
                    <div class="form-group">
                        <label for="startDate">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="startDate" id="startDate">
                    </div>
                    <button id="saveDiplomat" type="submit" class="btn btn-primary">Registrar Diplomado</button>
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
    //ver los datos de la categorias
    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:"{{route('diplomats.list')}}",
        columns:
        [
            {data:'name',name:'name'},
            {data:'version',name:'version'},
            {data:'startDate',name:'startDate'},
            {data:'DT_RowId',name:'DT_RowId',visible:false}
        ]        
    });
    $('#saveDiplomat').click(function (e)
    {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{route('diplomats.store')}}",
            data: $('#diplomatForm').serialize(),
            dataType: "JSON",
            success: function (data) {
                table.ajax.reload();
                $('#diplomatForm').trigger('reset');
                $('#modaldiplomat').modal('hide');
            }
        });
    })


//final del document ready
})
</script>

@endsection
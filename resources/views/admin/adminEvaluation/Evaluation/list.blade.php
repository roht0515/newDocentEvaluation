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
            <h1 class="m-0 text-dark">Evaluaciones</h1>
          </div>
          <div class="col-6">
            {{-- Registrar solo Evaluations --}}
            <ol class="float-sm-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalevaluation">
                Registrar Evaluaciones
              </button>
            </ol>
          </div>
        </div>
        <br>
        <table class="dataTable table table-bordered table-hover" id="evaluationTable">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Version</th>
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

<!-- Modal -->
<div class="modal fade" id="modalevaluation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Evaluacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="evaluationForm" name="evaluationForm" class="form-horizontal" method="POST"
          action="{{route('evaluations.store')}}" autocomplete="off">
          @csrf
          <div class="form-group">
            <label for="name">Nombre: </label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
              placeholder="Ingrese nombre de Evaluacion">
            <div id="ValidateName" class="invalid-feedback">
            </div>
          </div>
          <div class="form-group">
            <label for="version">Version: </label>
            <input type="number" class="form-control" name="version" id="version" aria-describedby="helpId"
              placeholder="Ingresar Version">
            <div id="ValidateVersion" class="invalid-feedback">
            </div>
          </div>
          <button id="BtnRegister" type="submit" class="btn btn-primary">Registrar Evaluacion</button>
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
        ajax:"{{route('evaluations.list')}}",
        columns:
        [
            {data:'name',name:'name'},
            {data:'version',name:'version'},
            {data:'DT_RowId',name:'DT_RowId',visible:false}
        ]        
    });
    //agregar y quitar clases para el control de los textobx
        $(document).on("keyup", "input", function () {
        if ($(this).val().length <= 0)
        {
            $(this).addClass('is-invalid');
        }
        else
        {
             $(this).removeClass("is-invalid");
             $(this).addClass("is-valid");
        }        
    });
    //mensajes de confirmacion
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    var form = document.getElementById('evaluationForm');
    form.addEventListener("submit",function (event)
    {
      event.preventDefault();
      event.stopPropagation();
      $.ajax({
        type: "POST",
        url: "{{route('evaluations.store')}}",
        data: $('#evaluationForm').serialize(),
        dataType: "JSON",
        success: function (data) {
          Toast.fire({
                    type: 'success',
                    title: 'Se registro correctamente la Evaluacion.'
          });
          table.ajax.reload();
          $('#evaluationForm').trigger('reset');
          $('#modalevaluation').modal('hide');
          $("input").removeClass("is-invalid");
          $("input").removeClass('is-valid');
        },
        error: function(error)
        {
          if(error.responseJSON.hasOwnProperty('errors'))
          {
            if (error.responseJSON.errors.name)
            {
                 $('#name').addClass('is-invalid');
                 $('#ValidateName').html(error.responseJSON.errors.name); 
            }
            if (error.responseJSON.errors.version)
            {
              $('#version').addClass('is-invalid');
                 $('#ValidateVersion').html(error.responseJSON.errors.version); 
            }
          }
        }
      });
    })
    //registrar Categorias 
    $('#evaluationTable').on('click', 'tr', function () {
        var id = table.row(this).id();
        if (id)
        {
            var url = '{{ route("evaluations.get","") }}';
            url+=`/${id}`;
            window.location.href=url;
        }
        
    });

//final del document ready
})
</script>

@endsection
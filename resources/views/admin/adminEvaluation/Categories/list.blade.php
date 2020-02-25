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
            <h1 class="m-0 text-dark">Categorias</h1>
          </div>
          <div class="col-6">
            {{-- Registrar solo Categorias --}}
            <ol class="float-sm-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcategory">
                Registrar Categorias
              </button>
            </ol>
          </div>
        </div>
        <br>
        <table class="dataTable table table-bordered table-hover" id="categoryTable">
          <thead>
            <tr>
              <th width="40%">Nombre</th>
              <th width="60%">Año Creacion</th>
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
<div class="modal fade" id="modalcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="categoryForm" name="categoryForm" class="form-horizontal" method="POST"
          action="{{route ('categories.store')}}" autocomplete="off">
          @csrf
          <div class="form-group">
            <label for="name">Nombre: </label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
              placeholder="Ingrese nombre de Categoria">
            <div id="ValidateName" class="invalid-feedback">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Registrar Categoria</button>
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
        ajax:"{{route('categories.list')}}",
        columns:
        [
            {data:'name',name:'name'},
            {data:'year',name:'year'},
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
    var form = document.getElementById('categoryForm');
    form.addEventListener("submit",function (event)
    {
      event.preventDefault();
      event.stopPropagation();

      $.ajax({
          data: $('#categoryForm').serialize(),
          url: "{{ route('categories.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            table.ajax.reload();
              $('#categoryForm').trigger("reset");
              $('#modalcategory').modal('hide');
              $("input").removeClass("is-invalid");
          $("input").removeClass('is-valid');

          },
          error: function (error) {
            if(error.responseJSON.hasOwnProperty('errors'))
            {
              if (error.responseJSON.errors.name)
              {
                 $('#name').addClass('is-invalid');
                 $('#ValidateName').html(error.responseJSON.errors.name); 
              }
            }
          }
      });
    })
    //click de la tabla
    $('#categoryTable').on('click', 'tr', function () {
        var id = table.row(this).id();
        if (id)
        {
            var url = '{{ route("categories.get","") }}';
            url+=`/${id}`;
            window.location.href=url;
        }
        
    });

//final del document ready
})
</script>

@endsection
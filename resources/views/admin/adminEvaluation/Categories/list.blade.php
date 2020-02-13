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
{{-- Registrar solo Categorias --}}
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcategory">
  Registrar Categorias
</button>

<!-- Modal -->
<div class="modal fade" id="modalcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="categoryForm" name="categoryForm" class="form-horizontal" method="POST"
          action="{{route ('categories.store')}}">
          @csrf
          <div class="form-group">
            <label for="name">Nombre: </label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
              placeholder="Ingrese nombre de Categoria">
          </div>
          <button id="saveCategory" type="submit" class="btn btn-primary">Registrar Categoria</button>
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
    //metodo post para registrar Categorias
    $('#saveCategory').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#categoryForm').serialize(),
          url: "{{ route('categories.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log('Success:', data);
              $('#categoryForm').trigger("reset");
              $('#modalcategory').modal('hide');
              table.ajax.reload();

          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
    });
    //click de la tabla
    $('#categoryTable').on('click', 'tr', function () {
        var id = table.row(this).id();
        if (id)
        {
            console.log(id);
            var url = '{{ route("categories.get","") }}';
            url+=`/${id}`;
            window.location.href=url;
        }
        
    });

//final del document ready
})
</script>

@endsection
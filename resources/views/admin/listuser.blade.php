@extends('layouts.adminLayout')
@section('content')
<div class="container-fluid">
  <div class="row p-3">
    <div class="col-10">
      <h3>Lista de Usuarios</h3>
    </div>
    <div class="col-2">
      <button id="btnRegister" type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal"
        data-target="#modeluser">Registrar</button>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body table-responsive">
          <table class="dataTable table table-bordered table-hover" id="usertable">
            <thead class="bg-primary">
              <tr>
                <th>Username</th>
                <th>Correo Electronico</th>
                <th>Id #</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--Modal -->
  <div class="modal fade" id="modeluser">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formuser" action="{{route('users.store')}}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input autocomplete="off" name="username" type="text" class="form-control" placeholder="Enter username">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input autocomplete="off" name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Rol</label>
              <input autocomplete="off" name="role" type="text" class="form-control" placeholder="role">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Email</label>
              <input autocomplete="off" name="email" type="email" class="form-control" placeholder="email">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button id="SaveDates" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
@endsection
<!--SECCION PÁRA CODIGO JS--->
@section('script')
<script>
  $(function()
{
  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': '{{csrf_token()}}'
          }
    });
    var usertable=$('.dataTable').DataTable({
            serverside:true,
            processing: true,
            ajax:"{{ route('users.list') }}",
            columns: [{
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'DT_RowId',
                    name: 'DT_RowId',
                    visible: false
                }
            ],
            language: {
                "info":"_TOTAL_ Registros",
                "search":"Buscar",
                "paginate":{
                    "next":"Siguiente",
                    "previous":"Anterior",
                },
                "lengthMenu":'Mostrar <select>'+
                '<option value="10">10</option>'+
                '<option value="20">20</option>'+
                '<option value="-1">Todo</option>'+
                '</select> Registros',
                "loadingRecords":"Cargando...",
                "processing":"Procesando...",
                "zeroRecords":"No existen registros",
                "infoEmpty":"",
                "infoFiltered":""

            }
        });

    //insertar datos
$('#formuser').submit(function(e){
  e.preventDefault();
  
  var data = $(this).serialize();
  var url = '{{route('users.store')}}'

  console.log(data);
  $.ajax({
    type:"POST",
    url:url,
    data :data,
    dataType:"JSON",
    success:function(response)
    {
      $('#formuser').trigger('reset');
      $('#modeluser').modal('hide');
      $('.dataTable').DataTable().ajax.reload();
      
    },
    error:function(error)
    {
      console.log(error);

    }

  })
})
    
})

</script>
@endsection
@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="dataTable table table-bordered table-hover" id="usertable">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Ocupacion</th>
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
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaluser">
    Registrar Usuario
</button>

<!-- Modal -->
<div class="modal fade" id="modaluser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form id="userForm" name="userForm" class="form-horizontal" method="POST"
                    action="{{route('users.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter Password" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="role">
                                <option>Seleccione tipo de usuario</option>
                                <option id="role" name="Administrador" value="Administrador">Administrador</option>
                                <option id="role" name="Administrador Secretaria" value="Administrador Secretaria">
                                    Administrador de Secretaria</option>
                                <option id="role" name="Adminstrador Evaluacion" value="Administrador de Evaluacion">
                                    Administrador de Evaluacion</option>
                                <option id="role" name="Docente" value="Docente">Docente</option>
                                <option id="role" name="Estudiante" value="Estudiante">Estudiante</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">E-mail</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter E-mail"
                                value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!--SECCION PÁRA CODIGO JS--->
@section('script')
<script>
    $(document).ready(function (){
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        ajax:"{{route('users.list')}}",
        columns: [{
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data:'role',
                    name:'role'
                
                },
                {
                    data: 'DT_RowId',
                    name: 'DT_RowId',
                    visible:false
                }
            ]
    });
    //modal de Usuario
    $('#saveBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#userForm').serialize(),
          url: "{{ route('users.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log('Success:', data);
              $('#userForm').trigger("reset");
              $('#modaluser').modal('hide');
              table.ajax.reload();

          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
    });
})
</script>
@endsection
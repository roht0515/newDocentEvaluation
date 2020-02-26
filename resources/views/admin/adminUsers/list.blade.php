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
                    <div class="col-6">
                        <h1 class="m-0 text-dark">Usuarios</h1>
                    </div>
                    <div class="col-6">
                        {{-- Registrar Estidiante --}}
                        <ol class=" float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaluser">
                                Registrar Usuario
                            </button>
                        </ol>
                    </div>
                </div>
                <br>
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
                    action="{{route('users.store')}}" autocomplete="off" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-12">
                            <input name="username" type="text" class="form-control " id="username"
                                placeholder="Ingrese nombre de usuario">
                            <div id="ValidateUser" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-12">
                            <input name="password" type="password" class="form-control" id="password"
                                placeholder="Ingrese su contraseña">
                            <div id="ValidatePassword" class="invalid-feedback">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="role" id="role">
                                <option value="0">Seleccione tipo de usuario</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Administrador Secretaria">
                                    Administrador de Secretaria</option>
                                <option value="Administrador de Evaluacion">
                                    Administrador de Evaluacion</option>
                            </select>
                            <div id="ValidateRole" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">E-mail</label>
                        <div class="col-sm-12">
                            <input name="email" type="text" class="form-control" id="email"
                                placeholder="Ingrese su Correo Electronico">
                            <div id="ValidateEmail" class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Registrar usuario
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
{{-- AJAX --}}
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
    //agregar y quitar clases
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
    $(document).on("change","select",function ()
    {
        if ($(this).val() != 0 )
        {
            $('#ValidateRole').removeClass('d-block');
             $(this).removeClass("is-invalid");
             $(this).addClass("is-valid");
        }
        else
        {
            $('#ValidateRole').addClass('d-block');
            $(this).addClass('is-invalid');
        }
    })
    var form = document.getElementById('userForm');
    form.addEventListener(
        "submit",function (event)
        {
            $("input").removeClass("is-invalid");
            event.preventDefault();
            event.stopPropagation();
            //ajax de registros
            $.ajax({
                data: $('#userForm').serialize(),
                url: "{{ route('users.store') }}",
                cache:false,
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $("input").removeClass("is-valid");
                    $('#userForm').trigger("reset");
                    $('#modaluser').modal('hide');
                    table.ajax.reload();
                },
                error: function (error) {
                         //valido que llegue errors
                        if(error.responseJSON.hasOwnProperty('errors')){
                            if(error.responseJSON.errors.username){
                                $('#username').addClass('is-invalid');
                                $('#ValidateUser').html(error.responseJSON.errors.username);
                            }
                            if(error.responseJSON.errors.password)
                            {
                                $('#password').addClass('is-invalid');
                                $('#ValidatePassword').html(error.responseJSON.errors.password);
                            }
                            if(error.responseJSON.errors.role)
                            {
                                $('#ValidateRole').addClass('d-block');
                                $('#ValidateRole').html(error.responseJSON.errors.role);
                            }
                            if (error.responseJSON.errors.email)
                            {
                                $('#email').addClass('is-invalid');
                                $('#ValidateEmail').html(error.responseJSON.errors.email);
                            }
                        }
                }
            });
            
        }
    );
})
</script>
@endsection
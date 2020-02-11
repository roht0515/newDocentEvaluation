@extends('layouts.adminLayout')
@section('meta')

@endsection
@section('content')

<div class="container">
  <div class="row">

    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Registro de diplomados</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre:</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nombre del diplomado">
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="exampleInputPassword1">Version</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Version del diplomado">
              </div>
              <div class="form-group col-6">
                <label for="exampleInputPassword1">fecha de inicio</label>
                <input type="date" class="form-control" name="fecha">
              </div>

            </div>


          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
          </div>
        </form>
      </div>
    </div>



    <div class="col-6">

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Registro de modulos</h3>
        </div>
        <!-- /.card-header -->

        <form>
          <div class="container">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Docentes</label>
                <select class="custom-select">
                  <option selected>Seleccione el docente</option>
                  <option value="1">Carlos angulo</option>
                  <option value="2">Ericka ergueta</option>
                  <option value="3">Pablo muñoz</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Diplomados</label>
                <select class="custom-select">
                  <option selected>Seleccione el diplomado</option>
                  <option value="1">Diplomado 1</option>
                  <option value="2">Diplomado 2</option>
                  <option value="3">Diplomado 3</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">nombre modulo</label>
                <input type="text" class="form-control" id="inputName">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">numero modulo</label>
                <input type="text" class="form-control" id="inputModuleNumber">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">turno</label>
                <input type="text" class="form-control" id="inputTurn">
              </div>

              <div class="form-group col-md-6">

                <label for="exampleInputPassword1">fecha de inicio</label>
                <input type="date" class="form-control" name="fecha">

              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">fecha de finalizacion</label>
                <input type="date" class="form-control" name="fecha">

              </div>
            </div>

            <button type="submit" class="btn btn-primary">Registrar modulo</button>

          </div>
        </form>
      </div>

    </div>

    <div class="col-6">

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Registro de docentes</h3>
        </div>
        <!-- /.card-header -->

        <form>
          <div class="container">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="ci">Ci</label>
                <input type="text" class="form-control" id="inputName">
              </div>
              <div class="form-group col-md-4">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="inputModuleNumber">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">Apellidos</label>
                <input type="text" class="form-control" id="inputTurn">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">Correo</label>
                <input type="text" class="form-control" id="inputName">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">Telefono</label>
                <input type="text" class="form-control" id="inputModuleNumber">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">Direccion</label>
                <input type="text" class="form-control" id="inputTurn">
              </div>

              <div class="form-group col-md-4">

                <label for="exampleInputPassword1">Carrera</label>
                <input type="text" class="form-control" name="fecha">

              </div>
              <div class="form-group col-md-4">

                <label for="exampleInputPassword1">turno</label>

                <select class="custom-select">
                  <option selected>turno</option>
                  <option value="1">mañana </option>
                  <option value="2">tarde</option>
                  <option value="3">noche</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="startDate">fecha de inicio</label>
                <input type="date" class="form-control" name="fecha">

              </div>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Docente</button>

          </div>
        </form>
      </div>

    </div>




    <div class="col-12">



      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Modulos registrados</h3>

        </div>

        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Modulo</th>
                <th>Docente</th>
                <th>Diplomado</th>
                <th>fecha inicio</th>
                <th>fecha de finalizacion</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Ericka Ergueta
                </td>
                <td>ethical hacking</td>
                <td>01-02-2020</td>
                <td>04-03-2020</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Ericka Ergueta
                </td>
                <td>ethical hacking</td>
                <td>04-03-2020</td>
                <td>05-04-2020</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Ericka Ergueta
                </td>
                <td>ethical hacking</td>
                <td>05-05-2020</td>
                <td>02-06-2020</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>Modulo</th>
                <th>Docente</th>
                <th>Diplomado</th>
                <th>fecha inicio</th>
                <th>fecha de finalizacion</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->

      </div>
    </div>
  </div>
</div>


<script>
  var modules =0;

          function moduleDelete(id){
            $(`#${id}`).remove();
        }

</script>

@endsection
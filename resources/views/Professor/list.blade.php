@extends('layouts.professorLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="col-12">
    <br>
    <div class="card">
        <div class="card-header  ">
          <h3 class="card-title">Lista estudiantes</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="datatable table table-hover text-nowrap ">
            <thead class="bg-dark">
              <tr>
                <th width="10%">#</th>
                <th width="70%">Nombre</th>
                <th width="20%">Realizado</th>
              </tr>
            </thead>
            <tbody>
             
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
</div>


@endsection
@section('script')
<script>
    $(document).ready(function ()
{
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})
</script>
@endsection
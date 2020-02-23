@extends('layouts.studentLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<input type="hidden" id="idUser" name="idUser" value="{{auth()->user()->id}}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="dataTable table table-bordered table-hover" id="moduleTable">
                    <thead>
                        <tr>
                            <th>N#</th>
                            <th>Nombre</th>
                            <th>Diplomado</th>
                            <th>Fecha de Evalauacion</th>
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
@extends('layouts.studentLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<input type="hidden" id="idUser" name="idUser" value="{{auth()->user()->id}}">
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h3> Evaluacion Docente</h3>
                        <table class="dataTable table table-bordered table-hover" id="moduleTable">
                            <thead>
                                <tr>
                                    <th>N#</th>
                                    <th>Nombre Modulo</th>
                                    <th>Diplomado</th>
                                    <th>Fecha de Evalauacion</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
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
    //var datatable
    var id = document.getElementById('idUser').value;
    var url = '{{ route("student.module","") }}';
    url+=`/${id}`;
    var table=$('.dataTable').DataTable({
        serverside:true,
        processing:true,
        paging:   false,
        ordering: false,
        info:     false,
        searching:false,
        ajax:url,
        columns:
        [
            {data:'number',name:'number'},
            {data:'moduleName',name:'moduleName'},
            {data:'diplomatName',name:'diplomatName'},
            {data:'startDateEvaluation',name:'startDateEvaluation'},
            {data:'buttons',name:'buttons'}
          
        ]        
    });

   
})
</script>
@endsection
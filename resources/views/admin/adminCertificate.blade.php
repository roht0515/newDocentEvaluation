@extends('layouts.adminLayout')
@section('meta')

@endsection
@section('content')
<!-- datatable con todos los certificados -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="dataTable table table-bordered table-hover" id="diplomattable">
                        <thead class="bg-primary">
                            <tr>
                                <th>Nombre Trained</th>
                                <th>Certificado</th>
                                <th>Tipo</th>
                                <th>Razon</th>
                                <th>Fecha de Entrega</th>
                                <th>Fecha creada</th>
                                <th>ID</th>
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
@endsection
@section('script')
<script>
    $(function()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        var certificatetable=$('.dataTable').DataTable({
            serverside:true,
            processing:true,
            ajax:"{{route('certificate.list')}}",
            columns:[
                {data:'idTrained',name:'idTrained'},
                {data:'name',name:'name'},
                {data:'type',name:'type'},
                {data:'reason',name:'reason'},
                {data:'delivered',name:'delivered'},
                {data:'dateMade',name:'dateMade'},
                { data: 'DT_RowId', name: 'DT_RowId', visible: false }
            ]
        });
    })
</script>
@endsection
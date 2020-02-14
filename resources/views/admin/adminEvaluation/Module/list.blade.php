@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <h3>Diplomado: {{$name}}</h3>
            <div class="card-body table-responsive">
                <table class="dataTable table table-bordered table-hover" id="questionTable">
                    <thead>
                        <tr>
                            <th>Texto</th>
                            <th name="id">N°</th>
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

@endsection
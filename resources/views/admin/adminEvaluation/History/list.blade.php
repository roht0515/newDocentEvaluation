@extends('layouts.adminLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<!-- datatable con nombre del diplomado (carrera), 
    numero modulo, 
    nombre docente, 
    nota promedio evaluationStudent 
    suma de total de notas / total de que tengan el mismo ID 
    boton de registro -->
@endsection
@section('script')
<script>
    $(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
})
</script>
@endsection
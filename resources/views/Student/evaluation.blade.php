@extends('layouts.studentLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h3>Modulo: {{$evaluation->ModuleName}}</h3>
                        <table class="dataTable table table-bordered table-hover" id="questionsTable">
                            <thead>
                                <tr>
                                    <th>Pregunta</th>
                                    <th class="text-center">Nunca</th>
                                    <th class="text-center">Poco</th>
                                    <th class="text-center">Regular</th>
                                    <th class="text-center">General</th>
                                    <th class="text-center">Siempre</th>
                                    <th>IdQuestion</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="{{route('evaluationStudent.store')}}" id="formEvaluationStudent" name="formEvaluationStudent"
                    method="post">
                    @csrf
                    <input type="hidden" id="count" name="count" value="{{$count}}">
                    {{-- DEBEMOS TENER 3 COLUMNAS PARA DIFRENCIA --}}
                    <input type="hidden" id="idStudent" name="idStudent" value="{{$evaluation->idS}}">
                    <input type="hidden" id="idEvaluationM" name="idEvaluationM" value="{{$evaluation->idEM}}">
                    {{-- PARA BUSCAR LA EVALUACION --}}
                    <input type="hidden" id="idEvaluation" name="idEvaluation" value="{{$evaluation->id}}">
                    <input type="hidden" id="score" name="score" value="">
                    <button id="SaveDates" class="btn btn-primary">Guardar Evaluacion</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function ()
{    
    function validarFormulario(){
          $("#formEvaluationStudent").validate();
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var id = document.getElementById('idEvaluation').value;
    var url = '{{ route("student.questions","") }}';
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
            {data:'text',name:'text'},
            {data:'p1',name:'p1',orderable: false, searchable: false},
            {data:'p2',name:'p2',orderable: false, searchable: false},
            {data:'p3',name:'p3',orderable: false, searchable: false},
            {data:'p4',name:'p4',orderable: false, searchable: false},
            {data:'p5',name:'p5',orderable: false, searchable: false},
            {data:'DT_RowId',name:'DT_RowId',visible:false}

        ]
    });
    var form = document.getElementById('formEvaluationStudent');
    form.addEventListener("submit",function (event)
    {
        validarFormulario();
        event.preventDefault();
        event.stopPropagation();
        var count = document.getElementById('questionsTable').rows.length;
        var t='question';
        var res=0;
        //recorrer el total de preguntas a tener
        for (var x=1;x<=count;x++) {
            var question = document.getElementsByName(t+x);
            //recorrer todos los radios si estan chequeados
            for (var y=0;y<question.length;y++)
            {
                if (question[y].checked == true)
                {
                    res = parseInt (res) + parseInt(question[y].value);
                }
            }
            
        }
        
            document.getElementById('score').value=res;
                $.ajax({
                data: $('#formEvaluationStudent').serialize(),
                url: "{{ route('evaluationStudent.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    var url = "{{route('student.mainIndex')}}"
                    window.location.href=url;

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        

    });

   
})
</script>
@endsection
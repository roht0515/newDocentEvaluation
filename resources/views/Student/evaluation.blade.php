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
                <form action="{{route('evaluationStudent.store')}}" id="formEvaluationStudent"
                    name="formEvaluationStudent" method="post">
                    @csrf
                    {{-- Contador de preguntas --}}
                    <input type="hidden" id="CountQuestion" name="CountQuestion" value="{{$questioncount}}">
                    {{-- DEBEMOS TENER 3 COLUMNAS PARA DIFRENCIA --}}
                    <input type="hidden" id="idModuleStudent" name="idModuleStudent" value="{{$evaluation->idMS}}">
                    {{-- PARA BUSCAR LA EVALUACION --}}
                    <input type="hidden" id="idEvaluation" name="idEvaluation" value="{{$evaluation->idE}}">
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
            {data:'nunca',name:'nuca',orderable: false, searchable: false},
            {data:'poco',name:'poco',orderable: false, searchable: false},
            {data:'regular',name:'regular',orderable: false, searchable: false},
            {data:'general',name:'general',orderable: false, searchable: false},
            {data:'siempre',name:'siempre',orderable: false, searchable: false},
            {data:'DT_RowId',name:'DT_RowId',visible:false}

        ]
    });
    //mensajes de confirmacion
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    var questionId = [];
    var points = [];
    var form = document.getElementById('formEvaluationStudent');
    form.addEventListener("submit",function (event)
    {
        var res=0;
        validarFormulario();
        event.preventDefault();
        event.stopPropagation();
        var count = document.getElementById('questionsTable').rows.length;
        //recorrer el total de preguntas a tener
        for (var x=0;x<count;x++) 
        {
            var question=document.getElementsByName(x);
            //recorrer todos los radios si estan chequeados
           for (var y=0;y<question.length;y++)
            {
                if (question[y].checked == true)
                {
                    res = parseInt (res) + parseInt(question[y].value);
                    //guardamos el id de la pregunta y el puntaje de cada pregunta
                    questionId [x] = question[y].getAttribute('name');
                    points[x] = question[y].value;
                }
            }
            
        }
        //insertar categoria por categoria
        var modulestudent=document.getElementById('idModuleStudent').value;
        recursiveAjax(questionId,points,modulestudent,1);
        //ejecutar el total
        //agregar el res total a un input
        document.getElementById('score').value=res;
        res = 0;
        });
//funcion recursiva recibe el arreglo de los id de las preguntas 
//los puntos y el modulo y la posicion en q se movera
function recursiveAjax(questionId,points,modulestudent,pos)
{
    if (pos < questionId.length)
    {

        var idQuestion=questionId[pos];
        var scoreCategory = points[pos];
        $.ajax({
        type: "POST",
        url: "{{route('evaluationnotes.store')}}",
        data: 
        {
            idQuestion:idQuestion,
            idModuleStudent:modulestudent,
            scoreCategory:scoreCategory,
            _token: "{{ csrf_token() }}"

         },
        dataType: "JSON",
        cache:false,
        success: function (response) {
            recursiveAjax(questionId,points,modulestudent,pos+1);
            if (pos == questionId.length -1)
            {
                $.ajax({
                data: $('#formEvaluationStudent').serialize(),
                url: "{{ route('evaluationStudent.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    Toast.fire({
                    type: 'success',
                    title: 'Evaluacion Completa.'
                });
                    var url = "{{route('student.mainIndex')}}"
                    window.location.href=url;
                    

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            }
        },
        error:function(error)
        {
         console.log(error);
        }
        });

    }

}
})
</script>
@endsection
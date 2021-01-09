$(document).ready(function(){
    // Set the date we're counting down to
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
    
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
    
            display.textContent = minutes + ":" + seconds;
            console.log(timer);
            if (--timer <= 0) {
                timer = duration;
                let respuestas = getRespuesta();
                $.ajax({
                    method:"POST",
                    url:"server-side/saveTest.php",
                    dataType:"json",
                    data:{
                        respuestas:respuestas,
                        nombre:$('#nombre').val(),
                        puesto:$('#puesto').val(),
                        nivel:$('#nivel').val()
                    },
                    success:function(response){
                        if(response.status == 200){
                            $('#success').modal('show');
                        }else{
                            $('#error').modal('show');
                        }
                    }
                })
            }
        }, 1000);
    }
    
    window.onload = function () {
        var fiveMinutes = 60 * 90,
            display = document.querySelector('#timer');
        startTimer(fiveMinutes, display);
    };

    let html = "";
    $.ajax({
        method:"POST",
        url:"server-side/getQuestions.php",
        dataType:"json",
        success:function(response){
            response.forEach(element => {
                if(element.Url != ''){
                    html += '<div class="form-group preguntas" >'+
                            '<label>'+element.Pregunta+'</label><br>'+
                            '<img src = '+element.Url+'>'+
                            '<input type ="hidden" class="idPregunta"  value = '+element.idPregunta+'>'+
                            '<textarea class ="form-control respuesta" rows="5"></textarea>'+
                        '</div>';
                }else{
                    html += '<div class="form-group preguntas">'+
                        '<label>'+element.Pregunta+'</label>'+
                        '<input type ="hidden" class="idPregunta"  value = '+element.idPregunta+'>'+
                        '<textarea class ="form-control respuesta" rows="5"></textarea>'+
                    '</div>';
                }  
            });
            $('#cuestionario').html(html);
            console.log(response);
        }
    })
})

function saveQs(){
    if($('#nombre').val()=='' || $('#puesto').val() == '' || $('#nivel').val() ==''){
        $('#modal').modal('show');
    }else{
        let respuestas = getRespuesta();
        $.ajax({
            method:"POST",
            url:"server-side/saveTest.php",
            dataType:"json",
            data:{
                respuestas:respuestas,
                nombre:$('#nombre').val(),
                puesto:$('#puesto').val(),
                nivel:$('#nivel').val()
            },
            success:function(response){
                if(response.status == 200){
                    $('#success').modal('show');
                }else{
                    $('#error').modal('show');
                }
            }
        })
    }
}

function reload(){
    location.reload();
}

function getRespuesta(){
    let preguntas = [];
    $(".preguntas").each(function (index, value) {
        let idPregunta = $(this).find('.idPregunta').val();
        let respuesta = $(this).find('.respuesta').val();
        preguntas.push({
            idPregunta: idPregunta,
            respuesta: respuesta,
        });
    })
    return preguntas;
}

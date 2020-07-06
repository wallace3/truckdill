$(document).ready(function(){ 
    getServices();
})

function getServices()
{    
    info = "";
    $.ajax({
        method:"POST",
        url:"services/getAllServices",
        dataType:"json",
        success:function(response){
            response.data.data.forEach(element => {
                info += '<div class="custom-control custom-checkbox">'+
                '<input type = "checkbox" class="custom-control-input services"  id='+element.Service+' name="services" value="'+element.ID_Service+'">'+
                '<label class="custom-control-label" for='+element.Service+' >'+element.Service+'</label></div>';
            });
            $('#infoServices').html(info);
            console.log(response);
        }
    })
}

function addSupplier(){
    var services = [];
    $.each($("input[name='services']:checked"), function(){
        services.push($(this).val());
    });
    $.ajax({
        method:"POST",
        url:"services/addSupplier",
        dataType:"json",
        data:{
            services:services,
            user:$('#user').val(),
            password:$('#password').val(),
            email:$('#email').val(),
            rfc:$('#rfc').val(),
            legal:$('#legal').val(),
            supplier:$('#supplier').val()
        },
        success:function(response){
            if(response.data.data == 1){
                $('#successModal').modal('show');
                clear();
            }else{
                $('#errorModal').modal('show');
            }
        }
    })
}

function clear(){
    $('#user').val('');
    $('#password').val('');
    $('#email').val('');
    $('#rfc').val('');
    $('#legal').val('');
    $('#supplier').val('');
    $(".services").each(function(){
        $(this).prop("checked",false);
    });
    //$('input[name=services]').attr('checked', false);
}
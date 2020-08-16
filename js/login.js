$(document).ready(function() {
    $('#login').on('click', function(e){
        e.preventDefault();
        $.post('services/login_service', {username: $('#user').val(), password: $('#password').val()}, function(data){
            try{
                var res = JSON.parse(data);
            }catch{
                $('#error-user').modal('show');
                return;
            }
            
            if(res.status == 200){
                console.log(res.data);
                window.location.href = "index.php";
            }else{
                if(res.status == 1001){
                    $('#error-user').show();
                    $('#error-pass').hide();
                }else if(res.status == 1002){
                    $('#error-pass').show();
                    $('#error-user').hide();
                }
                $('#error-user').modal('show');
            }
                
        });
    }); 
    
    $('#changePassword').on('click',function(){
        $.ajax({
            method:"POST",
            dataType:"json",
            url:"services/changePasswordUsername",
            data:{
                email:$('#emailUser').val()
            },
            success:function(response){
                if(response.status == 200){
                    $('#exito').modal('show');
                }else{ 
                    $('#error').modal('show');
                }
            }
        })
    })

});

function changediv(){
    $('.container-login').hide();
    $('.container-forgot').show();
}

function confirm(){
    $('.container-login').show();
    $('.container-forgot').hide();
    $('#exito').modal('hide');
}



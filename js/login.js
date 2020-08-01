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
        console.log("si entra");
        console.log($('#userchange').val());
        if($('#passwordNew').val() === $('#confirmpasswordNew').val()){
            $.ajax({
                method:"POST",
                dataType:"json",
                url:"services/changePasswordUsername",
                data:{
                    username:$('#userchange').val(),
                    pass:$('#passwordNew').val()
                },
                success:function(response){
                    if(response.status == 200){
                        $('#exito').modal('show');
                    }else{ 
                        $('#error').modal('show');
                    }
                }
            })
        }else{
            $('#pass').modal('show');
        }
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



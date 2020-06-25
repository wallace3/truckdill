$(document).ready(function() {
    $('#login').on('click', function(e){
        e.preventDefault();
        $.post('services/login_service', {username: $('#user').val(), password: $('#password').val()}, function(data){
            try{
                var res = JSON.parse(data);
            }catch{
                show_toast('Error del Sistema', 'Estamos presentado problemas técnicos. Intenta más tarde', 'error');
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
                show_toast('Error de Ingreso', res.message, 'warning');
            }
                
        });
    });  
});
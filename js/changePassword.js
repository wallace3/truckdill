$('#change').on('click',function(){
    if($('#password').val() === $('#passwordConfirm').val()){
        $.ajax({
            method:"POST",
            dataType:"json",
            url:"services/changePassword",
            data:{
                pass:$('#password').val()
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

function logout(){
    window.location.href = 'logout';
}

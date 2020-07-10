$("#passwordConfirm" ).keyup(function(){
    if($('#password').val() === $('#passwordConfirm').val()){
        alert('ES igual');
    }else{
        alert('no es igual');
    }
});
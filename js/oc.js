$(document).ready(function() {

    
    $('.total_u').each(function(){
        var sum = 0;
        $('.total_u').each(function() {
            sum += Number($(this).val());
        });
        $('#subtotal').val(sum);
    })
    
    $('.materiales_tr .preciou').keyup(function(){
        let number;
        number = $(this).parent().parent().find('.cantidad').val() * $(this).parent().parent().find('.preciou').val();
        console.log(number);
        console.log($(this).parent().parent().find('.cantidad').val()); 
        $(this).parent().parent().find('.total_u').val(number);

    })

    $('#iva').keyup(function(){
        var total;
        total = (($('#iva').val()*$('#subtotal').val())+Number($('#subtotal').val()));
        $('#total').val(total);
    })

    $('#guardar').on('click',function(){
        materiales=[];
        $(".materiales_tr").each(function (index) {
            var mat = [];
            mat.push($(this).find('.partida').val(),$(this).find('.cantidad').val(),$(this).find('.unidad').val(),$(this).find('.descripcion').val(),$(this).find('.preciou').val(),$(this).find('.total_u').val());
            materiales.push(mat);
        })
        console.log(materiales);
        $.ajax({
            method:"POST",
            url:"services/saveOc",
            dataType:"json",
            data:{
                materiales:materiales,
                condiciones:$('#condiciones').val(),
                cot:$('#cot').val(),
                entrega:$('#entrega').val(),
                total:$('#total').val(),
                subtotal:$('#subtotal').val(),
                iva:$('#iva').val(),
                lugar:$('#lugar').val(),
                proveedor:$('#proveedor').val(),
                depto:$('#depto').val(),
                folio:$('#folio').val(),
                economico:$('#economico').val(),
                equipo:$('#equipo').val(),
                proyecto:$('#proyecto').val()
            },success:function(response){
                if(response.status == 200){
                    window.location.href = "ordenes";
                }else{
                    $('#errorModale').modal('show');
                }
                console.log(response);
            }
        })
    })

  

      
})
$(document).ready(function(){

    $('input[type="file"]').change(function(e){
        console.log(e.target.files);
    
        var fileName = e.target.files[0].name;
        console.log(fileName);
        
        $('#fileName').text(fileName);
        var file_data = e.target.files;  
        var form_data = new FormData();            

        for(i=0; i < file_data.length; i++){
            form_data.append('file'+i,file_data[i]); //Añadimos cada archivo a el arreglo con un indice direfente
        }

        $('#upload').on('click',function(){
            if(e.target.files[0].name == undefined || e.target.files[0].name == '' || $('#invoice').val() == ''){
                $('#allModal').modal('show');
            }else{
                form_data.append('invoice',$('#invoice').val());
                console.log(form_data);
                $.ajax({
                    method:'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url:'services/saveComplement',
                    data:form_data,
                    dataType:"json",
                    success:function(response){
                        if(response.status === 1005){
                            $('#modalIngreso').modal('show');
                        }else if(response.status === 200){
                            $('#modalSuccess').modal('show');
                        }else if(response.status === 1006){
                            $('#modalXml').modal('show');
                        }else if(response.status === 1007){
                            $('#modalMax').modal('show');
                        }
                        else{
                            $('#modalError').modal('show');
                        }
                    }
                });
            }    
        });
    });
        
    getInvoices();
})

function reload(){
    location.reload();
}

function relocate(){
    window.location.href = "facturas_proveedor";
}

function getInvoices(){
    $.ajax({
        method:"POST",
        url:"services/getCompleteInvoices",
        dataType:"json",
        success:function(response){
            if(response.data.status == 200){
                let select = '<option>--Selecciona Factura--</option>';
                for (var i = 0; i < response.data.data.length; i++) {
                    select += '<option  value="' + response.data.data[i].ID_Invoice + '">' + response.data.data[i].Description + ' $ ' + response.data.data[i].Amount + '</option>';
                }
                $(".invoices").html(select);
                $('#upload').prop('disabled',false);

            }else{
                let select = '<option>--NO HAY FACTURAS COMPLETADAS--</option>';
                $(".invoices").html(select);
                $('#upload').prop('disabled',true);
            }
        }
    })
}


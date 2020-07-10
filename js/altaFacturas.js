$(document).ready(function(){

    $('input[type="file"]').change(function(e){
        console.log(e.target.files);
        
        var fileName = e.target.files[0].name;
        console.log(fileName);
        
        $('#fileName').text(fileName);
        var file_data = e.target.files;  
        var form_data = new FormData();                  
        //form_data.append('file', file_data);

        for(i=0; i < file_data.length; i++){
            form_data.append('file'+i,file_data[i]); //Añadimos cada archivo a el arreglo con un indice direfente
        }

        $('#upload').on('click',function(){
            console.log("click");
            $.ajax({
                method:'POST',
                processData: false,
                contentType: false,
                cache: false,
                url:'services/saveFactura',
                data:form_data,
                dataType:"json",
                success:function(response){
                    if(response.status === 1005){
                        $('#modalIngreso').modal('show');
                    }else if(response.status === 200){
                        $('#modalSuccess').modal('show');
                    }                    
                    else if(response.status === 1006){
                        $('#modalXml').modal('show');
                    }
                    else{
                        $('#modalError').modal('show');
                    }
                }
            });
        });
    });

})

function reload(){
    location.reload();
}

function relocate(){
    window.location.href = "facturas_proveedor";
}


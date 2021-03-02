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
            if(e.target.files[0].name == undefined || e.target.files[0].name == '' || $('#orden').val() == ''){
                $('#allModal').modal('show');
            }else{
                console.log($('#empresa').val());
                console.log($('#orden').val());
                form_data.append('empresa',$('#empresa').val());
                form_data.append('orden',$('#orden').val());
                console.log(form_data);
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

    getEnterprises();
        
})

function getEnterprises(){
    let html = "";
    $.ajax({
        method:"POST",
        url:"services/getEnterprises",
        dataType:"json",
        success:function(response){
            if(typeof(response.data.data) == "undefined"){
                html='<option value = "SITDM SA DE CV" selected>SITDM SA DE CV</option><option value = "TRUCK DRILL MACHINES SA DE CV">TRUCK DRILL MACHINES SA DE CV</option>';
            }else{
                html = "<option value="+response.data.data[0].Name+">"+response.data.data[0].Name+"</option>";
            }
            $('#empresa').append(html);
        }
    })
}

function reload(){
    location.reload();
}

function relocate(){
    window.location.href = "facturas_proveedor";
}


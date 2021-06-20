var form_data;
$(document).ready(function(){
    $('#dataTable').ocDrawTable({
		ajax: 'services/getMyRequisitions',
		setColumns:[
			{
				columns:[6],
				render:function(data,type,row){

                    if(row[4]==1){
                        return "<span style='margin-right:5px' onclick='cotizacionModal(&quot;"+row[0]+"&quot;)'><i class='far fa-file'></i>";
                    }else if(row[4]==3){
                        return "";
                    }else{
                        return "<span style='margin-right:5px' onclick='cotizacionModal(&quot;"+row[0]+"&quot;)'><i class='far fa-file'></i></span><span style='margin-right:5px' onclick='ocprint(&quot;"+row[0]+"&quot;)'><i class='fas fa-eye'></i></span>";
                    }
                }
			},
            {
				columns:[4],
				render:function(data,type,row){
                    if(data==3){
                        return "Rechazada";
                    }else if(data==1){
                        return "Pendiente";
                    }else{
                       return  "Aceptada";
                    }
                }
			},
            {
                columns: [1, 2, 3, 4],
                inputSearch: true
            }
		]
	});

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('#fileName').text(fileName);
        var file_data = e.target.files;  
        var form_data = new FormData();            
        for(i=0; i < file_data.length; i++){
            form_data.append('file'+i,file_data[i]); //Añadimos cada archivo a el arreglo con un indice direfente
        }
        $('#upload').on('click',function(){
            form_data.append('id',$('#idCotizacion').val());
            $.ajax({
                method:'POST',
                processData: false,
                contentType: false,
                cache: false,
                url:'services/saveQ',
                data:form_data,
                dataType:"json",
                success:function(response){
                    console.log(response);
                    /*if(response.status === 1005){
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
                    }*/
                }
            });   
        });
    });
})

function cotizacionModal(id){
    $('#carga').modal('show');
    $('#idCotizacion').val(id);
}

function saveQ(){

}
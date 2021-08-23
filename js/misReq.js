var form_data;
var idReq;
var materiales=[];
$(document).ready(function(){
    $('#dataTable').ocDrawTable({
		ajax: 'services/getMyRequisitions',
		setColumns:[
			{
				columns:[5],
				render:function(data,type,row){
                    console.log(row[5]);
                    if(row[5]==null){
                        if(row[4]==1){
                            return "<span style='margin-right:5px' onclick='getReq(&quot;"+row[1]+"&quot;)'><i class='far fa-file'></i>";
                        }else{
                            return "";
                        }
                    }else{
                        if(row[5]!=null){
                            if(row[5]==1){
                                return "<span style='margin-right:5px' onclick='getReq(&quot;"+row[1]+"&quot;)'><i class='far fa-file'></i>";
                            }else{
                                return "";
                            }
                        }
                    }
                }
			},
            {
				columns:[4],
				render:function(data,type,row){


                    if(row[5]==null){
                        if(row[4]==1){
                            return "PENDIENTE";
                        }else if(row[4]==3){
                            return "RECHAZADA";
                        }else if(row[4]==2){
                            return "ACEPTADA";
                        }
                    }else{
                        if(row[5]!=null){
                            if(row[5]==1){
                                return "PENDIENTE";
                            }else if(row[5]==3){
                                return "RECHAZADA";
                            }else if(row[5]==2){
                                return "ACEPTADA";
                            }
                        }
                    }

                    /*if(data==3){
                        return "Rechazada";
                    }else if(data==1){
                        return "Pendiente";
                    }else{
                       return  "Aceptada";
                    }*/
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

function getReq(id){
    idReq=id;
    $.ajax({
        method:"POST",
        url:"services/getReqMaterial",
        dataType:"json",
        data:{
            id:id
        },success:function(response){
            var html="";
            response.data.forEach(element => {
                html+="<tr class='materiales_tr'>"+
                        "<td><input type='text' class='marca' value="+element.Marca+" disabled></td>"+
                        "<td><input type='text' class='modelo' value="+element.Modelo+" disabled></td>"+
                        "<td><input type='text' class='unidad' value="+element.Unidad+" disabled></td>"+
                        "<td><input type='text' class='qty' value="+element.Cantidad+" disabled></td>"+
                        "<td><input type='number' step='0.01' class='form-control price'></td>"+
                        "<input type='hidden' class='idMat'  value="+element.ID_Material+"></tr>";
            });
            $('#materialToAdd').append(html);
            $('#material').modal('show');

            console.log(response);
        }
    })
}

function savePrices(){
    $(".materiales_tr").each(function (index) {
        var mat = [];
        mat.push($(this).find('.price').val(),$(this).find('.idMat').val(),$(this).find('.qty').val());
        materiales.push(mat);
    })
    $.ajax({
        method:"POST",
        url:"services/savePrices",
        dataType:"json",
        data:{
            id:idReq,
            prices:materiales
        },success:function(response){
            if(response.data.data==1){
                window.location.href = "requisicion";
            }else{
                $('#errorModal').modal('show');
            }
        }
    })
}
var ids = [];
$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        placeholder: "SELECCIONA PROVEEDOR(S)",
        allowClear: true
    });
    $('#dataTable').ocDrawTable({
		ajax: 'services/getRequisitionsAdmin',
		setColumns:[
			{
				columns:[8],
				render:function(data,type,row){
                    return "<span style='margin-right:5px' onclick='detail(&quot;"+row[0]+"&quot;)'><i class='far fa-eye'></i></span><span style='margin-right:5px' onclick='supplierModal(&quot;"+row[0]+"&quot;)'><i class='fas fa-folder-plus'></i></span><span style='margin-right:5px' onclick='quotationModal(&quot;"+row[0]+"&quot;)'><i class='fas fa-archive'></i></span>";
                }
			},
            {
                columns: [1, 2, 3, 4],
                inputSearch: true
            }
		]
	});   

    getSuppliers();
})


function detail(id){
    window.open('services/documents/requisicionpdf?id='+id, '_blank');
}

function supplierModal(id){
    $('#idRequisicion').val(id);
    $('#suppliersModal').modal('show');
    
}

function getSuppliers()
{
    $.ajax({
        method:"POST",
        url:"services/getSuppliersData",
        dataType:"json",
        success:function(response){
            console.log(response);
            let select = '<option>--Selecciona--</option>';
			for (var i = 0; i < response.data.data.length; i++) {
			    select += '<option  data-id="'+response.data.data[i].ID_Supplier+'" value="' + response.data.data[i].Email + '">' + response.data.data[i].Supplier + '</option>';
			}
			$(".suppliers").html(select);
        }
    })
}

function sendEmail(){
    console.log(ids);
    var selected = [];
    $('.suppliers option:selected').each(function () {
      selected.push($(this).attr('data-id'));
    });
    let url= "https://administracion.truckdm.com.mx/services/documents/requisicionpdf?id="+$('#idRequisicion').val();
    $.ajax({
        method:"POST",
        url:"services/sendRequisition",
        dataType:"json",
        data:{
            suppliers:$('#supplierEmail').val(),
            idRequisition:$('#idRequisicion').val(),
            url:url,
            ids:selected
        },
        success:function(response){
            $("#dataTable").DataTable().ajax.reload(null, false);
            if(response.status==200){
                $('#exitoModal').modal('show');
            }
        }
    })
}

function quotationModal(id){
    $.ajax({
        method:"POST",
        url:"services/getQuotations",
        dataType:"json",
        data:{
            id:id
        },success:function(response){
            console.log(typeof(response.data.data));
            
var table = "";
console.log(table);
            if(typeof(response.data.data) != "undefined"){
                
                response.data.data.forEach(element => {
                    
                    var estatus = "";
                    if(element.Status == 1){
                        estatus = "PENDIENTE";
                    }else if(element.Status == 2){
                        estatus = "ACEPTADA";
                    }else if(element.Status == 3){
                        estatus = "RECHAZADA";
                    }
                    table+="<tr>"+
                                "<td><a href='"+element.File+"' TARGET='_BLANK'>"+element.File+"</a></td>"+
                                "<td>"+element.Supplier+"</td>"+
                                "<td>"+estatus+"</td>";

                    if(element.Status==1){

                       table+= "<td><button type='button' class='btn btn-relief-danger rechazar' style='margin-right:5px' onclick='rechazar("+element.ID_Cotizacion+")'><i class='fa fa-trash'></i></button><button type='button' class='btn btn-relief-danger aceptar' onclick='aceptar(&quot;"+element.ID_Requisition+"&quot;,&quot;"+element.Supplier+"&quot;,&quot;"+element.ID_Cotizacion+"&quot;)'><i class='fa fa-check'></i></button></td>"+
                            "</tr>";
                    }else if(element.Status==2){
                       table+= "<td></td>"+
                            "</tr>";
                    }else if(element.Status==3){
                        table+= "<td></td>"+
                        "</tr>";
                    }
                });
                $('#dataQ').html(table);
                $('#qModal').modal('show');
            }else{
                $('#noData').modal('show');
            }
        }
    })
}


function rechazar(id){
    $.ajax({
        method:"POST",
        url:"services/rejectQ",
        dataType:"json",
        data:{
            id:id
        },success:function(response){
            console.log(response);
        }
    })
}

function aceptar(id,sup,cot){
    window.open('nueva_oc?id='+id+'&prov='+sup+'&cot='+cot, '_blank');
}



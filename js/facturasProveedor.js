var form_data;
$(document).ready(function(){
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getInvoicesSupplier",
            columns:[
                {
                    targets: 0,
                    data: 1
                },
                {
                    targets: 1,
                    data: 2
                },
                {
                    targets: 2,
                    data: 3
                },
                {
                    targets: 3,
                    data: 4
                },
                {
                    targets: 4,
                    data: 5,
                    render: function(data, type){
                        if(data == 1){
                            return '<span class="badge badge-primary">Pendiente</span>';
                        }else if(data == 2){
                            return '<span class="badge badge-success">Pagada</span>'
                        }else if(data==3){
                            return '<span class="badge badge-danger">Rechazada</span>'
                        }else{
                            return '<span class="badge badge-warning">Cancelada</span>'
                        }
                    }
                },
                {
                    targets: 5,
                    data:6,
                    render: function(data, type, row){
                        if(row[5] == 2){
                            return '<span onclick="getPayments('+data+')"><i class="fas fa-info-circle" style="color:#6777EF"></i></span>';
                        }else{
                            if(row[5] == 1){
                                return '<span onclick="getPayments('+data+')"><i class="fas fa-info-circle" style="color:#6777EF;margin-right:5px;"></i></span><span onclick="cancelModal('+data+')"><i class="fas fa-times-circle" style="color:red"></i></span>';
                            }else{
                                if(row[5]==4){
                                    return '<span onclick="getUrl('+data+')"><i class="fas fa-eye" style="color:#6777EF;margin-right:5px;"></i></span>';
                                }else{
                                    return "";
                                }
                            }
                        }
                    }
                }
            ]
    })

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('#fileName').text(fileName);
        var file_data = e.target.files;  
        form_data = new FormData();            
        for(i=0; i < file_data.length; i++){
            form_data.append('file'+i,file_data[i]); //Añadimos cada archivo a el arreglo con un indice direfente
        }
    });
    
})

function getPayments(id)
{
    $.ajax({
        method:"POST",
        url:"services/getPaymentsSup",
        dataType:"json",
        data:{
            "invoice":id
        },
        success:function(response){
            var table ="";
            if(response.data.status == 204){
                $('#errorModal').modal('show');
            }else{
                $.each(response.data.data, function(key, value){
                    table += '<tr>'+
                             '<td>'+value.Amount+'</td>'+
                             '<td>'+value.Date+'</td>';

                });
                $('#body-payments').html(table);
                $('#paymentsModal').modal('show');
            }
        }
    })
}

function cancelModal(idInvoice){
    $('#cancelModal').modal('show');
    $('#idInvoice').val(idInvoice);
}

function cancelInvoice(){
    if(typeof(form_data)=="undefined"){
        $('#cancelModal').modal('hide');
        $('#archivoModal').modal('show');
    }else{
        form_data.append('idInvoice', $('#idInvoice').val());
        $.ajax({
            method:'POST',
            processData: false,
            contentType: false,
            cache: false,
            url:'services/rejectInvoice',
            data:form_data,
            dataType:"json",
            success:function(response){
                if(response.status == 200){
                    $('#successModal').modal('show');
                }
            }
        });
    }
}

function getUrl(id){
    let url="";
    $.ajax({
        method:"POST",
        url:"services/getUrlInfo",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            console.log(response);
            if(response.data.status==200){
                $('#buttonUrl').empty();
                $('#detalleModal').modal('show');
                $('#fechaCancelacion').text(response.data.data[0].Cancel_Date);
                $('#urlCancelacion').text(response.data.data[0].Acuse);
                url = "<a href='"+response.data.data[0].Acuse+"'><button type='button' class='btn btn-primary'>Ver Archivo</button></a>";
                $('#buttonUrl').append(url)
            }else{
                $('#errorsModal').modal('show');
            }
        }
    })
}


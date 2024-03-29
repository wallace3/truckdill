$(document).ready(function(){

    $('#invoices-table').ocDrawTable({
        ajax: 'services/getAllInvoices',
        
        buttons: [
            {
                extend: 'csv',
                text: 'Exportar',
                className: "btn-primary",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
                    modifier : {
                    page : 'all'
                    }
                }
            }
        ],
		setColumns:[
            {
                columns:[6],
                render: function(data,type){
                    number = parseFloat(data);
                    var float = number.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                    return "$"+float;
                    //data.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                columns:[9],
                render: function(data,type){
                    number = parseFloat(data);
                    var float = number.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                    return "$"+float;
                    //data.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                columns:[11],
                render: function(data,type){
                    number = parseFloat(data);
                    var float = number.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                    return "$"+float;
                    //data.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                }
            },
			{
                columns:[8],
				render: function(data, type){
                    if(data == 'Pendiente'){
                        return '<span class="badge badge-primary">'+data+'</span>';
                    }else if(data == 'Completada'){
                        return '<span class="badge badge-success">'+data+'</span>';
                    }else if(data=='Cancelada Por Proveedor'){
                        return '<span class="badge badge-warning">'+data+'</span>';
                    }else{
                        return '<span class="badge badge-danger">'+data+'</span>';
                    }
                }
			},
            {
				columns: [10],
                render: function(data, type, row){
                    if(row[13] == 2){
                        return "<span style='margin-right:5px;' onclick='getPayments("+row[11]+");'><i class='fas fa-info-circle' style='color:#6777EF'></i></span><a href = '"+row[12]+"'><i class='fas fa-download'></i></a>";
                    }else if(row[13] == 0){
                        return "<a style='margin-right:5px;' href = '"+row[12]+"'><i class='fas fa-download'></i></a><span onclick='deleteInvoice("+row[11]+");'><i class='fas fa-trash' style='color:#fc544b;'></i></span>";
                    }else if(row[13] == 4){
                        return "<span style='margin-right:5px' onclick='getInfoUrl("+row[11]+");'><i class='fas fa-eye' style='color:#6777EF'></i></span>";
                    }
                    else{
                        return "<span style='margin-right:5px' onclick='getPayments("+row[11]+");'><i class='fas fa-info-circle' style='color:#6777EF'></i></span><span style='margin-right:5px' onclick='addPaymentModal(&quot;"+row[11]+"&quot;,&quot;"+row[10]+"&quot;);'><i class='fas fa-money-check-alt' style='color:#66bb6a;'></i></span><a href = '"+row[12]+"' target='_blank'><i class='fas fa-download'></i></a><span onclick='cancelInvoice("+row[11]+");'><i class='fas fa-window-close' style='color:#fc544b'></i></span>";
                    }
                }
            },
            {
                columns: [11],
                data: [9],
                render: function(data,type,row){
                    return row[6] - data;
                }
            },
            {
                columns: [1, 2, 3, 4, 5, 6, 7, 8],
                inputSearch: true
            },
            
        ],
    });



    $('#invoices-table').on( 'draw.dt', function (e, settings) {
        console.log(settings);
        let sum=0;
        let tot=0;
        let res=0;
        $(settings.nTBody).find('tr td:nth-child(7)').each(function(idx, ele) {
            let string = "";
            string = ele.textContent.replace(",", "");
            string = string.replace("$","");
            sum+=parseFloat(string);
        })
        $(settings.nTBody).find('tr td:nth-child(10)').each(function(idx, ele) {
            let string = "";
            string = ele.textContent.replace(",", "");
            string = string.replace("$","");
            tot+=parseFloat(string);
        })
        $(settings.nTBody).find('tr td:nth-child(12)').each(function(idx, ele) {
            let string = "";
            string = ele.textContent.replace(",", "");
            string = string.replace("$","");
            res+=parseFloat(string);
        })

        let suma = sum.toFixed(2);
        suma = suma.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");

        let total = tot.toFixed(2);
        total = total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");

        let restante = res.toFixed(2);
        restante = restante.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");

        $('#suma').text(suma);
        $('#totalP').text(total);
        $('#restante').text(restante);
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

function getInfoUrl(id){
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
                url = "<a href='"+response.data.data[0].Acuse+"' target='_blank'><button type='button' class='btn btn-primary'>Ver Archivo</button></a>";
                $('#buttonUrl').append(url)
            }else{
                $('#errorsModal').modal('show');
            }
        }
    })
}

function addPaymentModal(id,sup)
{
    $('#payModal').modal('show');
    $('#idInvoice').val(id);
    $('#idSup').val(sup);
}

function addPayment()
{
    $.ajax({
        method:"POST",
        url:"services/addPayment",
        dataType:"json",
        data:{
            "id":$('#idInvoice').val(),
            "amount":$('#amount').val(),
            "idSup":$('#idSup').val(),
            "date":$('#datePayment').val()
        },
        success:function(response){
            console.log(response.data.data);
            if(response.data.data == 1){
                $('#payModal').modal('hide');
                $('#finalModal').modal('show');
                $('#amount').val('');
                $("#invoices-table").DataTable().ajax.reload(null, false);
            }else if(response.data.data == 2){
                $('#payModal').modal('hide');
                $('#mayorModal').modal('show');
            }else{
                $('#payModal').modal('hide');
                $('#addModal').modal('show');
                $('#amount').val('');
                $("#invoices-table").DataTable().ajax.reload(null, false);
            }
        }
    })
}

function cancelInvoice(id){
    $.ajax({
        method:"POST",
        url:"services/cancelInvoice",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            if(response.status == 200){
                $('#cancelModal').modal('show');
                $("#invoices-table").DataTable().ajax.reload(null, false);
            }else{
                $('#cancelerrorModal').modal('show');
            }
        }
    })
}

function deleteInvoice(id){
    $.ajax({
        method:"POST",
        url:"services/deleteInvoice",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            if(response.status == 200){
                $('#deleteModal').modal('show');
                $("#invoices-table").DataTable().ajax.reload(null, false);
            }else{
                $('#deleteError').modal('show');
            }
        }
    })
}

function reopen(){
    $('#mayorModal').modal('hide');
    $('#payModal').modal('show');
}
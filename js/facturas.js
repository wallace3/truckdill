$(document).ready(function(){

    $('#invoices-table').ocDrawTable({
        ajax: 'services/getAllInvoices',
        dom: 'lfBrtip',
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
                columns:[8],
				render: function(data, type){
                    if(data == 'Pendiente'){
                        return '<span class="badge badge-primary">'+data+'</span>';
                    }else if(data == 'Completada'){
                        return '<span class="badge badge-success">'+data+'</span>';
                    }else{
                        return '<span class="badge badge-danger">'+data+'</span>';
                    }
                }
			},
            {
				columns: [10],
                render: function(data, type, row){
                    console.log(row);
                    if(row[13] == 2){
                        return "<span onclick='getPayments("+row[11]+");'><i class='fas fa-info-circle' style='color:#6777EF'></i></span><a href = '"+row[12]+"'><i class='fas fa-download'></i></a>";
                    }else if(row[13] == 0){
                        return "<a href = '"+row[12]+"'><i class='fas fa-download'></i></a>";
                    }else{
                        return "<span onclick='getPayments("+row[11]+");'><i class='fas fa-info-circle' style='color:#6777EF'></i></span><span onclick='addPaymentModal(&quot;"+row[11]+"&quot;,&quot;"+row[10]+"&quot;);'><i class='fas fa-money-check-alt' style='color:#66bb6a;'></i></span><a href = '"+row[12]+"' target='_blank'><i class='fas fa-download'></i></a><span onclick='cancelInvoice("+row[11]+");'><i class='fas fa-window-close' style='color:#fc544b'></i></span>";
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
            }
		]
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

function reopen(){
    $('#mayorModal').modal('hide');
    $('#payModal').modal('show');
}
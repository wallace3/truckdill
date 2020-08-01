$(document).ready(function(){
    $('#invoices-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getAllInvoices",
            columns:[
                {
                    targets: 0,
                    data: 0
                },
                {
                    targets: 1,
                    data: 1
                },
                {
                    targets: 2,
                    data: 2
                },
                {
                    targets: 3,
                    data: 3
                },
                {
                    targets: 4,
                    data: 4
                },
                {
                    targets: 5,
                    data:5
                },
                {
                    targets: 6,
                    data:6
                },
                {
                    targets: 7,
                    data: 7,
                    render: function(data, type){
                        if(data == 1){
                            return '<span class="badge badge-primary">Pendiente</span>';
                        }else if(data == 2){
                            return '<span class="badge badge-success">Completada</span>';
                        }else{
                            return '<span class="badge badge-danger">Cancelada</span>';
                        }
                    }
                },
                {
                    targets: 8,
                    data:8,
                    render: function(data,type,row){
                        return row[5] - data;
                    }
                },
                {
                    targets: 9,
                    data:9,
                    render: function(data, type, row){
                        console.log(row);
                        if(row[7] == 2){
                            return "<span onclick='getPayments("+row[10]+");'><i class='fas fa-info-circle' style='color:#6777EF'></i></span><a href = '"+row[11]+"'><i class='fas fa-download'></i></a>";
                        }else if(row[7] == 0){
                            return "<a href = '"+row[11]+"'><i class='fas fa-download'></i></a>";
                        }else{
                            return "<span onclick='getPayments("+row[10]+");'><i class='fas fa-info-circle' style='color:#6777EF'></i></span><span onclick='addPaymentModal(&quot;"+row[10]+"&quot;,&quot;"+row[9]+"&quot;);'><i class='fas fa-money-check-alt' style='color:#66bb6a;'></i></span><a href = '"+row[11]+"' target='_blank'><i class='fas fa-download'></i></a><span onclick='cancelInvoice("+row[10]+");'><i class='fas fa-window-close' style='color:#fc544b'></i></span>";
                        }
                    }
                }
            ]
    })
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
            "idSup":$('#idSup').val()
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
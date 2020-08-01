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
                        }else{
                            return '<span class="badge badge-danger">Rechazada</span>'
                        }
                    }
                },
                {
                    targets: 5,
                    data:6,
                    render: function(data, type, row){
                        if(row[3] != "0"){
                            return '<span onclick="getPayments('+data+')"><i class="fas fa-info-circle" style="color:#6777EF"></i></span>';
                        }else{
                            return "";
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
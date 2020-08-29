$(document).ready(function(){
    $('#programacion').ocDrawTable({
        ajax: 'services/getSchedules',
		setColumns:[
            {
                columns: [5],
                render: function(data, type, row){
                    return "<span onclick='updateModal(&quot;"+row[0]+"&quot;,&quot;"+row[3]+"&quot;,&quot;"+row[4]+"&quot;);'><i class='far fa-edit' style='color:#6777EF'></i></span>";
                }
            },
            {
                columns: [1,2,3,4],
                inputSearch: true
            }
		]
	});
    getSuppliers();
})

function getSuppliers()
{
    $.ajax({
        method:"POST",
        url:"services/getSuppliersData",
        dataType:"json",
        success:function(response){
            let select = '<option>--Selecciona--</option>';
			for (var i = 0; i < response.data.data.length; i++) {
			    select += '<option  value="' + response.data.data[i].ID_Supplier + '">' + response.data.data[i].Supplier + '</option>';
			}
			$(".suppliers").html(select);
        }
    })
}

function updateModal(id,amount,date)
{
    console.log(date);
    console.log(amount);
    $('#updateModal').modal('show');
    $('#idS').val(id);
    $('#dateS').text(date);
    $('#amountS').text(amount);
}

function update()
{
    $.ajax({
        method:"POST",
        url:"services/updateSchedule",
        dataType:"json",
        data:{
            "id":$('#idS').val(),
            "date":$('#newDate').val(),
            "amount":$('#newAmount').val()
        },
        success:function(response){
            if(response.status == 200){
                $('#updateModal').modal('hide');
                $('#successModal').modal('show');
                $("#programacion").DataTable().ajax.reload(null, false);
            }else{
                $('#errorModal').modal('show');
            }
        }
    })
}

function paymentModal(){
    $('#paymentModal').modal("show");
}

function getInvoices(){
    $.ajax({
        method:"POST",
        url:"services/getActiveInvoicesSup",
        dataType:"json",
        data:{
            "id":$('#supplier').val()
        },
        success:function(response){
            if(response.data.status == 200){
                let select = '<option>--Selecciona--</option>';
                for (var i = 0; i < response.data.data.length; i++) {
                    select += '<option  value="' + response.data.data[i].ID_Invoice + '">' + response.data.data[i].Description + '</option>';
                }
                $(".invoices").html(select);
                $('#buttonP').prop('disabled',false);

            }else{
                let select = '<option>--PROVEEDOR SIN FACTURAS--</option>';
                $(".invoices").html(select);
                $('#buttonP').prop('disabled',true);
            }
        }
    })
}

function createPayment()
{
    $.ajax({
        method:"POST",
        url:"services/createSchedule",
        dataType:"json",
        data:{
            "ID_Invoice":$('#invoice').val(),
            "Amount":$('#Amount').val(),
            "Date":$('#Date').val()
        },
        success:function(response){
            if(response.status == 200){
                $('#paymentModal').modal("hide");
                $('#successModal').modal('show');
                $("#programacion").DataTable().ajax.reload(null, false);
            }else{
                $('#errorModal').modal('show');
            }
            console.log(response);
        }
    })
}




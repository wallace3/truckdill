var array_services = [];
$(document).ready(function(){
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getSuppliers",
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
                    targets:4,
                    data:4,
                    render:function(data,type,row){
                        if(data==1){
                            return '<span class="badge badge-success">Activa</span>';
                        }else{
                            return '<span class="badge badge-danger">Suspendido</span>';
                        }
                    }
                },
                {
                    targets: 5,
                    data:5,
                    render: function(data, type, row){
                        if(row[4]==1){
                            return '<span onclick="blockUser('+row[5]+');"><i class="fas fa-ban" style="color:#fc544b;"></i></span><span onclick="addServiceModal('+row[5]+');"><i class="fas fa-plus-square" style="color:#6777EF;"></i></span>';
                        }else{
                            return '<span onclick="activeUser('+row[5]+');"><i class="fas fa-check" style="color:#66bb6a;"></i></span>';
                        }
                    }
                }
            ]
    })

    getServices();
});

function blockUser(id)
{
    $.ajax({
        method:"POST",
        url:"services/blockUser",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            if(response.status == 200){
                $('#blockModal').modal('show');
            }else{
                $('#errorModal').modal('show');
            }
            $("#dataTable").DataTable().ajax.reload(null, false);
        }
    })
}

function activeUser(id)
{
    $.ajax({
        method:"POST",
        url:"services/activeUser",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            if(response.status == 200){
                $('#successModal').modal('show');
            }else{
                $('#errorModal').modal('show');
            }
            $("#dataTable").DataTable().ajax.reload(null, false);
        }
    })
}

function addServiceModal(id)
{
    $('#serviceModal').modal('show');
    $('#idSupplier').val(id);
    getServicesSuppliers(id);

}

function getServices()
{    
    info = "";
    $.ajax({
        method:"POST",
        url:"services/getAllServices",
        dataType:"json",
        success:function(response){
            response.data.data.forEach(element => {
                info += '<div><label>'+element.Service+'</label><input type = "checkbox" class="services" name="services" value="'+element.ID_Service+'"></div>'
            });

            
            $('#infoServices').html(info);
            console.log(response);
        }
    })
}

function getServicesSuppliers(id)
{
    $.ajax({
        method:"POST",
        url:"services/getSuppliersServices",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            array_services = response.data.data;
            console.log(array_services);
        }
    })
}





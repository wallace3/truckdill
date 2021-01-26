var array_services = [];
var array_services_general = [];
var array_ids = [];
var array_all = [];
$(document).ready(function(){

    $('#dataTable').ocDrawTable({
		ajax: 'services/getSuppliers',
		setColumns:[
			{
				columns:[5],
				render:function(data,type,row){
                    if(data==1){
                        return '<span class="badge badge-success">Activa</span>';
                    }else{
                        return '<span class="badge badge-danger">Suspendido</span>';
                    }
                }
			},
			{
                columns: [6],
				render: function(data, type, row){
                    if(row[5]==1){
                        return '<span style ="margin-right:5px;" onclick="blockUser('+row[6]+');"><i class="fas fa-ban" style="color:#fc544b;"></i></span><span style ="margin-right:5px;" onclick="addServiceModal('+row[7]+');"><i class="fas fa-plus-square" style="color:#6777EF;"></i></span></span><span style="margin-right:5px" onclick="editModal('+row[7]+');"><i class="fas fa-edit" style="color:#6777EF;"></i></span><span onclick="deleteSup('+row[6]+');"><i class="fas fa-trash" style="color:#fc544b;"></i></span>';
                    }else{
                        return '<span onclick="activeUser('+row[6]+');"><i class="fas fa-check" style="color:#66bb6a;"></i></span><span onclick="deleteSup('+row[6]+');"><i class="fas fa-trash" style="color:#fc544b;"></i></span>';
                    }
                }
			},
            {
                columns: [1, 2, 3, 4],
                inputSearch: true
            }
		]
	});


   /* $('#dataTable').ocDrawTable({
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
                            return '<span onclick="blockUser('+row[5]+');"><i class="fas fa-ban" style="color:#fc544b;"></i></span><span onclick="addServiceModal('+row[6]+');"><i class="fas fa-plus-square" style="color:#6777EF;"></i></span>';
                        }else{
                            return '<span onclick="activeUser('+row[5]+');"><i class="fas fa-check" style="color:#66bb6a;"></i></span>';
                        }
                    }
                }
            ]
            
    })*/

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
    select = "";
    $('#serviceModal').modal('show');
    $('#idSupplier').val(id);
    getServicesSuppliers(id);
}

function getServices()
{    
    select = "";
    $.ajax({
        method:"POST",
        url:"services/getAllServices",
        dataType:"json",
        success:function(response){
            response.data.data.forEach(element => {
                array_services_general.push(element.Service);
                array_ids.push(element.ID_Service);
                array_all = response.data.data;
                select += '<div class="custom-control custom-checkbox">'+
                    '<input type = "checkbox" class="custom-control-input services"  id='+element.Service+' name="services" value="'+element.ID_Service+'">'+
                    '<label class="custom-control-label" for='+element.Service+' >'+element.Service+'</label></div>';
            });
            $('#infoServices').html(select);
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

            $("input[name='services']").each(function () {
                $(this).prop('checked', false);
            })

           array_services_general.forEach( function(element, index, array){
                if(typeof(array_services[index]) !=='undefined'){
                    if(array_services_general.includes(array_services[index].Service)){
                        $("input[type=checkbox][value="+array_services[index].ID_Service+"]").prop("checked",true)
                    }
                }   
            }) 
        }
    })
}

function addServices(){
    console.log("si entra");
    var services = [];
    $.each($("input[name='services']:checked"), function(){
        services.push($(this).val());
    });

    console.log(services);

    $.ajax({
        method:"POST",
        url:"services/updateServicesSup",
        dataType:"json",
        data:{
            "services":services,
            "id":$('#idSupplier').val()
        },
        success:function(response){
            if(response.status == 200){
                $('#serviceModal').modal('hide');
                $("#dataTable").DataTable().ajax.reload(null, false);
            }
        }
    })
}

function editModal(id){
    $.ajax({
        method:"POST",
        url:"services/getInfoSupplier",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            $('#sup').val(response.data.data[0].Supplier);
            $('#rfc').val(response.data.data[0].Rfc);
            $('#legal').val(response.data.data[0].Legal);
            $('#idsup').val(response.data.data[0].ID_Supplier);
            $('#enterprise').val(response.data.data[0].ID_Enterprise);
            $('#editModal').modal('show');
        }
    })   
}

function editSup(){
    $.ajax({
        method:"POST",
        url:"services/editSup",
        dataType:"json",
        data:{
            "idSup": $('#idsup').val(),
            "sup" : $('#sup').val(),
            "legal": $('#legal').val(),
            "rfc": $('#rfc').val(),
            "enterprise":$('#enterprise').val()
        },
        success:function(response){
            $('#editModal').modal('hide');
            if(response.status == 200){
                $("#dataTable").DataTable().ajax.reload(null, false);
                $('#exitoModal').modal('show');
            }else{
                $('#errorModal').modal('show');
            }
        }
    })
}

function deleteSup(id){
    $.ajax({
        method:"POST",
        url:"services/deleteUser",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            if(response.status == 200){
                $('#deleteModal').modal('show');
            }else{
                $('#errorModal').modal('show');
            }
            $("#dataTable").DataTable().ajax.reload(null, false);
        }
    })
}




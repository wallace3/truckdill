$(document).ready(function(){

    $('#residents').ocDrawTable({
		ajax: 'services/getResidents',
		setColumns:[
            {
                targets: 6,
                data: 6,
                render: function(data,type,row){
                    if(data == 1){
                        return "<span class='badge badge-success'>Activo</span>"
                    }else{
                        return "<span class='badge badge-danger'>Inactivo</span>"
                    }
                }
            },
            {
                targets: 7,
                data:6,
                render: function(data,type,row){
                    if(data == 1){
                      return "<span style='margin-right:5px;' onclick='blockUser("+row[7]+");'><i class='fas fa-ban' style='color:#fc544b;'></i></span><span onclick='deleteUser("+row[7]+");'><i class='fas fa-trash' style='color:#fc544b;'></i></span>";
                    }else{
                        return "<span tyle='margin-right:5px;' onclick='activeUser("+row[7]+");'><i class='fas fa-check' style='color:#66bb6a;'></i></span><span onclick='deleteUser("+row[7]+");'><i class='fas fa-trash' style='color:#fc544b;'></i></span>";
                    }
                }
            },
            {
                columns: [1, 2, 3, 4, 5, 6],
                inputSearch: true
            }
		]
	});

    getUm();
});

function getUm()
{
    $.ajax({
        method:"POST",
        url:"services/getUms",
        dataType:"json",
        success:function(response){
            let select = '<option>--Selecciona--</option>';
            for (var i = 0; i < response.data.data.length; i++) {
                select += '<option  value="' + response.data.data[i].ID_Drill + '">' + response.data.data[i].Name + '</option>';
            }
            $(".ums").html(select);
       }
    })
}



function create()
{
    $.ajax({
        method:"POST",
        url:"services/createResident",
        dataType:"json",
        data:{
            user:$('#user').val(),
            pass:$('#pass').val(),
            email:$('#email').val(),
            tel:$('#tel').val(),
            name:$('#name').val(),
            um:$('#um').val()
        },
        success:function(response){
            if(response.status == 200){
                $('#successModal').modal('show');
            }else{
                $('#errorModal').modal('show');
            }
            $("#residents").DataTable().ajax.reload(null, false);
        }
    })
}

function blockUser(id){
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
            $("#residents").DataTable().ajax.reload(null, false);
        }
    })
}

function deleteUser(id){
    $.ajax({
        method:"POST",
        url:"services/deleteUser",
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
            $("#residents").DataTable().ajax.reload(null, false);
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
            $("#residents").DataTable().ajax.reload(null, false);
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




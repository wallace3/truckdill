
$(document).ready(function(){
    $('#change').on('click',function(){
        $.ajax({
            method:"POST",
            url:"services/editSupplier",
            dataType:"json",
            data:{
                sup:$('#supplier').val(),
                rfc:$('#rfc').val(),
                legal:$('#legal').val()
            },
            success:function(response){
                if(response.status == 200){
                    $('#exitoModal').modal('show');
                }else{
                    $('#errorModal').modal('show');
                }
            }
        })
    })
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
            console.log(response);
            if(response.status == 200){
                $('#serviceModal').modal('hide');
                $("#dataTable").DataTable().ajax.reload(null, false);
            }
        }
    })
}




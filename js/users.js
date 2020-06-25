$(document).ready(function() {
     // ID From dataTable 
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getUsersCustom",
        /*columnDefs: [ 
                
                /*{
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<button id='block' onclick='blocUser()' type='button' style='background-color:transparent;border:none;'><i class='fas fa-ban' style='color:#fc544b;'></i></button>"
                } 
            ]*/
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
                        render: function(data, type){
                            console.log(data+" "+type);
                            if(data==1){
                                return "<span class = 'badge badge-success'>Activo</span>"
                            }else{
                                return "<span class = 'badge badge-danger'>Suspendido</span>"
                            }
                        }
                    },
                    {
                        targets: 4,
                        data: null,
                        defaultContent: "<button id='block' onclick='blocUser()' type='button' style='background-color:transparent;border:none;'><i class='fas fa-ban' style='color:#fc544b;'></i></button>"
                    } 

                ]
    })
    getTypes();
});

function getTypes()
{
    $.ajax({
        "url":"services/getUserTypes",
        "method": "GET",
        "dataType":"json",
        success:function(response){
            let select = '<option>--Selecciona--</option>';
			for (var i = 0; i < response.data.data.length; i++) {
			    select += '<option  value="' + response.data.data[i].ID_Type + '">' + response.data.data[i].Type + '</option>';
			}
			$(".types").html(select);
        }
    })
} 

function createUser()
{
   $.ajax({
        "url":"services/createUser",
        "method": "POST",
        "dataType":"json",
        "data":{
            email:$('#correo').val(),
            user:$('#usuario').val(),
            pass:$('#password').val(),
            type:$('#types').val()
        },
        success:function(response){
            if(response.status == 200){
                $('#correo').val(''),
                $('#usuario').val(''),
                $('#password').val(''),
                $('#types').val('')
                $('#modalSuccess').modal('show');
            }else{
                $('#modalError').modal('show');
            }
        }
    })
}

/*function getUsers()
{
    $.ajax({
        url:"services/getUsers",
        method: "GET",
        dataType:"json",
        success:function(response){
            var datos = "";
            var span  = "";
            
            $.each(response.data.data, function(index, value){
                if(value.Status == 1){
                    span = '<span class = "badge badge-success">Activo</span>';
                }else{
                    span = '<span class = "badge badge-danger">Suspendido</span>';
                }
                datos += 
                    '<tr>'+
                        '<td>'+value.Username+'</td>'+
                        '<td>'+value.Email+'</td>'+
                        '<td>'+value.Type+'</td>'+
                        '<td>'+span+'</td>'+
                        '<td><button id="block" onclick="blocUser('+value.ID_User+')" type="button" style="background-color:transparent;border:none;"><i class="fas fa-ban" style="color:#fc544b;"></i></button></td>'+
                    '</tr>';    
            });
            //console.log(datos);
            //$('#user-body').html(datos);
        }
    })
}*/
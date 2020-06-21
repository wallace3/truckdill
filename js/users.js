$(document).ready(function() {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable 

    getTypes();
    getUsers();
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

function getUsers()
{
    $.ajax({
        "url":"services/getUsers",
        "method": "GET",
        "dataType":"json",
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
            $('#user-body').html(datos);
        }
    })
}
$(document).ready(function() {
     // ID From dataTable 
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getUsersCustom",
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

function createUser(){
   let bnd = true;
    if(!validate("correo","email")){
       bnd = false;
    }
    if(!validate("password","password")){
       bnd = false;
    }
    if(!validate("types","type")){
       bnd = false;
    }
if(bnd){
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
    
}

function validate(value, type){
    //value = id type= tipo a verificar
    switch(type){
        case "email":
            let  patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
            let email = document.getElementById(value).value;
            if(email.search(patron)==0){
                //Correcto
                valElemento(value,"remove");
                
                return true;
            }
            //Incorrecto
            valElemento(value,"add");
            return false;

            break;
        case "password":
            let longitud = document.getElementById(value).value;
            longitud = longitud.length;
            if(longitud>5){
                valElemento(value,"remove");
                return true;
            }
            valElemento(value,"add");
            return false;
            break;
        case "type":
            if(document.getElementById(value).value!="--Selecciona--"){
                valElemento(value,"remove");
                return true;
            }
            valElemento(value,"add");
            return false;
            break;

            
        
    
        }
    
    
    
}
function valElemento(id,action){
    //console.log(action);
    //console.log("document.getElementById("+id+").classList"+"."+action+"('is-invalid')");
    //document.getElementById(id).classList+"."+action+"('is-invalid')";
    
    if(action=="remove"){
        document.getElementById(id).classList.remove("is-invalid");
    }else{
        document.getElementById(id).classList.add("is-invalid");
    }
    
    
    

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
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
                        data: 4,
                        render: function(data, type, row){
                            if(row[3]==1){
                                return '<span style="margin-right:5px;" onclick="blockUser('+data+');"><i class="fas fa-ban" style="color:#fc544b;"></i></span><span onclick="deleteUser('+data+');"><i class="fas fa-trash" style="color:#fc544b;"></i></span>';
                            }else{
                                return '<span style="margin-right:5px; onclick="activeUser('+data+');"><i class="fas fa-check" style="color:#66bb6a;"></i></span><span onclick="deleteUser('+data+');"><i class="fas fa-trash" style="color:#fc544b;"></i></span>';
                            }
                        } 
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
                if(response.status == 206){
                    $('#duplicateModal').modal('show');
                }else{
                    $('#modalError').modal('show');
                }
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
            $("#dataTable").DataTable().ajax.reload(null, false);
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
                $('#deleteModal').modal('show');
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
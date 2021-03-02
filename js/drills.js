$(document).ready(function() {
    // ID From dataTable 
   $('#drills').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getDrills",
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
                        targets: 4,
                        data: 4,
                        render: function(data,type,row){
                            if(data == 1){
                                return "<span class='badge badge-success'>Activa</span>"
                            }else{
                                return "<span class='badge badge-danger'>Inactiva</span>"
                            }
                        }
                    },
                    {
                        targets: 5,
                        data:4,
                        render: function(data,type,row){
                            if(row[4] == 1){
                                return "<span onclick='deactivate("+row[0]+");'><i class='fas fa-trash' style='color:#fc544b;'></i></span>";
                            }else{
                                return "<span onclick='activate("+row[0]+");'><i class='fas fa-check' style='color:#66bb6a;'></i></span>";
                            }
                        }
                    },
            ]
   })
   getEnterprises();
});

function getEnterprises()
{
    console.log("hola mundo");
    $.ajax({
        url:"services/getAllEnterprises",
        method: "GET",
        dataType:"json",
        success:function(response){
            console.log(response);
            let select = '<option>--Selecciona--</option>';
            for (var i = 0; i < response.data.data.length; i++) {
                select += '<option  value="' + response.data.data[i].ID_Enterprise + '">' + response.data.data[i].Name + '</option>';
            }
            $(".enterprises").html(select);
       }
   })
} 

function deactivate(id){
   $.ajax({
       method:"POST",
       url:"services/deactivate",
       dataType:"json",
       data:{
           "id":id
       },
       success:function(response){
           console.log(response);
           $("#drills").DataTable().ajax.reload(null, false);
       }
   })
}

function activate(id){
    $.ajax({
        method:"POST",
        url:"services/activate",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            console.log(response);
            $("#drills").DataTable().ajax.reload(null, false);
        }
    })
}

function newUm(){
    $.ajax({
        method:"POST",
        url:"services/newUm",
        dataType:"json",
        data:{
            "name":$('#newMiner').val(),
            "enterprise":$('#enterprise').val()
        },
        success:function(response){
            console.log(response);
            $('#newModal').modal('hide');
            $("#drills").DataTable().ajax.reload(null, false);
        }
    })
}


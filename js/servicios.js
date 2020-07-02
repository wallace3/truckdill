$(document).ready(function(){
    $('#services-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getServices",
            columns:[
                {
                    targets: 0,
                    data: 0
                },
                {
                    targets: 1,
                    data:1,
                    render: function(data, type, row){
                        console.log(row);
                        var res = row[0].toString();
                        
                        return '<span onclick = "updateModal(&quot;'+row[1]+'&quot;,&quot;'+row[0]+'&quot;)"><i class="far fa-edit" style="color:#6777EF"></i></span><span onclick="remove('+data+')"><i class="fas fa-ban" style="color:#fc544b;"></i></span>';
                    }
                }
            ]
    })

})

$('#addService').on('click',function(){
    $.ajax({
        method:"POST",
        url:"services/addService",
        dataType:"json",
        data:{
            "service":$('#service').val()
        },
        success:function(response){
            if(response.status == 200){
                $('#addModal').modal('hide');
                $("#services-table").DataTable().ajax.reload(null, false);
            }
        }
    })
})

function remove(id)
{
    $.ajax({
        method:"POST",
        url:"services/removeService",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(response){
            if(response.status == 200){
                $("#services-table").DataTable().ajax.reload(null, false);
            }
        }
    })
}

function updateModal(id,service)
{
    console.log(service);
    console.log(id);
    
    
    $('#updateModal').modal('show');
    $('#serviceU').val(service);
    $('#idService').val(id);
}

$('#updateService').on('click',function(){
    $.ajax({
        method:"POST",
        url:"services/updateService",
        dataType:"json",
        data:{
            "id":$('#idService').val(),
            "service":$('#serviceU').val()
        },
        success:function(response){
            if(response.status == 200){
                $('#updateModal').modal('hide');
                $("#services-table").DataTable().ajax.reload(null, false);
            }
        }
    })
})

    


    
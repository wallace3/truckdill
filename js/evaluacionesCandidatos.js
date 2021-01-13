$(document).ready(function(){
    var datos="";
    $.ajax({
        method:"POST",
        url:"services/getCandidates",
        dataType:"json",
        success:function(response){
            $.each(response, function(i, v){
                //console.log(v);
                datos += 
                '<tr>'+
                  '<td>'+(i+1)+'</td>'+
                  '<td>'+v.Nombre+'</td>'+
                  '<td>'+v.Cel+'</td>'+
                  '<td>'+v.Tel+'</td>'+
                  '<td>'+v.Ciudad+'</td>'+
                  '<td>'+v.Proyecto+'</td>'+
                  '<td>'+v.Fecha+'</td>'+
                  '<td><button onclick="ver(\'' + v.idCandidato + '\')" type="button" class="btn btn-outline-primary btn-icon mr-2"><i class="fa fa-eye"></i></button></td>'+
                '</tr>';
            });
            $('#emp-body').html(datos);
            $('#table-empleados').ocDrawTable({
                setColumns: [
                {
                  columns: [1, 2, 3, 4, 5],
                  inputSearch: true
                }
                ],
                "paging": true,
                "searching": true
              });
        }
    })
})


function ver(id){
    window.open('resultadoC?id='+id, '_blank');
}

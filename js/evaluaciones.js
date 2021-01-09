$(document).ready(function(){
    var datos="";
    $.ajax({
        method:"POST",
        url:"services/getEmployeesEv",
        dataType:"json",
        success:function(response){
            $.each(response, function(i, v){
                //console.log(v);
                datos += 
                '<tr>'+
                  '<td>'+(i+1)+'</td>'+
                  '<td>'+v.Nombre+'</td>'+
                  '<td>'+v.Puesto+'</td>'+
                  '<td>'+v.Nivel+'</td>'+
                  '<td>'+v.Fecha+'</td>'+
                  '<td><button onclick="ver(\'' + v.idEmpleado + '\')" type="button" class="btn btn-outline-primary btn-icon mr-2"><i class="fa fa-eye"></i></button></td>'+
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
    window.open('resultado?id='+id, '_blank');
}

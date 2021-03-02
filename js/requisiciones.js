var materiales=[];
$(document).ready(function() {
    
    $('#dataTable').ocDrawTable({
		ajax: 'services/getRequisitions',
		setColumns:[
			{
				columns:[6],
				render:function(data,type,row){
                    return "<span onclick='detail(&quot;"+row[0]+"&quot;)'><i class='far fa-eye'></i></span>";
                }
			},
            {
                columns: [1, 2, 3, 4],
                inputSearch: true
            }
		]
	});

    $('#more').on('click',function(){
        let html="";
        html='<tr class="materiales_tr"><td><input type="text" class="form-control partida"></td>'+
            '<td><input type="text" class="form-control marca"></td>'+
            '<td><input type="text" class="form-control modelo"></td>'+
            '<td><textarea class="form-control descripcion" rows="5" ></textarea></td>'+
            '<td><input type="text" class="form-control cantidad"></td>'+
            '<td><input type="text" class="form-control unidad"></td>'+
            '<td><input type="text" class="form-control area"></td>'+
            '<td><button id="removeRow" class="btn btn-danger removeRow"><i class="fas fa-minus-circle"></i></button></td></tr>';
            $('#tableMaterials').on('click', '.removeRow', function(){
                $(this).parent().parent().remove();
            })
            $('.materiales').append(html);
    })

    $('#guardar').on('click',function(){
        materiales=[];
        $(".materiales_tr").each(function (index) {
            var mat = [];
            mat.push($(this).find('.partida').val(),$(this).find('.marca').val(),$(this).find('.modelo').val(),$(this).find('.descripcion').val(),$(this).find('.cantidad').val(),$(this).find('.unidad').val(),$(this).find('.area').val())
            materiales.push(mat);
            console.log(materiales);
        })
        $.ajax({
            method:"POST",
            url:"services/saveRequisition",
            dataType:"json",
            data:{
                "proyecto":$('#proyecto').val(),
                "equipo":$('#equipo').val(),
                "economico":$('#economico').val(),
                "folio":$('#folio').val(),
                "fecha_emision":$('#fecha_emision').val(),
                "fecha_requerida":$('#fecha_requerida').val(),
                "depto":$('#depto').val(),
                "materiales":materiales,
                "justificacion":$('#justificacion').val(),
                "observaciones":$('#observaciones').val(),
                "solicitante":$('#solicitante').val()
            },
            success:function(response){
                console.log(response);
            }
        })
    })
       
})


function detail(id){
    window.open('services/documents/requisicionpdf?id='+id, '_blank');
}



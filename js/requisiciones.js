var materiales=[];
var contador=1;
$(document).ready(function() {
    
    $('#dataTable').ocDrawTable({
		ajax: 'services/getRequisitions',
		setColumns:[
			{
				columns:[6],
				render:function(data,type,row){
                    return "<span onclick='detail(&quot;"+row[0]+"&quot;)' style='margin-right:5px'><i class='far fa-eye'></i></span><span onclick='remove(&quot;"+row[0]+"&quot;)'><i class='fas fa-trash' style='color:red'></i></span>";
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
        contador = contador+1;
        html='<tr class="materiales_tr"><td><input type="text" class="form-control partida" value="'+contador+'" disabled></td>'+
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
                "depto":$('#depto').val(),
                "materiales":materiales,
                "justificacion":$('#justificacion').val(),
                "observaciones":$('#observaciones').val()
            },
            success:function(response){
                console.log("hola mundo");
                if(response.status == 200){
                    $('#successModal').modal('show');
                }
            },
            error: function(err) {
                console.log(err);
            } 
        })
    })   
    randomly();
})

function detail(id){
    window.open('services/documents/requisicionpdf?id='+id, '_blank');
}

function redirect(){
    location.href='mis_requisiciones';
}

function remove(id){
    $.ajax({
        method:"POST",
        url:"services/removeRequisition",
        dataType:"json",
        data:{id:id},
        success:function(response){
            if(response.status == 200){
                $("#dataTable").DataTable().ajax.reload(null, false);
            }else{
                $('#errorModal').modal('show');
            }
        }
    })
}

function randomly(){
    let string = "";
    string = Math.random().toString(36).slice(2)
    $('#folio').val(string);
   // return string;
}

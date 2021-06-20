$(document).ready(function() {
    // ID From dataTable 
    $('#dataTable').ocDrawTable({
		ajax: 'services/getmOcs',
		setColumns:[
			{
				columns:[6],
				render:function(data,type,row){
                    return "<span style='margin-right:5px' onclick='detail(&quot;"+row[0]+"&quot;)'><i class='far fa-eye'></i></span>";
                }
			},
            {
                columns: [1, 2, 3, 4],
                inputSearch: true
            }
		]
	});   

})

function detail(id){
    window.open('services/documents/ocpdf?id='+id, '_blank');
}



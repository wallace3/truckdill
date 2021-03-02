$(document).ready(function() {
    
    $('#dataTable').ocDrawTable({
		ajax: 'services/getRequisitionsAdmin',
		setColumns:[
			{
				columns:[8],
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
})


function detail(id){
    window.open('services/documents/requisicionpdf?id='+id, '_blank');
}



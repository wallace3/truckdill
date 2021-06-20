$(document).ready(function() {
    // ID From dataTable 
    $('#dataTable').ocDrawTable({
		ajax: 'services/getOcs',
		setColumns:[
			{
				columns:[7],
				render:function(data,type,row){
                    return "<span style='margin-right:5px' onclick='detail(&quot;"+row[0]+"&quot;)'><i class='far fa-eye'></i></span><span style='margin-right:5px' onclick='supplierModal(&quot;"+row[0]+"&quot;)'><i class='fas fa-folder-plus'></i></span><span style='margin-right:5px' onclick='quotationModal(&quot;"+row[0]+"&quot;)'><i class='fas fa-archive'></i></span>";
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



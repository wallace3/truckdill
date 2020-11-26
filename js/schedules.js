$(document).ready(function(){
    $('#programacion').ocDrawTable({
        ajax: 'services/getSchedulesSupplier',
		setColumns:[
            {
                columns: [1,2,3,4],
                inputSearch: true
            },
            {
                columns: [4],
                render: function(data, type, row){
                    if(data == 0){
                        return "PENDIENTE";
                    }else{
                        return "PAGADO";
                    }
                }
            },
		]
	});
})











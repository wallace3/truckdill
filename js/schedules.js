$(document).ready(function(){
    $('#programacion').ocDrawTable({
        ajax: 'services/getSchedulesSupplier',
		setColumns:[
            {
                columns: [1,2,3],
                inputSearch: true
            }
		]
	});
})











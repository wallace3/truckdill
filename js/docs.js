$(document).ready(function(){
    $('#docs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getDocs",
            columns:[
                {
                    targets: 0,
                    data: 0
                },
                {
                    targets: 1,
                    data: 1
                },
                {
                    targets: 2,
                    data: 2
                },
                {
                    targets: 3,
                    data:2,
                    render: function(data, type){
                       return '<a href="'+data+'" TARGET="_BLANK"><i class="fas fa-download" style="color:#757575;"></i></a>';  
                    }
                }
            ]
    })
})
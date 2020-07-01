$(document).ready(function(){
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getSuppliers",
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
                    data: 3
                },
                {
                    targets: 4,
                    render: function(data, type){
                        return '<div class="input-group">'+
                                    '<div class="input-group-prepend">'+
                                        '<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>'+
                                    '</div>'+
                                    '<div class="custom-file">'+
                                        '<input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">'+
                                        '<label class="custom-file-label" for="inputGroupFile01">Choose file</label>'+
                                    '</div>'+
                                '</div>'
                    }
                }
            ]
    })
});









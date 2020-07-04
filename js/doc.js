$(document).ready(function(){
    $('#doc-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "services/getDoc",
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
                        if(data<=0){
                            return '<span class="badge badge-danger">Vencido</span>'
                        }else{
                            return '<span class="badge badge-success">Activo</span>'
                        }
                    }
                },
            ]
    })

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('#fileName').text(fileName);
        var file_data = e.target.files[0];  
        var form_data = new FormData();                  
        form_data.append('file', file_data);

        $('#upload').on('click',function(){
            $.ajax({
                method:'POST',
                processData: false,
                contentType: false,
                cache: false,
                url:'services/saveDoc',
                data:form_data,
                dataType:"json",
                success:function(response){
                    if(response.status === 1005){
                        $('#modalPdf').modal('show');
                    }else{
                        $('#filePdf').val('');
                        $('#fileName').text('');
                        $('#exitoPdf').modal('show');
                        $("#doc-table").DataTable().ajax.reload(null, false);
                    }
                }
            });
        });
    });
})
$(function () {
    var inputFile = $('#file_6');
    $('#upload_single_bt_6').click(function (event) {
        var URI_single = $('#form-upload-single #file_6').attr('data-uri');
        var fileToUpload = inputFile[0].files[0];
        var formData = new FormData();
        formData.append('file_6', fileToUpload);
        $.ajax({
            url: URI_single,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.status == 'ok') {
                    showThumbUpload(data);
                    $('#file_6').val(data.file_path);
                }
            },
//            error: function (xhr, ajaxOptions, thrownError) {
//                alert(xhr.status);
//                alert(thrownError);
//            }
        });
        return false;
    });
    function  showThumbUpload(data) {
        var items;
        items = '<img src="' + data.file_path + '"/>';
        $('#show_list_file_6').html(items);
    }
});
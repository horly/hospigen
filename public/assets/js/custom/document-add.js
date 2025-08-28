
/**
 * upload file with progress bar
 */
$('#upload_pdf_document').ajaxForm({
    beforeSubmit : function(){
        var percentVal = "0%";
        var file_add = $('#file-add');

        var maxSizeKB = 4000; //Size in KB.
        var maxSizeMB = 4;
        var maxSize = maxSizeKB * 1024;

        if(file_add.val() != "")
        {
            //var size = parseFloat(file_purchase[0].files[0].size);

            $('#progress-bar-purchase').width(percentVal);
            $('#progress-bar-purchase').text(percentVal);
            $('#zone-progress-bar-purchase').attr('hidden', false);
            $('#file-message').text("");
            $('.btn-file').addClass('d-none');
            $('.btn-loading-file').removeClass('d-none');
            file_add.removeClass('is-invalid');
        }
        else
        {
            $('#file-add-error').text($('#file-message').val());
            file_add.addClass('is-invalid');
            return false;
        }
    },
    uploadProgress : function(event, position, total, percentComplete) {
        var percentVal = percentComplete + "%";
        $('#progress-bar-purchase').width(percentVal);
        $('#progress-bar-purchase').text(percentVal);
    },
    complete : function() {
        setTimeout(function(){
            window.location.reload();
        }, 3000);
    }
});

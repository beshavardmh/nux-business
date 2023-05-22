jQuery(document).ready(function ($) {

    let convertToSlug, slug_input_event, saveTextAsFile, log_event, get_backup_event, processBtn, clear_caches_event;

    // ------------------------------------------------------

    convertToSlug = (text) => {
        return text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    }

    slug_input_event = () => {
        $('.slug_input').on('blur', function () {
            $(this).val(convertToSlug($(this).val()));
        });
    }

    saveTextAsFile = (textToWrite, fileName) => {
        let textFileAsBlob = new Blob([textToWrite], {type: 'text/plain'});
        let fileNameToSaveAs = fileName;

        let downloadLink = document.createElement("a");
        downloadLink.download = fileNameToSaveAs;
        downloadLink.innerHTML = "Download File";
        if (window.webkitURL != null) {
            // Chrome allows the link to be clicked
            // without actually adding it to the DOM.
            downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
        } else {
            // Firefox requires the link to be added to the DOM
            // before it can be clicked.
            downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
            downloadLink.onclick = destroyClickedElement;
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
        }

        downloadLink.click();
    }

    log_event = () => {
        $('.saveLogAsFile').on('click', function () {
            saveTextAsFile($('#log_textarea').val(), 'log.text');
        });

        $('.delete_log').on('click', function () {
             if (confirm('از پاک کردن تمامی لاگ ها اطمینان دارید؟')){
                 $('#log_textarea').val(null);
             }
        });
    }

    processBtn = (btn, status = 'deactive') => {
        if (status == 'active') {
            $(btn).prop('disabled', true);
            $(btn).find('.process-animation').fadeIn();
        } else {
            $(btn).prop('disabled', false);
            $(btn).find('.process-animation').fadeOut();
        }

    }

    get_backup_event = () => {
        $('.get_backup_db').on('click', function () {
            processBtn($('.get_backup_db'), 'active');
            $.ajax({
                type: "POST",
                url: nux_ajax.ajax_url,
                data: {
                    'nonce': nux_ajax.nonce,
                    'action': 'db_backup_ajax'
                },
                success: function (response) {
                    processBtn($('.get_backup_db'), 'deactive');
                    if (!response.success) {
                        $('.alert_backup_db').html(response.data.msg).removeClass('text-green').addClass('text-red').show();
                    } else {
                        saveTextAsFile(response.data.backup_content, response.data.backup_filename);
                    }
                }
            });
        });
    }

    clear_caches_event = () => {
        $('.clear_caches').on('click', function () {
            processBtn($('.clear_caches'), 'active');
            $.ajax({
                type: "POST",
                url: nux_ajax.ajax_url,
                data: {
                    'nonce': nux_ajax.nonce,
                    'action': 'remove_all_caches_ajax'
                },
                success: function (response) {
                    processBtn($('.clear_caches'), 'deactive');
                    if (!response.success) {
                        $('.alert_clear_caches').html(response.data.msg).removeClass('text-green').addClass('text-red').show();
                    } else {
                        $('.alert_clear_caches').html(response.data.msg).removeClass('text-red').addClass('text-green').show();
                    }
                }
            });
        });
    }

    // ------------------------------------------------------

    slug_input_event();
    log_event();
    get_backup_event();
    clear_caches_event();
});
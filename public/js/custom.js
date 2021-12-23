    
/* Tags Input */
$(document).ready(function(){ 
    if($('#tags-input').length) {
        var tagInputEle = $('#tags-input');
        tagInputEle.tagsinput();
    }
});

/* Form Processing */
$('form[is-dynamic-form]').submit(function(e) {
    
    e.preventDefault();
    resetErrorMessages(this);
    updateCKEditor();

    let thiis = $(this);

    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        type: $(this).attr('method'),
        url:  $(this).attr('action'),
        data: $(this).serialize(),
        typeData: 'JSON',

        success: function(data) {
            if(data.notification != null) {
                callToast(data.notification.type, data.notification.message)
                initializeForm(thiis);
            }
            
            if(data.callback && typeof window[data.callback.functionName] == 'function') {
                setTimeout( function() {
                    window[data.callback.functionName](data.callback.args)
                }, 1500);
            }
        },

        error: function(data) {
            if(data.status === 422) {
                $.each(data.responseJSON.errors, function(index, errorMsg) {
                    $('[name =' + index + ']').addClass('is-invalid');
                    $('.' + index +'-error').html(errorMsg);
                });
                
                // Scroll to error msg
                $(window).scrollTop($('.is-invalid').offset().top);
            }
        }
    });
});

/* Initialize form (clear inputs, selects..etc) */
function initializeForm(form) {
    $(form).find('input,select,textarea').each(function (index,field) {
        $(field).val('');
    });

    // Clear tags input if exists
    if($('#tags-input').length) {
        $('#tags-input').tagsinput('removeAll');
    }

    // Clear CKEditor
    if($('#editor').length) {
       initializeCKEditor();
    }
}

/* Reset error messages after submit */
function resetErrorMessages(form) {
    $(form).find('input,select,textarea').each(function (index, field) {
        $(field).removeClass('is-invalid');
    });
}

/* Update CKEditor (textarea) */
function updateCKEditor() {
    if($('#editor').length) {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }    
    }
}

/* Initialize/Clear CKEditor (textarea) */
function initializeCKEditor() {
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].setData('');
    }
}

/* Call Toast Notifier */
function callToast(type, msg) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        iconColor: 'white',
        customClass: {
          popup: 'colored-toast'
        },
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true
    })

    Toast.fire({
        icon: type,
        title: msg
    })
}
var Swal = require('sweetalert');

window.alertAndSubmit = function (text, confirmText, formId){
    Swal({
        title: 'A jeni të sigurtë?',
        text: text,
        icon: 'warning',
        dangerMode: true,
        buttons: {
            cancel: {
                text: "Anulo",
                visible: true
            },
            confirm: {
                text: confirmText
            }
        }
    }).then((willDelete) => {
        if (willDelete) {
            // Swal({
            //     icon: 'success',
            //     showConfirmButton: false,
            //     timer: 1500,
            // });
            $(formId).submit();
        }
    })
}



$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        placeholder: "Zgjedh opsionet"
    });
});



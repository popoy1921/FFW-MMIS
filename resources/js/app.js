import $ from 'jquery';
import '@popperjs/core';
import 'bootstrap';
import 'bootstrap-select';
import 'jquery-easing';
import 'datatables';
import 'datatables.net-bs4';
import Alpine from 'alpinejs';

window.$ = window.jQuery = $;
$.fn.selectpicker.Constructor.BootstrapVersion = '4';

window.Alpine = Alpine;
Alpine.start();

$(document).ready(function() {
    // show multi-select 
    $('.multi-select[multiple="multiple"]').selectpicker({
        title: "- Any -",
        liveSearch: true,
        actionsBox: true,
        width: '100%',
        container: 'body',
        selectedTextFormat: 'count > 1'      
    });

    // Show password
    function loginTogglePassword(sInputId) {
        if($('input#' + sInputId).attr("type") == "text"){
            $('input#' + sInputId).attr('type', 'password');
            $('i#' + sInputId).addClass( "fa-eye-slash" );
            $('i#' + sInputId).removeClass( "fa-eye" );
        }else if($('input#' + sInputId).attr("type") == "password"){
            $('input#'+ sInputId).attr('type', 'text');
            $('i#' + sInputId).removeClass( "fa-eye-slash" );
            $('i#' + sInputId).addClass( "fa-eye" );
        }
    }
    
    window.loginTogglePassword = loginTogglePassword;

    // fade out timed alerts
    setTimeout(function() {
        $('.timed-alert').fadeOut(1000, function() {
            $(this).addClass('d-none');
        });
    }, 3000);

    // Form that would not refresh when submit
    $('.ajax-update-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        var oForm = $(this);
        resetFormErrors(oForm);
        $.ajax({
            url:  oForm.attr('action'),
            type: oForm.attr('method'),
            data: oForm.serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#responseContainer').html(response);
            },
            error: function(oXHRResponse) {
                let oErrors = oXHRResponse.responseJSON.errors;
                Object.keys(oErrors).forEach(sKey => {
                    console.log('input[name="' + sKey + '"]');
                    var oInput = oForm.find('input[name="' + sKey + '"]');
                    console.log(oForm);
                    console.log(oInput);
                    oInput.addClass('is-invalid');
                    var oFormGroup = oInput.closest('.form-group');
                    var oErrorDiv = $('<div></div>').addClass(['invalid-feedback', 'd-block']).append(oErrors[sKey]);
                    oFormGroup.append(oErrorDiv);
                });
            }
        });
    });

    function resetFormErrors(oForm)
    {
        oForm.find('.invalid-feedback').remove();
        oForm.find('input').removeClass('is-invalid');
    }
});
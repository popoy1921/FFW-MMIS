import $ from 'jquery';
import '@popperjs/core';
import 'bootstrap';
import 'bootstrap-select';
import 'jquery-easing';
import 'datatables';
import 'datatables.net-bs4';
import flatpickr from "flatpickr";
import Alpine from 'alpinejs';
import iziToast from 'izitoast';

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

    // Select with live search
    $('.live-select').selectpicker({
        title: "- Any -",
        liveSearch: true,
        actionsBox: true,
        width: '100%',
        container: 'body',
        selectedTextFormat: 'count > 1'      
    });

    flatpickr('.date-picker', {
        enableTime: false,
        dateFormat: "Y-m-d",
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

    // initiate iztoast after redirection
    function triggerInitialToast() {
        let oToastTrigger = $('#iztoast');
        let sTitle = oToastTrigger.data('title');
        let sSuccessMsg = oToastTrigger.data('message');
        if(oToastTrigger.length > 0) {
            iziToast.success({
                title: sTitle,
                message: sSuccessMsg,
                position: 'topCenter'
            });
        }
    }
    triggerInitialToast();

    // Form that would not refresh when submit
    $('.ajax-update-form, .ajax-create-form').on('submit', function(e) {
        e.preventDefault();
    });
});

// show modal
function callModal(sFormId, oMessages, fCallBack)
{
    /* oMessages should have this format
    {
        title          : 'Profile Update',
        content        : 'Are you sure you want to update your profile?',
        confirm_button : 'Save',
        cancel_button  : 'Cancel',
        success_msg    : ''
    }
    */

    // check if all required fields are populated
    let hasEmptyRequiredFields = false;
    $('#' + sFormId).find('input[required]').each(function() {
        if ($(this).val().trim() === '') {
            hasEmptyRequiredFields = true;
        }
    });

    if (hasEmptyRequiredFields === true) {
        return;
    }

    // ready and show modal
    $('#application-modal #cb-modal-title').html(oMessages.title);
    $('#application-modal #cb-modal-body').html(oMessages.content);
    $('#application-modal #cancel-button').html(oMessages.cancel_button);
    $('#application-modal #confirm-button').html(oMessages.confirm_button);
    $('#application-modal #confirm-button').off('click');
    console.log(oMessages);
    $('#application-modal #confirm-button').on('click', function() {
        confirmSubmitForm(sFormId, oMessages.success_msg, fCallBack);
    });
    $('#application-modal').modal('show');
}

// execute submission by ajax and execute fCallBack
function confirmSubmitForm(sFromId, sSuccessMsg, fCallBack)
{
    var oForm = $('#' + sFromId);
    console.log(oForm);
    resetFormErrors(oForm);
    $.ajax({
        url:  oForm.attr('action'),
        type: oForm.attr('method'),
        data: oForm.serialize(),
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(oResponse) {
            if (oForm.hasClass('ajax-create-form') === true) {
                var sRedirect = oForm.data('redirect');
                window.location.href = sRedirect + "?guid=" + oResponse.guid;
                return;
            }
            if (typeof fCallBack !== 'undefined') {
                fCallBack();
            }
            iziToast.success({
                title: 'Success',
                message: sSuccessMsg,
                position: 'topCenter'
            });
        },
        error: function(oXHRResponse) {
            let oErrors = oXHRResponse.responseJSON.errors;
            Object.keys(oErrors).forEach(sKey => {
                console.log('input[name="' + sKey + '"]');
                var oInput = oForm.find('[name="' + sKey + '"]');
                oInput.addClass('is-invalid');
                var oFormGroup = oInput.closest('.form-group');
                var oErrorDiv = $('<div></div>').addClass(['invalid-feedback', 'd-block']).append(oErrors[sKey]);
                oFormGroup.append(oErrorDiv);
            });
        },
        complete: function() {
            $('#application-modal').modal('hide');
        }
    });
}

// remove errors on fields
function resetFormErrors(oForm)
{
    oForm.find('.invalid-feedback').remove();
    oForm.find('input').removeClass('is-invalid');
}

window.confirmSubmitForm = confirmSubmitForm;
window.callModal = callModal;
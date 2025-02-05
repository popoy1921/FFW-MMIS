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
});
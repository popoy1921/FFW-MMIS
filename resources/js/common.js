console.log($('body'));

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
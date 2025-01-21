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

// filter submission
$(document).ready(function() {
    function getFilteredUrl(oFilterDiv)
    {
        let oFilters = {};
        let aFilterFields = oFilterDiv.find('input, select');
        aFilterFields.each(function(index, oElement) {
            if (oElement.value !== '') {
                oFilters[$(oElement).attr('name')] = oElement.value;
            }
        });
        const sCurrentUrl = window.location.href.split('?')[0];
        const sQueryString = new URLSearchParams(oFilters).toString();
        return sCurrentUrl + '?' + sQueryString;
    }

    $('[id$="-filter-form"]').on('change', 'input, select', function() {
        window.location.href = getFilteredUrl($(this).closest('[id$="-filter-form"]'));
    });

    $('[id$="-filter-form"]').on('change', 'input, select', function() {
        let oFilters = {};
        let aFilterFields = $(this).closest('[id$="-filter-form"]').find('input, select');
        aFilterFields.each(function(index, oElement) {
            if (oElement.value !== '') {
                oFilters[$(oElement).attr('name')] = oElement.value;
            }
        });
        const sCurrentUrl = window.location.href.split('?')[0];
        const sQueryString = new URLSearchParams(oFilters).toString();
        window.location.href = sCurrentUrl + '?' + sQueryString;
        console.log(sCurrentUrl + '?' + sQueryString);
    });
});
    
function postUpdateFederationDetails()
{
    $('#trade-federation-name').html($('input[name="name"]').val());
}

window.postUpdateFederationDetails = postUpdateFederationDetails;

/* No redirect implementation of acitve Menu
let oLargeMenuList = $('#trade-federation-large-menu-list');
let oSmallMenuList = $('#trade-federation-small-menu-list');
let oLargeMenuItems = $('#trade-federation-large-menu-list a');
let oSmallMenuItems =  $('#trade-federation-small-menu-list a');

oLargeMenuItems.on('click', function() {
    toggleActiveMenuItem($(this));
});
oSmallMenuItems.on('click', function() {
    toggleActiveMenuItem($(this));
});

function toggleActiveMenuItem (oCurrentSelected) {
    let sSelectedDataName = oCurrentSelected.data('name');
    oLargeMenuItems.removeClass('active');
    oSmallMenuItems.removeClass('active');
    oLargeMenuList.find('[data-name="'+ sSelectedDataName +'"]').addClass('active');
    oSmallMenuList.find('[data-name="'+ sSelectedDataName +'"]').addClass('active');
}
*/
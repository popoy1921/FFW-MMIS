function postProfileUpdate()
{
    $.ajax({
        url:  '/api/user/userDetails',
        type: 'GET',
        data: {
            guid : $('input[name="guid"]').val()
        },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(oResponse) {
            $('#online-user-name').html(oResponse.fname);
        }
    });
}

function postPasswordUpdate()
{
    $('input[name="current_password"]').val('');
    $('input[name="password"]').val('');
    $('input[name="password_confirmation"]').val('');
}

window.postProfileUpdate   = postProfileUpdate;
window.postPasswordUpdate  = postPasswordUpdate;
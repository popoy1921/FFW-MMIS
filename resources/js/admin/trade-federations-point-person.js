$(document).ready(function() {
    console.log('Paul')
    let oUserTable = $('#federation-point-person-datatable');
    let sAjaxLink = oUserTable.attr('reference');

    let oUserDataTable = $('#federation-point-person-datatable').DataTable({
        processing : true,
        serverSide : true,
        searching  : false,
        ordering   : true,
        ajax       : {
            url  : sAjaxLink,
            type : 'GET',
            data : function (oData) {
                oData.table               = 'federation-point-person-datatable';
                oData.fullname            = $('input[name="fullname"]').val();
                oData.email               = $('input[name="email"]').val();
                oData.status_id           = $('select[name="status_id"]').val();
                oData.default_federation  = $('input[name="federation"]').val();
                oData.default_role_id     = 3;
            },
        },
        columns: [
            { data : 'fullname', name : 'fullname'},
            { data : 'email', name : 'email'},
            { data : 'status', name : 'status'},
            { data : 'actions', name : 'actions'},
        ],
        columnDefs: [
            { orderable: true, targets: [0, 1, 2,] },
        ]
    });
    
    // Submit filter for table
    $('#users-filter-submit').on('click', function() {
        console.log([
            $('input[name="fullname"]').val(),
            $('input[name="email"]').val(),
            $('input[name="federation"]').val(),
            $('input[name="local_union"]').val(),
            $('select[name="role_id"]').val(),
            $('select[name="status_id"]').val(),
        ]);
        oUserDataTable.draw();
    });

    // Update modal for update status form
    $('#federation-point-person-datatable').on('click', '.update-status', function() {
        var sUpdateFormSelector, sModalContent;
        var updateStatusButton = $(this);
        updateStatusButton.addClass('remove-button');
        if(updateStatusButton.hasClass('deactivate') === true) {
            sUpdateFormSelector = "deactivate-user-form";
            sTitle = "Deactivate MMIS Point Person"
            sModalContent = 'Are you sure you want to change the status of this MMIS Point Person to Inactive?';
        } else {
            sUpdateFormSelector = "activate-user-form";
            sTitle = "Activate MMIS Point Person"
            sModalContent = 'Are you sure you want to change the status of this MMIS Point Person to Active?';
        }
        let oUpdateForm = $('#' + sUpdateFormSelector);
        oUpdateForm.addClass('trade-user-status-updating');
        oUpdateForm.find('input[name="id"]').val(updateStatusButton.attr('id'));
        callModal(sUpdateFormSelector,
            {
            title          : sTitle,
            content        : sModalContent,
            confirm_button : 'Update',
            cancel_button  : 'Cancel',
            success_msg    : 'MMIS Point Person status updated successfully!'
            },
            postFederationsStatusUpdate
        );
    });
});
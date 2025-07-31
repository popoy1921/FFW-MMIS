$(document).ready(function() {
    let oUserTable = $('#federation-officers-datatable');
    let sAjaxLink = oUserTable.attr('reference');
    console.log($('#federation-officers-datatable'));

    // Define Trade fedarations Officers table
    let oOfficerTable = $('#federation-officers-datatable').DataTable({
        processing : true,
        serverSide : true,
        searching  : false,
        ordering   : true,
        ajax       : {
            url  : sAjaxLink,
            type : 'GET',
            data : function (oData) {
                oData.default_federation_id = $('input[name="federation_id"]').val();
            },
        },
        columns: [
            { data : 'name', name : 'name'},
            { data : 'position', name : 'position'},
            { data : 'local_union', name : 'local_union'},
            { data : 'gender', name : 'gender'},
            { data : 'age', name : 'age'},
            { data : 'actions', name : 'actions'},
        ],
        columnDefs: [
            { orderable: true, targets: [0, 1, 2, 3, 4] },
            { orderable: false, targets: [5] }
        ]
    });

    // Update modal for update status form
    $('#federation-officers-datatable').on('click', '.remove-officer', function() {
        var oRemoveOfficerButton = $(this);
        let sRemoveOfficerForm = 'remove-officer-form';
        $('#' + sRemoveOfficerForm).find('input[name="guid"]').val(oRemoveOfficerButton.attr('guid'));
        callModal(sRemoveOfficerForm,
            {
                title          : 'Remove Federations Officer',
                content        : 'Are you sure you want to remove this officer from the Trade Federation?',
                confirm_button : 'Remove',
                cancel_button  : 'Cancel',
                success_msg    : 'Officer removed successfully!'
            },
            redrawOfficerTable
        );
    });

    function redrawOfficerTable() {
        oOfficerTable.draw();
    }
});
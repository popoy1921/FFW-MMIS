$(document).ready(function() {
    let oUserTable = $('#trade-federations-datatable');
    let sAjaxLink = oUserTable.attr('reference');

    // Define Trade fedarations table
    let oUserDataTable = $('#trade-federations-datatable').DataTable({
        responsive : true,
        autoWidth  : false,
        processing : true,
        serverSide : true,
        searching  : false,
        ordering   : true,
        ajax       : {
            url  : sAjaxLink,
            type : 'GET',
            data : function (oData) {
                oData.category_id = $('select[name="category_id"]').val();
                oData.id          = $('select[name="id"]').val();
                oData.status_id   = $('select[name="status_id"]').val();
            },
        },
        columns: [
            { data : 'federation_category', name : 'federation_category', render: function(sData, sType, oRow) {return '<i class="fas fa-plus"></i> ' + sData}},
            { data : 'name', name : 'name'},
            { data : 'local_unions', name : 'local_unions'},
            { data : 'status', name : 'status'},
            { data : 'actions', name : 'actions'},
        ],
        rowId: 'federation_category',
        createdRow: function(oRow, oData, iDataIndex) {
            $(oRow).on('click', function() {
                var oTableRow = $(this);
                var sRowId = oTableRow.attr('id').split(' ').join('_');
                var oChildren = $('.child' + sRowId);

                if (oChildren.length) {
                    // If the child row already exists, toggle it
                    oChildren.toggle();
                } else {
                    var oChildRow;
                    oData.records.forEach(oFederation => {
                        // Create a new child row
                        oChildRow = getChildRow(sRowId, oFederation);
                        oTableRow.after(oChildRow);
                        oTableRow = oChildRow;
                    });
                }

                if (oChildren.is(':visible') || oChildren.length < 1) {
                    $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                } else {
                    $(this).find('i ').removeClass('fa-minus').addClass('fa-plus');
                }
            });
        },
        drawCallback : function () {
            var oPrimaryRows = $('.sorting_1').closest('tr');
            oPrimaryRows.trigger('click');
        },
        columnDefs: [
            { orderable: true, targets: [0, 1, 3] }, // Enable sorting for all rows except action
            { orderable: false, targets: [2, 4] },
            { width: '25%', targets: 0 },
            { width: '35%', targets: 1 },
            { width: '15%', targets: 2 },
            { width: '15%', targets: 3 },
            { width: '20%', targets: 4 },
        ],
    });

    // Used to create child row for collapsable records in datatable
    function getChildRow(sRowId, oFederation) {
        var oChildRow = $('<tr>').addClass('child').addClass('child' + sRowId);
        oChildRow.append($('<td>'));                          // Space for category field
        oChildRow.append($('<td>').html(oFederation.name));
        oChildRow.append($('<td>').html(oFederation.local_unions));
        oChildRow.append($('<td>').html(oFederation.status));
        oChildRow.append($('<td>').html(oFederation.actions));
        return oChildRow;
    }
    
    // Update modal for update status form
    $('#trade-federations-datatable').on('click', '.update-status', function() {
        var sUpdateFormSelector, sModalContent;
        var updateStatusButton = $(this);
        updateStatusButton.addClass('remove-button');
        if(updateStatusButton.hasClass('deactivate') === true) {
            sUpdateFormSelector = "deactivate-federation-form";
            sModalContent = 'Are you sure you want to deactivate this Trade Federation?';
        } else {
            sUpdateFormSelector = "activate-federation-form";
            sModalContent = 'Are you sure you want to activate this Trade Federation?';
        }
        let oUpdateForm = $('#' + sUpdateFormSelector);
        oUpdateForm.addClass('trade-federation-status-updating');
        oUpdateForm.find('input[name="guid"]').val(updateStatusButton.attr('guid'));
        callModal(sUpdateFormSelector,
            {
            title          : 'Trade Federation Update',
            content        : sModalContent,
            confirm_button : 'Update',
            cancel_button  : 'Cancel',
            success_msg    : 'You have successfully updated the status.'
            },
            postFederationsStatusUpdate
        );
    });

    // Trigger Filter
    $('#federation-filter-submit').on('click', function() {
        oUserDataTable.draw();
    });
});

// Update button and status on the table
function postFederationsStatusUpdate()
{
    var oUpdatingForm = $('.trade-federation-status-updating');
    var sGuid = oUpdatingForm.find('input[name="guid"]').val();
    var sButtonTemplateClass = '.update-status.activate.template';
    var sUpdatedStatus = 'Inactive';
    if (oUpdatingForm.attr('id') === 'activate-federation-form') {
        sButtonTemplateClass = '.update-status.deactivate.template';
        sUpdatedStatus = 'Active';
    }
    // update button
    var oNewButton = $(sButtonTemplateClass).clone().removeClass('template').attr('guid', sGuid);
    var oButtonForReplacement = $('.remove-button');
    oButtonForReplacement.after(oNewButton);
    oButtonForReplacement.remove();
    // update status
    oNewButton.closest('tr').find('td:eq(3)').html(sUpdatedStatus);
    oUpdatingForm.removeClass('trade-federation-status-updating');
}
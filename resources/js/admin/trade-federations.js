$(document).ready(function() {
    let oUserTable = $('#trade-federations-datatable');
    let sAjaxLink = oUserTable.attr('reference');
    console.log(sAjaxLink)

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
                oData.region_id   = $('select[name="region_id"]').val();
                oData.status_id   = $('select[name="status_id"]').val();
            },
        },
        columns: [
            { data : 'federation_category', name : 'federation_category', render: function(sData, sType, oRow) {return '<i class="fas fa-plus"></i> ' + sData}},
            { data : 'name', name : 'name'},
            { data : 'region', name : 'region'},
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

                if (oChildren.is(':visible')) {
                    $(this).find('i ').removeClass('fa-minus').addClass('fa-plus');
                } else {
                    $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
                }
            });
        },
        columnDefs: [
            { orderable: true, targets: [0, 1, 2, 4] }, // Enable sorting for all rows except action
            { orderable: false, targets: [3, 5] },
            { width: '15%', targets: 0 },
            { width: '20%', targets: 1 },
            { width: '20%', targets: 2 },
            { width: '15%', targets: 3 },
            { width: '10%', targets: 4 },
            { width: '25%', targets: 5 },
        ]
    });

    // Used to create child row for collapsable records in datatable
    function getChildRow(sRowId, oFederation) {
        var oChildRow = $('<tr>').addClass('child').addClass('child' + sRowId);
        oChildRow.append($('<td>'));                          // Space for category field
        oChildRow.append($('<td>').html(oFederation.name));
        oChildRow.append($('<td>').html(oFederation.region));
        oChildRow.append($('<td>').html(oFederation.local_unions));
        oChildRow.append($('<td>').html(oFederation.status));
        oChildRow.append($('<td>').html(oFederation.actions));
        return oChildRow;
    }
    
    // Update modal for update status form
    $('#trade-federations-datatable').on('click', '.update-status', function() {
        var sUpdateFormSelector;
        var updateStatusButton = $(this);
        if(updateStatusButton.hasClass('deactivate') === true) {
            sUpdateFormSelector = "#deactivate-federation-form";
        } else {
            sUpdateFormSelector = "#activate-federation-form";
        }
        $(sUpdateFormSelector).find('input[name="id"]').val(updateStatusButton.data('id'));
    });
});
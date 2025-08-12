$(document).ready(function() {
    let oProvisionTable = $('#regional-distribution-datatable');
    let sAjaxLink = oProvisionTable.attr('reference');

    let oProvisionDataTable = $('#regional-distribution-datatable').DataTable({
        processing : true,
        serverSide : true,
        searching  : false,
        ordering   : true,
        ajax       : {
            url  : sAjaxLink,
            type : 'GET',
            data : function (oData) {
                oData.default_federation = $('input[name="federation_id"]').val();
            },
        },
        columns: [
            { data : 'island_group_description', name : 'island_group_description'},
            { data : 'region_description', name : 'region_description'},
            { data : 'number_of_local_unions', name : 'number_of_local_unions'},
        ],
        columnDefs: [
            { orderable: true, targets: [0, 1] }, // Enable sorting for all rows except action
            { orderable: false, targets: [2] }
        ]
    });

    // Trigger Filter
    $('#provision-filter-submit').on('click', function() {
        oProvisionDataTable.draw();
    });
});
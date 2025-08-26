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
                oData.local_union_id = $('select[name="local_union_id"]').val();
                oData.provision_type_id = $('select[name="provision_type_id"]').val();
            },
        },
        columns: [
            { data : 'local_union', name : 'local_union'},
            { data : 'category', name : 'category'},
            { data : 'provision', name : 'provision'},
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
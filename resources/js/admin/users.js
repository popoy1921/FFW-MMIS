$(document).ready(function() {
    console.log(1);
    let oUserTable = $('#users-datatable');
    let sAjaxLink = oUserTable.attr('reference');

    let oUserDataTable = $('#users-datatable').DataTable({
        processing : true,
        serverSide : true,
        searching  : false,
        ordering   : true,
        ajax       : {
            url  : sAjaxLink,
            type : 'GET',
            data : function (oData) {
                oData.fullname    = $('input[name="fullname"]').val();
                oData.email       = $('input[name="email"]').val();
                oData.federation  = $('input[name="federation"]').val();
                oData.local_union = $('input[name="local_union"]').val();
                oData.role_id     = $('select[name="role_id"]').val();
                oData.status_id   = $('select[name="status_id"]').val();
            },
        },
        columns: [
            { data : 'fullname', name : 'fullname'},
            { data : 'email', name : 'email'},
            { data : 'federation', name : 'federation'},
            { data : 'local_union', name : 'local_union'},
            { data : 'role', name : 'role'},
            { data : 'status', name : 'status'},
            { data : 'actions', name : 'actions'},
        ],
        columnDefs: [
            { orderable: true, targets: [0, 1, 2, 3, 4, 5] }, // Enable sorting for all rows except action
            { orderable: false, targets: [6] }
        ]
    });
    
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
});
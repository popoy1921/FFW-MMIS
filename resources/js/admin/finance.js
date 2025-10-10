$(document).ready(function() {
    console.log(1);
    $('.cb-search-container').on('change', '[name="federation_id"]', function() {
        let iFeddeartionId = $(this).val();
        console.log(iFeddeartionId);
    });

    async function populateLocalUnions() {
        try {
            const response = await axios.get('/');
            console.log('Data received:', response.data);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    let oRegionalDistributionTable = $('#regional-distribution-datatable');
    let sAjaxLink = oRegionalDistributionTable.attr('reference');

    let oRegionalDistributionataTable = $('#regional-distribution-datatable').DataTable({
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
});
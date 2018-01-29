var initTableVendeurs = function () {
    var initTable = function () {
        var table = $('#datatable_vendeurs');
        if (table.length && ! $.fn.DataTable.isDataTable( '#datatable_evenements' )) {
            var oTable = table.dataTable({
                "language": {
                    url: params.baseurl + '/app/webroot/js/global/plugins/datatables/fr_FR.json'
                },
                buttons: [
                    {extend: 'print', className: 'btn dark btn-outline', text: 'Imprimer', orientation: 'landscape',pageSize: 'LEGAL'},
                    {extend: 'copy', className: 'btn red btn-outline', text: 'Copier'},
                    {extend: 'pdf', className: 'btn green btn-outline', text: 'PDF', orientation: 'landscape',pageSize: 'LEGAL'},
                    {extend: 'excel', className: 'btn yellow btn-outline ', text: 'Excel'},
                    {extend: 'csv', className: 'btn purple btn-outline ', text: 'CSV'},
                    {extend: 'colvis', className: 'btn dark btn-outline', text: 'Colonnes'}
                ],
                "bStateSave": true,
                responsive: true,
                //"ordering": false,
                //"paging": false,
                "order": [
                    [0, 'asc']
                ],
                "lengthMenu": [
                    [10, 20, 50, -1],
                    [10, 20, 50, "All"]
                ],
                "pageLength": 10,
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                "initComplete": function (settings, json) {
                    $('#infos_vendeurs').show();
                    $('.xefi-loading').hide();
                }
            });
        }
    }
    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            initTable();

        }
    };

}();
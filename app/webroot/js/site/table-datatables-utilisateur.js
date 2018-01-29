var initTableUtilisateur = function () {
    var initTable = function () {
        var table = $('#datatable_utilisateur');
        if (table.length && ! $.fn.DataTable.isDataTable( '#datatable_utilisateur' )) {
            var oTable = table.dataTable({
                "language": {
                    url: params.baseurl + '/app/webroot/js/global/plugins/datatables/fr_FR.json'
                },
                buttons: [
                    {extend: 'colvis', className: 'btn dark btn-outline', text: 'Colonnes'},
                    {extend: 'print', className: 'btn dark btn-outline', text: 'Imprimer', orientation: 'landscape',pageSize: 'LEGAL'},
                    {extend: 'copy', className: 'btn red btn-outline', text: 'Copier'},
                    {extend: 'pdf', className: 'btn green btn-outline', text: 'PDF', orientation: 'landscape',pageSize: 'LEGAL'},
                ],
                "bStateSave": true,
                //responsive: true,
                //"ordering": false,
                "columnDefs": [
                    { "orderable": false, "targets": 5 }
                ],
                "lengthMenu": [
                    [10, 20, 50, -1],
                    [10, 20, 50, "All"]
                ],
                "pageLength": 10,
                "pagingType":"bootstrap_full_number",
                "order": [
                    [0, 'asc']
                ],
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
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
            $('.edit-utilisateur').editable({
                emptytext: 'Saisie requise',
                name: 'edit-utilisateur',
                url: params.baseurl+'/ajax/admin/update_utilisateurs',
                type: 'text',
                validate: function(value) {
                    if ($.trim(value) == '') return 'Champs obligatoire';
                },
            });
            $('[data-toggle="popover"]').popover({container: 'body'});
        }
    };

}();
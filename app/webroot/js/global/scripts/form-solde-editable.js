var FormSoldeEditable = function() {

    var initSoldesEditables = function() {
        //global settings
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = params.baseurl+'/app/conges/ajax/conges_soldes/edit_soldes';
        $.fn.editable.defaults.emptytext = 'Non renseigné';
        //editables element samples

        $('.solde_editable').editable({
            emptytext: 'Non renseigné',
            validate: function(value) {
                if ($.trim(value) == '') return 'ce compteur est requis';
                if (!$.isNumeric(value)) {
                    return 'ce compteur doit être un nombre';
                }
            },
            display: function(value) {
                if(!isNaN(value) && value.trim()){
                    $(this).text(parseFloat(value).toFixed(1));
                }else{
                    $(this).text('');
                }
            }
        })
        .on('shown', function(e, editable) {
            editable.option('params', {
                annee:$(this).attr("data-annee"),
                type:$(this).attr("data-categorie"),
                section:$(this).attr("data-section"),
                utilisateur:$(this).attr("data-utilisateur")
            })
        });

        $('.solde_editable').on('save', function(e, params) {
            var obj = jQuery.parseJSON(params.response);
            $newsolde = params.newValue-$(this).parent().next('td').html();
            $(this).parent().nextAll('td:eq(1)').html($newsolde);
            toastr[obj.status](obj.message);
        });


    }

    return {
        //main function to initiate the module 
        init: function() {
            // init editable elements
            initSoldesEditables();
        }

    };

}();

jQuery(document).ready(function() {
    FormSoldeEditable.init();
});
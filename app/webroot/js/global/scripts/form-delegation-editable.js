var FormDelegationEditable = function() {

    var initDelegationsEditables = function() {
        //global settings
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = params.baseurl+'/app/conges/ajax/conges_heures/edit_delegations';
        //editables element samples

        $('.delegation_editable').editable({
            validate: function(value) {
                if ($.trim(value) == '') return 'ce compteur est requis';
                if(!$.isNumeric(value)){
                    return 'ce compteur doit être un nombre'
                }
            },
            display: function(value) {
                $(this).text(parseFloat(value).toFixed(2));
            }
        })
        .on('shown', function(e, editable) {
                editable.option('params', {
                    date:$(this).attr("data-date"),
                    utilisateur:$(this).attr("data-utilisateur")
                })
            });

        $('.delegation_editable').on('save', function(e, params) {
            $new = params.newValue;
            var obj = jQuery.parseJSON(params.response);
            toastr[obj.status](obj.message);
            $old = obj.old;
            //console.log($old);
            if(!$old){
                $old=0;
            }
            $old_total = $(this).parent().prevAll('.total').html();
            //console.log($old_total);
            //console.log($old);
            //console.log($new);
            $new_total = parseFloat($old_total) - parseFloat($old) + parseFloat($new);
            //console.log($new_total);
            $(this).parent().prevAll('.total').html($new_total.toFixed(2));
        });
    }

    return {
        //main function to initiate the module 
        init: function() {
            // init editable elements
            initDelegationsEditables();
        }

    };

}();

jQuery(document).ready(function() {
    FormDelegationEditable.init();
});
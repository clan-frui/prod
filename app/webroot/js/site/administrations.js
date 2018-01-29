jQuery(document).ready(function () {
    initTableUtilisateur.init();
    initTableAco.init();

    // Changement du statut avec l'icone
    $(document).on('click', '.statut', function (e) {
        e.preventDefault();
        var $id = $(this).attr('data-id');
        var $statut = $(this).attr('data-statut');
        var $that = $(this);
         $.post(
             params.baseurl+'/ajax/admin/update_utilisateurs/'+$id,
             {
                userId: $id,
                statut: $statut
             }
         ).done(function (data) {
             var json = $.parseJSON(data);
             if(json.status == "success"){
                 toastr["success"](json.message);
                 $that.attr('data-statut', json.statut);
                 $($that.children()).remove();
                 $that.html(json.icon);
             }else{
                 if(json.message != ""){
                     toastr["error"](json.message);
                 }else{
                     toastr["error"]("Erreur lors de l'enregistrement de la modification");
                 }
             }
         });
    });

    // Suppression de l'utilisateur
    $(document).on('click', '.supprimerUtilisateur', function (e) {
        e.preventDefault()
        var $id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.post(
                    params.baseurl+'/ajax/admin/delete_utilisateurs/'+$id
                ).done(function (data) {
                    var json = $.parseJSON(data);
                    if(json.status == "success"){
                        toastr["success"](json.message);
                        $('#utilisateurs').fadeOut();
                        $.post(params.baseurl+'/ajax/admin/view_utilisateurs/', function (data) {
                            $('#utilisateurs').html(data);
                            $('#utilisateurs').fadeIn();
                            initTableUtilisateur.init();
                        });
                    }else{
                        if(json.message != ""){
                            toastr["error"](json.message);
                        }else{
                            toastr["error"]("Erreur lors de l'enregistrement de la modification");
                        }
                    }
                });
            }
        });
    });

    // Creation d'une miniature avec upload et formulaire
    function editRole($id = '') {
        ComponentsSelect2.init();
        $('#createModal').modal('show').find('.modal-body').load(params.baseurl + '/ajax/administrations/edit_role/'+$id, function(){
            if($('#AcoAroAjaxEditRoleForm') != undefined){
                var form = $('#AcoAroAjaxEditRoleForm');
            }else{
                form = '';
            }
            var error = $('.alert-danger', form);
            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                    'data[AcoAro][aro_nom]': {
                        required: true,
                    },
                },
                invalidHandler: function (event, validator) { //display error alert on form submit
                    error.show();
                    App.scrollTo(error, -200);
                },
                errorPlacement: function (error, element) { // render error placement for each input type
                    var cont = $(element).parent('.input-group');
                    if (cont) {
                        cont.after(error);
                    } else {
                        element.after(error);
                    }
                },
                highlight: function (element) { // hightlight error inputs

                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },
                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },
                submitHandler: function (form) {
                    error.hide();
                    $.post( params.baseurl+'/ajax/administrations/save_role/'+$id, $("#AcoAroAjaxEditRoleForm").serialize()).done(function( data ) {
                        var json = $.parseJSON(data);
                        if(json.status == "success"){
                            toastr["success"](json.message);
                            $('#createModal').modal('toggle');
                            $('#acos').fadeOut();
                            $.post(params.baseurl+'/ajax/administrations/view_acos/', function (data) {
                                $('#acos').html(data);
                                initTableAco.init();
                                $('#acos').fadeIn()
                            });
                        }else{
                            if(json.message != ""){
                                toastr["error"](json.message);
                            }else{
                                toastr["error"]("Erreur lors de l'enregistrement de la modification");
                            }
                        }
                    });
                }
            });
            $('.select2').select2();
        });

    }

    // Edition d'un rôle
    $(document).on('click', '.editRole', function (e){
        e.preventDefault();
        e.stopPropagation();
        var $id = $(this).attr('data-id');
        editRole($id);
        return false;
    });

    $(document).on('click', '.addRole', function (e){
        e.preventDefault();
        e.stopPropagation();
        editRole();
        return false;
    });

    $(document).on('change', '#AcoAroAcosId', function (e){
        e.preventDefault();
        if($(this).val() == null){
            $('#acosSelected').html(0);
        }else{
            $('#acosSelected').html($(this).val().length);
        }
    });

    $(document).on('click', '.supprimerRole', function (e) {
        e.preventDefault();
        var $id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.post(
                    params.baseurl+'/ajax/admin/delete_role/'+$id
                ).done(function (data) {
                    var json = $.parseJSON(data);
                    if(json.status == "success"){
                        toastr["success"](json.message);
                        $('#acos').fadeOut();
                        $.post(params.baseurl+'/ajax/admin/view_acos/', function (data) {
                            $('#acos').html(data);
                            $('#acos').fadeIn();
                            initTableAco.init();
                        });
                    }else{
                        if(json.message != ""){
                            toastr["error"](json.message);
                        }else{
                            toastr["error"]("Erreur lors de l'enregistrement de la modification");
                        }
                    }
                });
            }
        });
    })

    function editRoleUtilisateur($id = '') {
        ComponentsSelect2.init();
        $('#createModal').modal('show').find('.modal-body').load(params.baseurl + '/ajax/administrations/edit_role_utilisateur/'+$id, function(){
            if($('#UserAjaxEditRoleUtilisateurForm') != undefined){
                var form = $('#UserAjaxEditRoleUtilisateurForm');
            }else{
                form = '';
            }
            var error = $('.alert-danger', form);
            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                    'data[AcoAro][aro_nom]': {
                        required: true,
                    },
                },
                invalidHandler: function (event, validator) { //display error alert on form submit
                    error.show();
                    App.scrollTo(error, -200);
                },
                errorPlacement: function (error, element) { // render error placement for each input type
                    var cont = $(element).parent('.input-group');
                    if (cont) {
                        cont.after(error);
                    } else {
                        element.after(error);
                    }
                },
                highlight: function (element) { // hightlight error inputs

                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },
                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },
                submitHandler: function (form) {
                    error.hide();
                    $.post( params.baseurl+'/ajax/administrations/save_role_utilisateur/'+$id, $("#UserAjaxEditRoleUtilisateurForm").serialize()).done(function( data ) {
                        var json = $.parseJSON(data);
                        if(json.status == "success"){
                            toastr["success"](json.message);
                            $('#createModal').modal('toggle');
                            $('#datatable_utilisateur').fadeOut();
                            $.post(params.baseurl+'/ajax/administrations/view_utilisateurs/', function (data) {
                                $('#datatable_utilisateur').html(data);
                                initTableUtilisateur.init();
                                $('#datatable_utilisateur').fadeIn()
                            });
                        }else{
                            if(json.message != ""){
                                toastr["error"](json.message);
                            }else{
                                toastr["error"]("Erreur lors de l'enregistrement de la modification");
                            }
                        }
                    });
                }
            });
            $('.select2').select2();
        });

    }

    $(document).on('click', '.editRoleUtilisateur', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var $id = $(this).attr('data-id');
        editRoleUtilisateur($id);
        return false;
    })

    $('#createModal').on('hidden.bs.modal', function (e) {
        $("#createModal .modal-body").html("");
    });

});
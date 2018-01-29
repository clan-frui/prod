jQuery(document).ready(function() {

    // Quand la page est chargée
    $(window).load(function() {
        $('.row').show();
        $('.loading').hide();
    })

    // Detection si ecran portable ou mobile
    if(window.innerWidth < 1400 && window.innerWidth > 500){
        $('.laptop').height('1800')
        $(document).scroll(function (e) {
            e.preventDefault();
            if(window.scrollY > 1000){
                console.log(window.scrollY);
                $('.div-pagination').css('position', 'absolute');
                $('.div-pagination').css('top', '95%');
                $('.div-pagination').css('left', '2%');
            }else{
                $('.div-pagination').css('position', 'fixed');
                $('.div-pagination').css('top', '92%');
                $('.div-pagination').css('left', '6%');
            }
        })

    }
    else if(window.innerWidth < 500){
        $('.smartphone').height('3750')
    }

    // Creation d'une miniature avec upload et formulaire
    function createMiniature() {
        ComponentsSelect2.init();
        $('#createModal').modal('show').find('.modal-body').load(params.baseurl + '/ajax/actu/create_miniatures', function(){
            // Initialize the jQuery File Upload widget:
            $('#titreMiniatureHidden, #resumeMiniatureHidden').hide();
            $('#createMiniatureAjaxCreateMiniaturesForm').fileupload({
                url: params.baseurl+'/imports/upload',
                acceptFileTypes: /(\.|\/)(jpe?g|png)$/i,
                paramName: "file",
                maxNumberOfFiles: 1,
                limitMultiFileUploads: 1,
                done: function (e, data) {;
                    $('.fileupload-buttonbar, #uploadTable').fadeOut();
                    $('#titreMiniatureHidden, #resumeMiniatureHidden').show();
                    toastr["success"]('Image Enregistré avec succès.');
                },
            })
            if($('#createMiniatureAjaxCreateMiniaturesForm') != undefined){
                var form = $('#createMiniatureAjaxCreateMiniaturesForm');
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
                    'data[createMiniature][titreMiniature]': {
                        required: true,
                    },
                    'data[createMiniature][resumeMiniature]': {
                        required: true
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
                    $.post( params.baseurl+'/ajax/actu/save_miniatures/', $("#createMiniatureAjaxCreateMiniaturesForm").serialize()).done(function( data ) {
                        var json = $.parseJSON(data);
                        if(json.status == "success"){
                            toastr["success"](json.message);
                            $('#createModal').modal('toggle');
                            $('.refreshActu').fadeOut();
                            $.post(params.baseurl+'/ajax/actu/view_all_actus/', function (data) {
                                console.log(data);
                                $('.refreshActu').html(data);
                                $('.refreshActu').fadeIn()
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

    // Modal de connexion au site
    function usernameLogin() {
        ComponentsSelect2.init();
        $('#createModal').modal('show').find('.modal-body').load(params.baseurl + '/users/login', function(){
            if($('#UserLoginForm') != undefined){
                var form = $('#UserLoginForm');
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
                    'data[User][mail]': {
                        required: true,
                    },
                    'data[User][password]': {
                        required: true
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
                        .closest('.form-group').removeClass('has- error'); // set error class to the control group
                },
                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },
                submitHandler: function (form) {
                    error.hide();
                    $.post(params.baseurl+'/ajax/users/user_login/', $("#UserLoginForm").serialize()).done(function( data ) {
                        var json = $.parseJSON(data);
                        if(json.status == "success"){
                            toastr["success"](json.message);
                            $('#createModal').modal('toggle');
                            setTimeout(connectUser(), 0);
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

    // Modal de d'inscription au site
    function usernameSubscribe() {
        ComponentsSelect2.init();
        $('#createModal').modal('show').find('.modal-body').load(params.baseurl + '/ajax/users/user_subscribe', function(){
            if($('#UserAjaxUserSubscribeForm') != undefined){
                var form = $('#UserAjaxUserSubscribeForm');
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
                    'data[User][mail]': {
                        required: true,
                        email: true
                    },
                    'data[User][password]': {
                        required: true
                    },
                    'data[User][pseudo]': {
                        required: true
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
                        .closest('.form-group').removeClass('has- error'); // set error class to the control group
                },
                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },
                submitHandler: function (form) {
                    error.hide();
                    $.post(params.baseurl+'/ajax/users/save_user/', $("#UserAjaxUserSubscribeForm").serialize()).done(function( data ) {
                        var json = $.parseJSON(data);
                        if(json.status == "warning"){
                            toastr["warning"](json.message);
                            $('#createModal').modal('toggle');
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

    // URL de redirection apres connection
    var connectUser = function () {
        var $url = params.baseurl + '/' + params.url;
        window.location.replace(
            $url
        );

    }

    // Creation d'actu avec tinyMCE
    tinymce.init({
        selector: '#myTextarea',
        height: 500,
        theme: 'modern',
        plugins: 'save print preview fullpage searchreplace autolink directionality visualblocks' +
        ' visualchars' +
        ' fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
        toolbar1: 'save formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter' +
        ' alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        save_onsavecallback: function () {
            var contenuHtml = tinyMCE.get('myTextarea').getContent();
            var $actuId = $('#myTextarea').attr('data-actuId');
            $.post(
                params.baseurl + '/ajax/actu/save_actus',
                {
                    html: contenuHtml,
                    actuId: $actuId,
                    action: params.action
                }
            ).done(function (data) {
                var json = $.parseJSON(data);
                toastr["success"](json.message);
                $('#tinyDisplayoff').hide();
                $('#titleDisplayOn').show();
                $('#formTiny').fadeOut();
                /*$.post(params.baseurl+'/ajax/actu/view_actus/' + $actuId, function (data) {
                    $('.ActuDisplayNone').html(data);
                    $('.ActuDisplayNone').fadeIn()
                });*/
                setTimeout(function(){window.location.replace(params.baseurl+'/ajax/actu/view_actus/' + $actuId);}, 200);
            }).fail(function (data) {
                var json = $.parseJSON(data);
                toastr["error"](json.message);
            })
        },
        file_picker_callback: function(callback, value, meta) {
            if (meta.filetype == 'image') {
                $('#upload').trigger('click');
                $('#upload').on('change', function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        callback(e.target.result, {
                            alt: ''
                        });
                    };
                    reader.readAsDataURL(file);
                });
            }
        },
    });

    // Ouvre le modal de creation de miniature
    $(document).on('click', '.miniatureCreate', function (e) {
        e.preventDefault();
        e.stopPropagation();
        createMiniature();
        return false;
    })

    // Affiche la fenetre de tinyMCE quand on clique sur le bouton
    $(document).on('click', '.miniatureActu', function (e) {
        e.preventDefault();
        $('.contenuArticle').show();
        $(this).hide();
    })

    // Pagination
    var $pagination = $('#pagination-actu');
    var $nbPage = $pagination.attr('data-nbPage');
    var defaultOpts = {
        totalPages: $nbPage,
        visiblePages: 5,
        first: 'Premier',
        last: 'Dernier',
        prev: 'Précédent',
        next: 'Suivant',
        hideOnlyOnePage: true,
    };
    $pagination.twbsPagination(defaultOpts);
    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        var $page = $('.page-item+.active').children().html();
        $.post(
            params.baseurl + '/ajax/actu/view_all_actus',
            {
                currentPage: $page
            }
        ).done(function (data) {
            $('.refreshActu').fadeOut('slow');
            $('.refreshActu').fadeIn();
            $('.refreshActu').html(data);
        }).fail(function (data) {

        })
    })

    // Ouvre le modal de connection
    $(document).on('click', '.usernameLogin', function (e) {
        e.preventDefault();
        e.stopPropagation();
        usernameLogin();
        return false;
    })

    // Ouvre le modal d'inscription
    $(document).on('click', '.usernameSubscribe', function (e) {
        e.preventDefault();
        e.stopPropagation();
        usernameSubscribe();
        return false;
    })

});
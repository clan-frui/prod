var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            var form = $('#XoodleQuestionnaireAnswerQuestionnaireForm');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "template") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "proposition[0][label]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_proposition_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "template") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                            .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    //success.show();
                    error.hide();
                    console.log($('#XoodleQuestionnaireAnswerQuestionnaireForm').serialize());
                    $.post( params.baseurl+'/app/xoodle/ajax/xoodle_welcomes/answer/', $('#XoodleQuestionnaireAnswerQuestionnaireForm').serialize()).done(function( data ) {
                        var json = $.parseJSON(data);
                        if(json.status == "success"){
                            swal({
                                    title: "Félicitations !",
                                    text: json.message,
                                    type: "success",
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    showCancelButton: false
                                });
                            $("#submit_questionnaire").hide();
                        }else{
                            if(json.message != ""){
                                toastr["error"](json.message);
                            }else{
                                toastr["error"]("Erreur lors de l'enregistrement");
                            }
                        }
                    });
                }

            });

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_questionnaire')).text('ETAPE ' + (index + 1) + ' SUR ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_questionnaire')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }
                if (current == 1) {
                    $('#form_wizard_questionnaire').find('.button-previous').hide();
                } else {
                    $('#form_wizard_questionnaire').find('.button-previous').show();
                }
                if (current >= total) {
                    $('#form_wizard_questionnaire').find('.button-next').hide();
                    $('#form_wizard_questionnaire').find('.button-submit').show();
                } else {
                    $('#form_wizard_questionnaire').find('.button-next').show();
                    $('#form_wizard_questionnaire').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }
            // default form wizard
            $('#XoodleQuestionnaireAnswerQuestionnaireForm').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#XoodleQuestionnaireAnswerQuestionnaireForm').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#XoodleQuestionnaireAnswerQuestionnaireForm').find('.button-previous').hide();
            $('#XoodleQuestionnaireAnswerQuestionnaireForm .button-submit').click(function () {
                $('#XoodleQuestionnaireAnswerQuestionnaireForm').submit();
            }).hide();
        }

    };

}();


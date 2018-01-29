<?php  #region CSS
$this->startIfEmpty('css');
$this->end();
    #endregion
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet bordered">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="/vegeta/img/site/miniature/a.jpg" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $user['User']['prenom'] . ' ' . $user['User']['nom']; ?> </div>
                    <div class="profile-usertitle-job"> <?= $user['User']['pseudo'] . ' (' . $user['Group']['role'] . ')'; ?> </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-circle red btn-sm">Message</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">

                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Mon profil </span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#infoPerso" data-toggle="tab" aria-expanded="true">Info personnelle</a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_2" data-toggle="tab" aria-expanded="false">Changer photo de profil</a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_3" data-toggle="tab" aria-expanded="false">Changer mot de passe</a>
                                </li>
                                <!--<li class="">
                                    <a href="#tab_1_4" data-toggle="tab" aria-expanded="false">Paramétrage</a>
                                </li>-->
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="infoPerso">
                                    <?php
                                    echo $this->requestAction(
                                        array(
                                            'controller' => 'users',
                                            'action' => 'ajax_view_profile_info_perso',
                                            'ajax' => true,
                                        ),
                                        array(
                                            'return'
                                        )
                                    );
                                    ?>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <form action="#" role="form">
                                        <div class="form-group">
                                            <label style="padding-left: 0px;padding-bottom: 10px;" class="control-label col-xs-4">Image de profil :</label><?
                                                echo $this->Form->input('pieces_jointe', array('id' => 'uploadPicUser', 'label' => false, 'type' => 'file', 'class'=> 'file-loading'));?>
                                        </div>

                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green"> Sauvegarder </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <form action="#">
                                        <div class="form-group">
                                            <label class="control-label">Mot de passe actuel</label>
                                            <?=
                                            $this->Form->input('mdpActuel', array(
                                                'type' => 'password',
                                                'div' => false,
                                                'value' => 'testtest',
                                                'label' => false,
                                                'class' => "form-control",
                                            ));
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Nouveau mot de passe</label>
                                            <?=
                                            $this->Form->input('mdpNew', array(
                                                'type' => 'password',
                                                'div' => false,
                                                'value' => 'testtest',
                                                'label' => false,
                                                'class' => "form-control",
                                            ));
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Confirmation</label>
                                            <?=
                                            $this->Form->input('mdpConfirm', array(
                                                'type' => 'password',
                                                'div' => false,
                                                'value' => 'testtest',
                                                'label' => false,
                                                'class' => "form-control",
                                            ));
                                            ?>
                                        </div>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn green"> Sauvegarder </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                                <!-- PRIVACY SETTINGS TAB -->
                                <!--<div class="tab-pane" id="tab_1_4">
                                    <form action="#">
                                        <table class="table table-light table-hover">
                                            <tbody><tr>
                                                <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input name="optionsRadios1" value="option1" type="radio"> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input name="optionsRadios1" value="option2" checked="" type="radio"> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input name="optionsRadios11" value="option1" type="radio"> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input name="optionsRadios11" value="option2" checked="" type="radio"> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input name="optionsRadios21" value="option1" type="radio"> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input name="optionsRadios21" value="option2" checked="" type="radio"> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                <td>
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input name="optionsRadios31" value="option1" type="radio"> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input name="optionsRadios31" value="option2" checked="" type="radio"> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <div class="margin-top-10">
                                            <a href="javascript:;" class="btn red"> Save Changes </a>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                    </form>
                                </div>-->
                                <!-- END PRIVACY SETTINGS TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<?php
#region JAVASCRIPT
$this->startIfEmpty('script');
echo $this->Html->script('site/user.js');
$this->end();
#endregion
?>
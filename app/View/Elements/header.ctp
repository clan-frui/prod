<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <?php
            //echo $this->Html->image('logo-mini.png', array('alt' => 'Le Bureau Virtuel','class' => 'logo-default','style' => 'height: 20px;margin-top: 24px;'));
            ?>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="page-top">
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!--<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" id="show_notif" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default" id="badge_notification"> 0 </span>
                        </a>
                        <ul class="dropdown-menu extended"></ul>
                    </li>
                    <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                        <a href="javascript:;" class="dropdown-toggle" id="show_progress" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-close-on-body-click="false">
                            <i class="icon-calendar"></i>
                            <span class="badge badge-default" id="badge_task"> 0 </span>
                        </a>
                        <ul class="dropdown-menu extended tasks"></ul>
                    </li>-->
                    <?php if(!$this->Session->read('Auth.User.id')){ ?>
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle usernameLogin" data-toggle="dropdown"
                               data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-user-circle-o"></i>
                                <span class="username hidden-md hidden-sm hidden-xs"> Connexion </span>
                            </a>
                        </li>
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle usernameSubscribe" data-toggle="dropdown"
                               data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-user-plus"></i>
                                <span class="username hidden-md hidden-sm hidden-xs"> Inscription
                                </span>
                            </a>
                        </li>
                    <?php } else{ ?>
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <?= $this->Html->image('site/icone-utilisateur/' . $this->Session->read('Auth.User.SiteImageUtilisateur.img')); ?>
                                <span class="username hidden-md hidden-sm hidden-xs">
                                    <?= $this->Session->read('Auth.User.pseudo'); ?>
                                </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <?=
                                    $this->Html->link("<i class=\"fa fa-address-card-o\" aria-hidden=\"true\"></i>Mon profil",
                                        array(
                                            'controller' => 'users',
                                            'action' => 'ajax_view_profile',
                                            'ajax' => true
                                        ),
                                        array(
                                            'escape' => false
                                        )
                                    );
                                    ?>
                                </li>
                                <li>
                                    <?=
                                        $this->Html->link("<i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i>Deconnexion",
                                            array(
                                                'controller' => 'users',
                                                'action' => 'logout',
                                                'ajax' => false
                                            ),
                                            array(
                                                'escape' => false
                                            )
                                        );
                                    ?>
                                </li>
                            </ul>
                        </li>
                        <?php if(in_array($this->Session->read('Auth.User.group_id'), array(1, 2, 3))){ ?>
                            <li class="dropdown dropdown-user">
                                <?= $this->Html->link(
                                    "<i class=\"fa fa-tachometer\" aria-hidden=\"true\"></i>
                                    <span class=\"username hidden-md hidden-sm hidden-xs\">Administration</span>",
                                    array(
                                        'controller' => 'administrations',
                                        'action' => 'index',
                                        'ajax' => false
                                    ),
                                    array(
                                        'class' => 'dropdown-toggle',
                                        'escape' => false,
                                    )
                                ); ?>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
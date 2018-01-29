<?php
    $ctrl = $this->params['controller'];
    $action = $this->params['action'];
?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <?php
            $selected = (($ctrl == 'accueils' && $action == 'index') ? true : false)?>
            <li class="nav-item <?= ($selected) ? 'start active open' : ''; ?>">
                <?= $this->Html->link('<i class="fa fa-home"></i><span class="title"> Accueil</span>',
                    array(
                        'controller' => 'accueils',
                        'action' => 'index',
                        'ajax' => false
                    ),
                    array(
                        'escape' => false,
                        'class' => 'nav-link nav-toggle menu_link'
                    )
                ); ?>
            </li>
            <?php
            $selected = (($ctrl == 'actualites') ? true : false)?>
            <li class="nav-item <?= ($selected) ? 'start active open' : ''; ?>">
                <?= $this->Html->link('<i class="fa fa-newspaper-o"></i><span class="title"> Actualité</span>',
                    array(
                        'controller' => 'actualites',
                        'action' => 'index',
                        'ajax' => false
                    ),
                    array(
                        'escape' => false,
                        'class' => 'nav-link nav-toggle menu_link'
                    )
                ); ?>
                <?php
                $selected = (($ctrl == 'games') ? true : false)?>
                <li class="nav-item <?= ($selected) ? 'start active open' : ''; ?>">
                    <?= $this->Html->link('<i class="fa fa-gamepad"></i><span class="title"> Jeux</span>',
                        array(
                            'controller' => 'games',
                            'action' => 'index',
                            'ajax' => false
                        ),
                        array(
                            'escape' => false,
                            'class' => 'nav-link nav-toggle menu_link'
                        )
                    ); ?>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <?= $this->Html->link('<i class="fa fa-gamepad"></i>' . $this->Html->Image('site/a.png') .
                                '<span class="title"> LOL</span>',
                                array(
                                    'controller' => 'games',
                                    'action' => 'ajax_view_lol',
                                    'ajax' => false
                                ),
                                array(
                                    'escape' => false,
                                    'class' => 'nav-link nav-toggle menu_link'
                                )
                            ); ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link('<i class="fa fa-gamepad"></i><span class="title"> HOTS</span>',
                                array(
                                    'controller' => 'games',
                                    'action' => 'ajax_view_hots',
                                    'ajax' => false
                                ),
                                array(
                                    'escape' => false,
                                    'class' => 'nav-link nav-toggle menu_link'
                                )
                            ); ?>
                        </li>
                    </ul>
                </li>
            </li>
                <?php $selected = (($ctrl == 'forums') ? true : false)?>
                <li class="nav-item <?= ($selected) ? 'start active open' : ''; ?>">
                    <?= $this->Html->link('<i class="fa fa-comments-o"></i><span class="title"> Forum</span>',
                        array(
                            'controller' => 'forums',
                            'action' => 'index',
                            'ajax' => false
                        ),
                        array(
                            'escape' => false,
                            'class' => 'nav-link nav-toggle menu_link'
                        )
                    ); ?>
                </li>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->

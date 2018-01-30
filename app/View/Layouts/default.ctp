<!DOCTYPE html>
<html>
<head>
   <?php
    // Css global
        echo $this->Html->css('global/plugins/font-awesome/css/font-awesome.min.css')."\n";
        echo $this->Html->css('global/plugins/bootstrap/css/bootstrap.min.css')."\n";
        echo $this->Html->css('global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')."\n";
        echo $this->Html->css('global/plugins/select2/css/select2.min.css')."\n";
        echo $this->Html->css('global/plugins/select2/css/select2-bootstrap.min.css')."\n";
        echo $this->Html->css('global/plugins/bootstrap-toastr/toastr.min.css');

        echo $this->Html->css('global/css/components-rounded.css')."\n";
        echo $this->Html->css('global/plugins/datatables/datatables.min.css')."\n";
        echo $this->Html->css('global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')."\n";
        echo $this->Html->css('jquery-ui-1.9.2.custom.css')."\n";
        echo $this->Html->css('global/css/plugins.min.css')."\n";
        echo $this->Html->css('global/plugins/bootstrap-editable/css/bootstrap-editable.css');
        echo $this->Html->css('global/plugins/metronic/components.min.css');
        echo $this->Html->css('global/plugins/metronic/profile.min.css');

        echo $this->Html->css('layout2/css/layout.min.css')."\n";
        echo $this->Html->css('layout2/css/themes/grey.css')."\n";
        echo $this->Html->css('layout2/css/custom.css')."\n";
    // Style de l'accueil
        echo $this->Html->css('site/style_accueil.css')."\n";
        echo $this->Html->css('site/style_actualite.css')."\n";
        echo $this->Html->css('site/style.css')."\n";
        echo $this->Html->css('site/style_admin.css');
       echo $this->Html->css('global/plugins/file-input/fileinput.css');
    // Css de l'import Miniature
        echo $this->Html->css('jQuery-File-Upload/css/jquery.fileupload.css')."\n";
        echo $this->Html->css('jQuery-File-Upload/css/jquery.fileupload-ui.css')."\n";
    ?>
    <title>Clan FRUI  - <?php echo $this->fetch('title'); ?></title>
</head>
<body class="page-container-bg-solid page-header-fixed page-footer-fixed page-sidebar-closed">
    <?php echo $this->element('header'); ?>
    <div class="clearfix"> </div>
    <div class="page-container">
    <?php echo $this->element('sidebar'); ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <?=
                    $this->Session->Read('Auth.User.SiteImageUtilisateur.id') ?
                        $this->Html->image('site/loading/' . $this->Session->Read('Auth.User.SiteImageUtilisateur.img') . '.gif'
                            , array('class' => 'loading')) :
                        $this->Html->image('site/loading/fruits-tomato.gif', array('class' => 'loading'));
                ?>
                <?php echo $this->fetch('content'); ?>
                <div class="modal fade" id="createModal" role="basic" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body"><?php
                                echo $this->Html->image('site/loading/fruits-tomato.gif', array('class' => 'loading'));?>
                                <span> &nbsp;&nbsp;Chargement... </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="padding-top: 50px;margin-bottom: 50px;">
        <?php echo $this->element('sql_dump'); ?>
    </div>
    <?php echo $this->element('footer'); ?>
</body>
    <?php
        echo "<!--[if lt IE 9]>";
        echo $this->Html->script('global/plugins/respond.min.js');
        echo $this->Html->script('global/plugins/excanvas.min.js');
        echo $this->Html->script('global/plugins/ie8.fix.min.js');
        echo "<![endif]-->";
        //BEGIN CORE PLUGINS
    // Plugin js Global
        echo $this->Html->script('global/jquery.min.js');
        echo $this->Html->script('global/plugins/bootstrap/js/bootstrap.min.js');
        echo $this->Html->script('global/plugins/bootstrap-switch/js/bootstrap-switch.min.js');
        echo $this->Html->script('global/plugins/select2/js/select2.full.js');

        echo $this->Html->script('global/plugins/bootstrap-toastr/toastr.min.js');
        echo $this->Html->script('global/plugins/jquery-validation/js/jquery.validate.min.js');

        echo $this->Html->script('global/scripts/app.min.js')."\n";
        echo $this->Html->script('global/scripts/components-select2.js')."\n";
        echo $this->Html->script('global/plugins/select2/js/i18n/fr.js');
        echo $this->Html->script('global/scripts/components-color-pickers.js')."\n";
        echo $this->Html->script('global/plugins/datatables/datatables.min.js');
        echo $this->Html->script('global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js');
        echo $this->Html->script('jQuery-Pagination/jquery.twbsPagination.min.js');
        echo $this->Html->script('global/plugins/bootstrap-editable/js/bootstrap-editable.js');
        echo $this->Html->script('SweetAlert/sweetalert.min.js');
        echo $this->Html->script('global/scripts/datatable.js');
        echo $this->Html->script('global/plugins/file-input/fileinput.js');
        echo $this->Html->script('global/plugins/file-input/locales/fr.js');
    // Tiny MCE
        echo $this->Html->script('tinymce/tinymce.min.js');
        echo $this->Html->script('layout2/scripts/layout.min.js');
    // Js de l'accueil
        echo $this->Html->script('site/accueil.js');
        echo $this->Html->script('site/actu.js');
        //Place dans le layout les scripts chargés individuellement dans certaines vues
        echo $this->fetch('script');
    ?>
<?php if(isset($this->request->pass[0]) == 400){ ?>
    <script>
        toastr["error"]("Page non autorisée");
    </script>
<?php }elseif(isset($this->request->pass[0]) == 401){ ?>
    <script>
        toastr["success"]("Compte activé avec success");
    </script>
<?php }elseif(isset($this->request->pass[0]) == 402){ ?>
    <script>
        toastr["error"]("Code expiré ou incorrect");
    </script>
<?php } ?>
<script>
    params = {
        'baseurl' : '<?php echo $this->base;?>',
        'controller' : '<?php echo $this->params->controller; ?>',
        'action' : '<?php echo $this->params->action; ?>',
        'url' : '<?php echo $this->params->url; ?>'
    }
</script>
</html>
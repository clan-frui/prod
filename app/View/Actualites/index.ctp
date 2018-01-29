<?php
$this->startIfEmpty('css');
    echo $this->Html->css('Gallery/css/blueimp-gallery.min.css');
    echo $this->Html->css('cookieconsent2/cookieconsent.min.css');
$this->end();
?>
<div class="row" style="display: none;">
    <div class="col-md-12">
        <div class="portlet light bordered laptop smartphone" style="height: 1045px">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="caption-subject bold uppercase">Actualités</span>
                    <?php if(in_array($this->Session->read('Auth.User.group_id'), $supperRole)){ ?>
                        <span>
                             <?= $this->Html->link('<i class="fa fa-plus-circle"></i> Créer une miniature', array(
                                 'controller' => 'actualites',
                                 'action' => 'ajax_create_miniatures',
                                 'ajax' => true,
                             ),
                                 array(
                                     'escape' => false,
                                     'class' => 'miniatureCreate label label-primary',
                                     'style' => 'margin-left:5px;'
                                 )
                             ); ?>
                        </span>
                        <span class="alert alert-danger" style="font-size: 12px;">ACTU A CREER !!</span>
                    <?php } ?>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body" id="viewActuDetail">
                <?php
                    echo $this->requestAction(
                        array(
                            'controller' => 'actualites',
                            'action' => 'ajax_view_all_actus',
                            'ajax' => true,
                        ),
                        array(
                            'return'
                        )
                    );
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->startIfEmpty('script');
    echo $this->Html->script('jQuery-File-Upload/js/vendor/jquery.ui.widget.js');
    echo $this->Html->script('JavaScript-Templates/js/tmpl.min.js');
    echo $this->Html->script('JavaScript-Load-Image/js/load-image.all.min.js');
    echo $this->Html->script('JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js');
    echo $this->Html->script('Gallery/js/jquery.blueimp-gallery.min.js');
    echo $this->Html->script('jQuery-File-Upload/js/jquery.iframe-transport.js');
    echo $this->Html->script('jQuery-File-Upload/js/jquery.fileupload.js');
    echo $this->Html->script('jQuery-File-Upload/js/jquery.fileupload-process.js');
    echo $this->Html->script('jQuery-File-Upload/js/jquery.fileupload-image.js');
    echo $this->Html->script('jQuery-File-Upload/js/jquery.fileupload-audio.js');
    echo $this->Html->script('jQuery-File-Upload/js/jquery.fileupload-video.js');
    echo $this->Html->script('jQuery-File-Upload/js/jquery.fileupload-validate.js');
    echo $this->Html->script('jQuery-File-Upload/js/jquery.fileupload-ui.js');
    echo $this->Html->script('cookieconsent2/cookieconsent.min.js');
$this->end();
?>
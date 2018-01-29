<div class="row" style="display: none;">
    <div class="col-md-12">
        <div class="portlet light bordered" style="height: 800px">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-tachometer"></i>
                    <span class="caption-subject bold uppercase">Administration</span>
                </div>
                <div class="tools">
                    <button style="float: right;" type="button" class="btn green btn-outline addRole"><i class="fa fa-plus-square"></i>
                        Ajouter un rôle </button>
                </div>
            </div>
            <div class="portlet-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#utilisateurs">Gestions des utilisateurs</a></li>
                    <?php if(in_array($this->Session->read('Auth.User.group_id'), $supperRole)){ ?>
                    <li><a data-toggle="tab" href="#acos">Gestions des droits</a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="utilisateurs">
                        <?php
                        echo $this->requestAction(
                            array(
                                'controller' => 'administrations',
                                'action' => 'ajax_view_utilisateurs',
                                'ajax' => true,
                            ),
                            array(
                                'return'
                            )
                        );
                        ?>
                    </div>
                    <?php if(in_array($this->Session->read('Auth.User.group_id'), $supperRole)){ ?>
                    <div class="tab-pane fade" id="acos">
                        <?php
                        echo $this->requestAction(
                            array(
                                'controller' => 'administrations',
                                'action' => 'ajax_view_acos',
                                'ajax' => true,
                            ),
                            array(
                                'return'
                            )
                        );
                        ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->startIfEmpty('script');
?>
<?php
echo $this->Html->script('site/table-datatables-utilisateur.js');
echo $this->Html->script('site/table-datatables-aco.js');
echo $this->Html->script('site/administrations.js');
$this->end();
?>
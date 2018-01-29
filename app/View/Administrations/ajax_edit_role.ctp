<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Création de la miniature d'actualité : </h4>
</div>
<?php
echo $this->Form->create('AcoAro', array('class' => 'form-horizontal')
);?>
<div class="modal-body">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button> Votre formulaire contient des erreurs. S'il vous plaît vérifier ci-dessous.
    </div>
    <?php
    if(isset($group)){
        $parentController = 'Controller';
        $aco_options[1] = $parentController;
        foreach($app_children_acos as $aco){
            if($aco['Aco']['parent_id'] == 1){
                $controller = $aco['Aco']['alias'];
                $aco_options[$aco['Aco']['id']] = $parentController.' -> '.str_replace($parentController, '', $controller);
            }else{
                $aco_options[$aco['Aco']['id']] = $parentController.' -> '.str_replace($parentController, '', $controller).' -> '.$aco['Aco']['alias'];
            }
        }
    ?>
    <div style="position: absolute; float: left;left: 0;" class="form-group">
        <div class="input-group input-large">
            <label class="control-label col-md-5">Nom <span class="required"> * </span></label>
            <div class="col-md-7">
                <?=
                $this->Form->input('aro_nom', array(
                    'type' => 'text',
                    'multiple' => true,
                    'div' => false,
                    'value' => $group['Group']['role'],
                    'label' => false,
                    'class' => "form-control charge_details",
                    'style' => 'width:200px;',
                ));
                ?>
            </div>
        </div>
    </div>
    <?=
    $this->Form->input('aro_id', array(
        'type' => 'hidden',
        'value' => $group['Group']['id']
    ));
    ?>
    <div style="position: relative;margin-left: 26%;" class="form-group">
        <div class="input-group input-large">
            <label class="control-label col-md-5">Acos <span class="required"> * </span></label>
            <div class="col-md-7">
                <?=
                $this->Form->input('acos_id', array(
                    'type' => 'select',
                    'options' => $aco_options,
                    'value' => $aco_values,
                    'multiple' => true,
                    'div' => false,
                    'label' => false,
                    'class' => "form-control select2 charge_details",
                    'style' => 'width:400px;',
                ));
                ?>
            </div>
        </div>
    </div>
    <p>Nombre total d'acos : <span><?= $total_acos; ?></span></p>
    <p>Nombre d'acos sélectionné: <span id="acosSelected"><?= count($aco_values); ?></span></p>
    <?php }else{ ?>
        <div style="margin-top: 10px;" class="form-group">
            <div class="input-group input-large">
                <label class="control-label col-md-5">Nom <span class="required"> * </span></label>
                <div class="col-md-7">
                    <?=
                    $this->Form->input('aro_nom', array(
                        'type' => 'text',
                        'multiple' => true,
                        'div' => false,
                        'label' => false,
                        'class' => "form-control charge_details",
                        'style' => 'width:200px;',
                    ));
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="modal-footer">
    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button type="submit" class="btn red">Enregistrer</button>
</div>
<?php
echo $this->Form->end();?>
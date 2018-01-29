<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Connexion : </h4>
</div>
<?php
echo $this->Form->create('User', array('class' => 'form-horizontal')
);?>
<div class="modal-body">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button> Votre formulaire contient des erreurs. S'il vous plaît vérifier ci-dessous.
    </div>
    <div class="form-group">
        <div class="input-group input-large">
            <label class="control-label col-md-5">Mail <span class="required"> * </span></label>
            <div class="col-md-7">
                <?=
                $this->Form->input('mail', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => false,
                    'class' => "form-control charge_details",
                    'style' => 'width:250px;',
                ));
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-large">
            <label class="control-label col-md-5">Mot de passe <span class="required"> * </span></label>
            <div class="col-md-7">
                <?=
                $this->Form->input('password', array(
                    'type' => 'password',
                    'div' => false,
                    'label' => false,
                    'class' => "form-control charge_details",
                    'style' => 'width:250px;',
                ));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button type="submit" class="btn red">Connexion</button>
</div>
<?php
echo $this->Form->end();?>

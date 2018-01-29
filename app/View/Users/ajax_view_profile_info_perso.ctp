<?= $this->Form->create('User'); ?>
    <div class="form-group">
        <label class="control-label">Pseudo</label>
            <?=
            $this->Form->input('pseudo', array(
                'type' => 'text',
                'div' => false,
                'value' => $user['User']['pseudo'],
                'label' => false,
                'class' => "form-control",
            ));
            ?>
    </div>
    <div class="form-group">
        <label class="control-label">Mail</label>
            <?=
            $this->Form->input('mail', array(
                'type' => 'text',
                'div' => false,
                'value' => $user['User']['mail'],
                'label' => false,
                'class' => "form-control",
            ));
            ?>
    </div>
    <div class="form-group">
        <label class="control-label">Prenom</label>
            <?=
            $this->Form->input('pseudo', array(
                'type' => 'prenom',
                'div' => false,
                'value' => $user['User']['pseudo'],
                'label' => false,
                'class' => "form-control",
            ));
            ?>
    </div>
    <div class="form-group">
        <label class="control-label">Nom</label>
            <?=
            $this->Form->input('nom', array(
                'type' => 'text',
                'div' => false,
                'value' => $user['User']['nom'],
                'label' => false,
                'class' => "form-control",
            ));
            ?>
    </div>
    <!--<div class="form-group">
        <label class="control-label">Mobile Number</label>
        <input placeholder="+1 646 580 DEMO (6284)" class="form-control" type="text"> </div>-->
    <!--<div class="form-group">
        <label class="control-label">Interests</label>
        <input placeholder="Design, Web etc." class="form-control" type="text"> </div>-->
    <!--<div class="form-group">
        <label class="control-label">Occupation</label>
        <input placeholder="Web Developer" class="form-control" type="text"> </div>-->
    <!--<div class="form-group">
        <label class="control-label">About</label>
        <textarea class="form-control" rows="3" placeholder="We are KeenThemes!!!"></textarea>
    </div>-->
    <!--<div class="form-group">
        <label class="control-label">Website Url</label>
        <input placeholder="http://www.mywebsite.com" class="form-control" type="text"> </div>-->
    <div class="margiv-top-10">
        <a href="javascript:;" class="btn green"> Sauvegarder </a>
    </div>
<?= $this->Form->end();  ?>
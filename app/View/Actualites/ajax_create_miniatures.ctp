<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Création de la miniature d'actualité : </h4>
</div>
<?php
echo $this->Form->create('createMiniature', array('class' => 'form-horizontal')
);?>
<div class="modal-body">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button> Votre formulaire contient des erreurs. S'il vous plaît vérifier ci-dessous.
    </div>
    <div class="form-group" id="titreMiniatureHidden">
        <div class="input-group input-large">
            <label class="control-label col-md-5">Jeux <span class="required"> * </span></label>
            <div class="col-md-7">
                <?=
                $this->Form->input('categorieMiniature', array(
                    'type' => 'select',
                    'options' => $jeux_options,
                    'div' => false,
                    'label' => false,
                    'class' => "form-control select2 charge_details",
                    'style' => 'width:370px;',
                ));
                ?>
            </div>
        </div>
    </div>
    <div class="form-group" id="titreMiniatureHidden">
        <div class="input-group input-large">
            <label class="control-label col-md-5">Titre <span class="required"> * </span></label>
            <div class="col-md-7">
                <?=
                $this->Form->input('titreMiniature', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => false,
                    'class' => "form-control charge_details",
                    'style' => 'width:370px;',
                ));
                ?>
            </div>
        </div>
    </div>
    <div class="form-group" id="resumeMiniatureHidden">
        <div class="input-group input-large">
            <label class="control-label col-md-5">Résumé <span class="required"> * </span></label>
            <div class="col-md-7" >
                <?=
                $this->Form->input('resumeMiniature', array(
                    'type' => 'textarea',
                    'div' => false,
                    'label' => false,
                    'class' => "form-control charge_details",
                    'style' => 'width:370px;',
                ));
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row fileupload-buttonbar">
            <div class="col-lg-8">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span for="file">Ajoutez une image...</span>
                    <input id="file" type="file" name="image">
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Annuler</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Supprimer</span>
                </button>
                <input type="hidden" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<table id="uploadTable" role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
<div class="modal-footer">
    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button type="submit" class="btn red">Enregistrer</button>
</div>
<?php
echo $this->Form->end();?>
<script>window.addEventListener('load',function(){window.cookieconsent.initialise({palette:{popup:{background:'#428bca'},button:{background:'#fff'}}})})</script>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <!--<input type="checkbox" name="delete" value="1" class="toggle">-->
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

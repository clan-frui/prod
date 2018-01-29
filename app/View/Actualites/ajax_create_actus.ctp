<div class="row ActuDisplayNone" style="display: none;">
    <div class="col-md-12">
        <div class="portlet light bordered" style="min-height: 730px">
            <div class="portlet-title">
                <div class="caption font-dark">

                    <span id="tinyDisplayoff">
                        <i class="fa fa-list-alt"></i>
                        <span class="caption-subject bold uppercase">Création d'une page d'actu</span>
                    </span>

                    <span style="margin-left: 10px; cursor: pointer;" class="miniatureActu label label-primary"><i
                                class="fa fa-plus-circle"></i> Créer la page d'actu</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <div class="contenuArticle" style="display: none;">
                    <form id="formTiny" method="post">
                        <textarea margin-bottom='' id="myTextarea" data-actuId="<?= $actuId; ?>"></textarea>
                        <input name="image" type="file" id="upload" class="hidden" onchange="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="portlet light bordered" style="min-height: 730px">
        <div class="portlet-title">
            <div class="caption font-dark">
                <?= $contenu['SiteCode']['icon']; ?>
                <span class="caption-subject bold uppercase"><?= $contenu['SiteCode']['title'] .
                    ' : ' . $contenu['SiteActualiteArticle']['title_supp'];
                    ?>
                </span>
            </div>
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
            <div class="contenuArticle">
                <?= $contenu['SiteActualiteContenuArticle']['content']; ?>
            </div>
        </div>
    </div>
</div>

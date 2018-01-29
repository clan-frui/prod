<div class="refreshActu">
    <?php foreach($actuGrids as $actuGrid): ?>
        <div class="col-md-3 allActus">
            <?php $date = date_create($actuGrid['SiteActualiteArticle']['modified']);?>
            <?php
            if($actuGrid['SiteActualiteContenuArticle']['id'] == null){
                $url = $this->Html->url(array(
                    'controller' => 'actualites',
                    'action' => 'ajax_create_actus',
                    'ajax' => true,
                    $actuGrid['SiteActualiteArticle']['id']
                ));
            }else{
                $url = $this->Html->url(array(
                    'controller' => 'actualites',
                    'action' => 'ajax_view_actus',
                    'ajax' => true,
                    $actuGrid['SiteActualiteArticle']['id']
                ));
            }
            ?>
            <a class="underlineOff" href="<?= $url; ?>">
                <?= $this->Html->image(
                    'site/' . $actuGrid['SiteImageActu']['image'],
                    array(
                        'alt' => $actuGrid['SiteCode']['code_title'],
                        'class' => 'img-responsive'
                    )
                );
                ?>
                <?php
                $suppTitle = !empty($actuGrid['SiteActualiteArticle']['title_supp']) ? ' - <span style="font-size: 23px;">' .
                    $actuGrid['SiteActualiteArticle']['title_supp'] . '</span>' : '';
                ?>
                <h3 style="margin-left:-15px;color:rgb(190, 190, 219);"><?= $actuGrid['SiteCode']['title'] . $suppTitle ?></h3>
                <span style="margin-left:-15px;color:rgb(97, 103, 112);">Le <?= date_format
                    ($date, 'd/m/Y H:i:s'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comment-o"></i> &nbsp;
                    <?= count($actuGrid['SiteActualiteArticleUtilisateur']); ?></span>
                <p style="color: #000000;margin-top:10px;margin-left:-15px;"><?=
                    $actuGrid['SiteActualiteArticle']['resume']; ?></p>
            </a>
        </div>
    <?php endforeach; ?>
</div>
<div class="div-pagination">
    <ul data-nbPage="<?= $nbPage; ?>"id="pagination-actu" class="pagination"></ul>
</div>

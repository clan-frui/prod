<div class="row" style="display: none;">
    <div class="col-md-12">
        <div class="portlet light bordered" style="height: 800px">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-home"></i>
                    <span class="caption-subject bold uppercase">Accueil</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <div class="col-md-8">
                    <div class="embed-container">
                        <iframe src="https://player.twitch.tv/?channel=clanfrui" frameborder="0" allowfullscreen="true" scrolling="no" height="440" width="740"></iframe><a href="https://www.twitch.tv/clanfrui?tt_medium=live_embed&tt_content=text_link" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px; text-decoration:underline;">Regarder une vidéo en direct de ClanFrui sur www.twitch.tv</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <!-- AJOUTER UNE CONDITION DE ADMIN -->
                        <div class="panel-heading">
                            <h3 style="font-size: 25px;" class="panel-title"><span class="label label-default">Dernière Actualités</span></h3>
                        </div>
                        <!------------------------------------>
                        <div class="panel-body">
                            <?php
                            foreach ($liens as $lien) {
                                $date = date("d/m/y H:i", strtotime($lien['SiteActualiteArticle']['created']));
                                echo $this->Html->link(
                                    '<b><span style="color: white;border: 1px solid;background-color: ' . $lien['SiteCode']['color'] . ';">' .
                                    $date . '</span><span style="color: ' . $lien['SiteCode']['color'] . ';"> ' . $lien['SiteCode']['code_title']. '</span></b> - ' .
                                    $lien['SiteActualiteArticle']['title_supp']. '<br />',
                                    array(
                                        'controller' => 'actualites',
                                        'action' => 'ajax_view_actu',
                                        'ajax' => true,
                                    ),
                                    array(
                                        'escape' => false
                                    )
                                );
                            }
                            ?>
                            <br /><?= $this->Html->link('<i class="fa fa-arrow-circle-right"></i> Voir toute l\'actu', array(
                                    'controller' => 'actualites',
                                    'action' => 'index'
                                ),
                                array(
                                    'escape' => false,
                                    'class' => 'allActu label label-primary'
                                )
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
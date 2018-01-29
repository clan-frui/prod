<?php
/**
 * Created by PhpStorm.
 * User: JonathanCierp
 * Date: 01/11/2017
 * Time: 02:26
 */
App::uses('AppController', 'Controller');

class ActualitesController extends AppController {

    public $components = array('Paginator');


    public function beforeFilter(){
        parent::beforeFilter();

    }

    /**
     * Accueil de la Page Actualite
     */
    public function index(){

    }

    /**
     * Création d'une actualité avec Tiny MCE
     * @param $id
     */
    public function ajax_create_actus($id = 0){
        $actuId = $id;

        $this->set('actuId', $actuId);
    }

    /**
     * Sauvegarde de l'actualité fait avec Tiny MCE
     * return @ajax
     */
    public function ajax_save_actus(){
        $this->layout = 'ajax';
        $htmlPageActu = isset($this->request->data['html']) ? $this->request->data['html'] : '';
        $actuId = isset($this->request->data['actuId']) ? $this->request->data['actuId'] : '';
        $action = isset($this->request->data['action']) ? $this->request->data['action'] : '';
        $datas = array('content' => $htmlPageActu);
        $this->SiteActualiteContenuArticle->create();
        if($this->SiteActualiteContenuArticle->save($datas)){
            $contentId = $this->SiteActualiteContenuArticle->id;
            if($this->SiteActualiteArticle->save(
                array(
                    'id' => $actuId,
                    'site_actualite_contenu_article_id' => $contentId,
                    //'action' => $action
                )
            )){
                $this->set('ajax', array('status' => 'success', 'message' => 'Enregistré avec succès.'));
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de l\'enregistrement'));
            }
        } else{
            $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de l\'enregistrement'));
        }
        $this->render('/Elements/ajax_value', 'ajax');
    }

    /**
     * Sauvegarde du titre et résumé de la miniature de l'actualité
     * return @ajax
     */
    public function ajax_save_miniatures(){
        $this->layout = 'ajax';
        if($this->request->data){
            $code_id = $this->request->data['createMiniature']['categorieMiniature'];
            $titre = $this->request->data['createMiniature']['titreMiniature'];
            $resume = $this->request->data['createMiniature']['resumeMiniature'];
        }
        $image_actu_id = $this->SiteImageActu->find('first',
            array(
                'fields' => array('SiteImageActu.id'),
                'order' => array('SiteImageActu.id DESC')
            )
        );
        $datas = array(
            'site_image_actu_id' => $image_actu_id['SiteImageActu']['id'],
            'site_code_id' => $code_id,
            'title_supp' => $titre,
            'resume' => $resume
        );
        $this->SiteActualiteArticle->create();
        if($this->SiteActualiteArticle->save($datas)){
            $lastInsertId = $this->SiteActualiteArticle->id;
            $this->set('ajax', array('status' => 'success', 'message' => 'Miniature enregistré avec succès.', 'id' =>
                $lastInsertId));
        }else{
            $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de l\'enregistrement'));
        }


        $this->render('/Elements/ajax_value', 'ajax');
    }

    /**
     * Vue de l'actualité selectionnée
     * @param $id
     */
    public function ajax_view_actus($id = 0){
        $actuId = $id;
        $contenu = $this->SiteActualiteArticle->find('first',
            array(
                'fields' => array(
                    'SiteActualiteArticle.action',
                    'SiteActualiteContenuArticle.content',
                    'SiteActualiteContenuArticle.id',
                    'SiteActualiteArticle.title_supp',
                    'SiteCode.title',
                    'SiteCode.icon'
                ),
                'conditions' => array(
                    'SiteActualiteArticle.id' => $actuId
                ),
            )
        );

        $this->set('contenu', $contenu);
    }

    /**
     * Vue de toutes les actualités
     */
    public function ajax_view_all_actus(){
        $this->layout = 'ajax';
        // Nb total d'actualite
        if(in_array($this->Session->read('Auth.User.group_id'), $this->supperRole)){
            $nbActu = $this->SiteActualiteArticle->find('count',
                array(
                    'fields' => array('SiteActualiteArticle.id')
                )
            );
        }else{
            $nbActu = $this->SiteActualiteArticle->find('count',
                array(
                    'fields' => array('SiteActualiteArticle.id'),
                    'conditions' => array('SiteActualiteArticle.site_actualite_contenu_article_id')
                )
            );
        }

        $parPage = isset($this->request->data['nbParPage']) ? $this->request->data['nbParPage'] : 8;
        $nbPage = ceil($nbActu/$parPage);
        $cPage = isset($this->request->data['currentPage']) ? $this->request->data['currentPage'] : 1;
        // Limit
        $limit[0] = $parPage;
        for($i = 0; $i < $nbPage; $i++){
            $page = $parPage * ($i + 1);
            if($nbActu > $page){
                $limit[] = $parPage;
            }else{
                $limit[] = $nbActu - ($page - $parPage);
            }
        }
        // Actualites
        if(in_array($this->Session->read('Auth.User.group_id'), $this->supperRole)){
            $actuGrids = $this->SiteActualiteArticle->find('all',
                array(
                    'limit' => $limit[$cPage - 1],
                    'page' => $cPage,
                    'order' => array('SiteActualiteArticle.created DESC')
                )
            );
        }else{
            $actuGrids = $this->SiteActualiteArticle->find('all',
                array(
                    'limit' => $limit[$cPage - 1],
                    'page' => $cPage,
                    'order' => array('SiteActualiteArticle.created DESC'),
                    'conditions' => array('SiteActualiteArticle.site_actualite_contenu_article_id')
                )
            );
        }

        $this->set('actuGrids', $actuGrids);
        $this->set('nbPage', $nbPage);
    }

    /**
     * Fonction du modal qui utilise la vue AJAX
     */
    public function ajax_create_miniatures() {
        $this->layout = 'ajax';

        $jeux_options = $this->SiteCode->find('list',
            array(
                'fields' => array('SiteCode.id', 'SiteCode.title'),
            )
        );

        $this->set('jeux_options', $jeux_options);
    }

}
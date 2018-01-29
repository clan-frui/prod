<?php
/**
 * Created by PhpStorm.
 * User: JonathanCierp
 * Date: 13/12/2017
 * Time: 19:24
 */

App::uses('AppController', 'Controller');

class ImportsController extends AppController {

    public function beforeFilter(){
        parent::beforeFilter();

    }

    /**
     * Upload de l'image de la miniature + l'enregistre en base + le deplace dans
     * http://$HOST$vegeta/img/site/miniature/
     * return @ajax
     */
    public function upload(){
        $id = $this->SiteImageActu->find('first',
            array(
                'fields' => array('id'),
                'order' => array('id DESC')
            )
        );
        if($id){
            $lastId = $id['SiteImageActu']['id'];
        }else{
            $lastId = '';
        }
        if(isset($this->request->params['form']['file'])){
            $file = $this->request->params['form']['file'];
            if($file['error'] === 0 && isset($file['name']) && !empty($file['name'])){
                list($name, $extension) = explode('.', $file['name'], 2);
                $name = $name;
                $extension = $extension;
                $newName = $name  . '-' . $lastId . '.' . $extension;
                $trans = array("é" => "e", "è" => "e", "ô" => "o");
                $newName = strtr($newName, $trans);
                $path = AppController::IMPORT_DIR().$newName;
                if (@move_uploaded_file($file['tmp_name'], $path)) {
                    $imageImport = array(
                        'image' => 'miniature/' . $newName
                    );
                    $this->SiteImageActu->create();
                    if ($this->SiteImageActu->save($imageImport)) {
                        $this->set('ajax', array('status' => 'success', 'message' => 'Import effectué avec succès.'));
                    } else {
                        $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de l\'enregistrement.'));
                    }
                }else{
                    $this->set('ajax', array('status' => 'error', 'message' => 'Erreur : enregistrement du fichier impossible.'));
                }
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Erreur : fichier vide ou corrompu.'));
            }
        }else{
            $this->set('ajax', array('status' => 'error', 'message' => 'Erreur : fichier introuvable'));
        }
        $this->render('/Elements/ajax_value', 'ajax');
    }
}
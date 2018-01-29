<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 * @property SiteActualiteLink SiteActualiteLink
 * @property SiteTitle SiteTitle
 * @property SiteActualiteArticle SiteActualiteArticle
 * @property SiteActualiteArticleActu SiteActualiteArticleActu
 * @property SiteImageUtilisateur SiteImageUtilisateur
 * @property SiteCode SiteCode
 * @property SiteCommentaire SiteCommentaire
 * @property SiteImageActu SiteImageActu
 * @property SiteActualiteContenuArticle SiteActualiteContenuArticle
 * @property User User
 * @property Group Group
 */
class AppController extends Controller {

    public $uses = array(
        'SiteActualiteLink', 'SiteTitle', 'SiteActualiteArticle', 'SiteActualiteArticleActu',
        'SiteCode', 'SiteCommentaire', 'SiteImageActu', 'SiteImageUtilisateur', 'SiteActualiteContenuArticle', 'User',
        'Group'

    );

    var $components = array('Flash', 'Auth', 'Acl', 'Session');

    protected $supperRole = array(1, 2, 3);

    protected $FRUI = array(4);

    protected $connected = false;

    /**
     * là ou les fichiers d'import sont stoqués
     */
    protected static function IMPORT_DIR(){
        return APP.'webroot/img/site/miniature/';
    }

    public function beforeFilter(){
        parent::beforeFilter();
        $baseUrl = $this->request->host();

        $this->Auth->authorize = array(
            'Controller',
            'Actions' => array('actionPath' => 'controllers')
        );
        $this->Auth->logoutRedirect = array(
            'controller' => 'accueils',
            'action' => 'index',
            'admin' => false,
            'plugin' => false
        );
        $this->Auth->authError = 'Vous nêtes pas autorisé';
        $this->Auth->authenticate = array(
            'Form' => array(
                'fields' => array(
                    'username' => 'mail',
                    'password' => 'password'
                )
            )
        );
        if($this->Session->read('Auth.User.group_id') == 1){

        }else if($this->Session->read('Auth.User.group_id')){
            $group = $this->User->Group;
            $group->id = $this->Session->read('Auth.User.group_id');
            if($this->Acl->check($group, 'controllers/'.ucfirst($this->params->controller))){

            }else{
                if($this->Acl->check($group, 'controllers/'.ucfirst($this->params->controller).'/'.$this->params->action)){

                }else{
                    throw new UnauthorizedException('Accès non autorisé');
                }
            }
            $this->connected = true;
        }else{
            $this->connected = false;
        }


        $this->set('baseUrl', $baseUrl);
        $this->set('supperRole', $this->supperRole);
    }

    function isAuthorized($user) {
        // return false;
        return $this->Auth->loggedIn();
    }


}

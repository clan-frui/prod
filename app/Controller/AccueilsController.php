<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

class AccueilsController extends AppController {

    public function beforeFilter(){
        parent::beforeFilter();
        if(!$this->connected){
            $this->Auth->allow();
        }
    }

    /**
     * Page d'accueil
     * return $lien
     */
    public function index(){
        $liens = $this->SiteActualiteArticle->find('all', array(
            'limit' => 8
        ));

        $this->set(compact('liens'));

	}



}

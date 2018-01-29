<?php

/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 23/12/2017
 * Time: 18:03
 */
class UsersController extends AppController {

    /**
     *
     */
    public function beforeFilter(){
        parent::beforeFilter();

        $this->Auth->allow();
    }

    /**
     *
     */
    public function ajax_user_login(){
        if($this->request->data){
            $user = $this->User->find('first',
                array(
                    'conditions' => array(
                        'mail' => $this->request->data['User']['mail'],
                        'password' => $this->Auth->password($this->request->data['User']['password']),
                        'statut' => 1
                    )
                )
            );
            if($user){
                if($this->Auth->login()){
                    date_default_timezone_set('Europe/Paris');
                    $this->User->save(array(
                        'id' => $this->Session->read('Auth.User.id'),
                        'last_login' => date('Y-m-d H:i:s')
                    ));
                    $this->set('ajax', array('status' => 'success', 'message' => 'Connecté avec succès.'));
                }else{
                    $this->set('ajax', array('status' => 'error', 'message' => 'Mot de passe ou nom d\'utilisateur incorrect.'));
                }
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Le compte n\'existe pas ou n\'est pas activé.'));
            }

        }

        $this->render('/Elements/ajax_value', 'ajax');
    }

    /**
     *
     */
    public function login(){
        $this->layout = 'ajax';
    }

    /**
     * @return CakeResponse|null|void
     */
    public function logout(){
        $this->Auth->logout();
        return $this->redirect('/');
    }

    /**
     *
     */
    public function ajax_user_subscribe(){
        $this->layout = 'ajax';
    }

    /**
     *
     */
    public function ajax_save_user(){
        $pseudo = isset($this->request->data['User']['pseudo']) ? $this->request->data['User']['pseudo'] : '';
        $password = isset($this->request->data['User']['password']) ? $this->request->data['User']['password'] : '';
        $mail = isset($this->request->data['User']['mail']) ? $this->request->data['User']['mail'] : '';
        $active_code = hash('sha1', $mail . $pseudo . time() . 5 . 0);
        $datas = array(
            'mail' => $mail,
            'pseudo' => $pseudo,
            'password' => $this->Auth->password($password),
            'group_id' => 5,
            'statut' => 0,
            'active_code' => $active_code
        );
        $mail_user = $this->User->find('first',
            array(
                'conditions' => array(
                    'mail' => $mail,
                )
            )
        );
        $pseudo_user = $this->User->find('first',
            array(
                'conditions' => array(
                    'pseudo' => $pseudo,
                )
            )
        );
        if($pseudo_user){
            $this->set('ajax', array('status' => 'error', 'message' => 'Ce pseudo existe déjà.'));
        }elseif($mail_user){
            $this->set('ajax', array('status' => 'error', 'message' => 'Ce mail existe déjà.'));
        }else{
            if($this->User->save($datas)){
                if($this->_send_mail_activate_account($mail, $pseudo, $active_code)){
                    $this->set('ajax', array('status' => 'warning', 'message' => 'Compte crée, Veuillez activer votre compte en répondant au mail envoyé.'));
                }else{
                    $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de l\'envoi du mail, veuillez recommencer
                    .'));
                }
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de la création.'));
            }
        }


        $this->render('/Elements/ajax_value', 'ajax');
    }

    /**
     * @param $to
     * @param $pseudo
     * @param $active_code
     *
     * @return bool
     */
    private function _send_mail_activate_account($to, $pseudo, $active_code){
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail('default');
        $Email->from(array('azerty24041997@gmail.com' => 'Confirmation inscription'));
        $Email->to($to);
        $Email->template('confirmation_inscription', null);
        $Email->viewVars(
            array(
                'pseudo' => $pseudo,
                'active_code' => $active_code
            )
        );
        $Email->subject('Test pour la confirmation d\'inscription');
        if($Email->send()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $code
     */
    public function ajax_active_user($code){
        if($code){
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'active_code' => $code
                )
            ));
            if($user && $user['User']['statut'] == 0){
                if($this->User->save(array('id' => $user['User']['id'], 'statut' => 1))){
                    $this->set('ajax', array('status' => 'success', 'message' => 'Compte activé.'));
                }else{
                    $this->set('ajax', array('status' => 'error', 'message' => 'Code expiré ou incorrect.'));
                }
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Compte déjà activé.'));
            }
        }else{
            $this->set('ajax', array('status' => 'error', 'message' => 'Code expiré ou incorrect.'));
        }
    }

    public function ajax_view_profile($id = null){
        if($id){
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $id
                )
            ));
            $this->set('user', $user);
        }else{
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->Session->read('Auth.User.id')
                )
            ));
            $this->set('user', $user);
        }
    }

    public function ajax_view_profile_info_perso(){
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $this->Session->read('Auth.User.id')
            )
        ));
        $this->set('user', $user);
    }

}
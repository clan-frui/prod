<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 03/01/2018
 * Time: 12:04
 */
class AdministrationsController extends AppController {

    public function beforeFilter(){
        parent::beforeFilter();
    }

    /**
     * Index de la page admin
     */
    public function index(){

    }

    /**
     * Tableau
     */
    public function ajax_view_utilisateurs(){
        $this->layout = 'ajax';
        $utilisateurs = $this->User->find('all');

        $this->set('utilisateurs', $utilisateurs);
    }

    public function ajax_update_utilisateurs($id = null){
        $userFieldName = isset($this->request->data['pk']['name']) ? $this->request->data['pk']['name'] : '';
        $userFieldValue = isset($this->request->data['value']) ? $this->request->data['value'] : '';
        $userId = isset($this->request->data['pk']['userId']) ? $this->request->data['pk']['userId'] : '';
        $statut = isset($this->request->data['statut']) ? $this->request->data['statut'] : '';

        if($userFieldName == 'nom'){
            $userFieldValue = strtoupper($userFieldValue);
        }

        if($id == ''){
            $datas = array(
                'id' => $userId,
                $userFieldName => $userFieldValue
            );
            if($this->User->save($datas)){
                $this->set('ajax', array('status' => 'success', 'message' => 'Utilisateur modifié avec succès.'));
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de la modification de 
            l\'utilisateur'));
            }
        }else{
            if($statut == 0){
                $datas = array(
                    'id' => $id,
                    'statut' => 1
                );
                if($this->User->save($datas)){
                    $this->set('ajax', array('status' => 'success', 'message' => 'Utilisateur activé avec succès.',
                        'icon' => '<i style="color: green;" class="fa fa-check-square-o"></i>', 'statut' => 1,
                        'iconAction' => '<i class="fa fa-lock"></i> Désactiver'));
                }else{
                    $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de l\'enregistrement.'));
                }
            }else{
                $datas = array(
                    'id' => $id,
                    'statut' => 0
                );
                if($this->User->save($datas)){
                    $this->set('ajax', array('status' => 'success', 'message' => 'Utilisateur désactivé avec succès
                    .', 'icon' => '<i style="color: red;" class="fa fa-window-close-o"</i>', 'statut' => 0,
                        'iconAction' => '<i class="fa fa-unlock"></i> Activé'));
                }else{
                    $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de l\'enregistrement.'));
                }
            }
        }
        $this->render('/Elements/ajax_value', 'ajax');
    }

    public function ajax_delete_utilisateurs($id = null){
        if($id){
            $user = $this->User->find('first', array(
               'conditions' => array(
                   'User.id' => $id
               )
            ));
            $aro = $this->Acl->Aro->find('first', array(
                'conditions' => array(
                    'Aro.alias' => $user['User']['pseudo']
                )
            ));
            if($this->User->delete($id)){
                if($this->Acl->Aro->delete($aro['Aro']['id'])){
                    $this->set('ajax', array('status' => 'success', 'message' => 'Utilisateur supprimé avec succès.'));
                }else{
                    $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de la suppression.'));
                }
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de la suppression.'));
            }
        }else{
            $this->set('ajax', array('status' => 'error', 'message' => 'L\'utilisateur n\'existe pas.'));
        }
        $this->render('/Elements/ajax_value', 'ajax');
    }

    public function ajax_view_acos(){
        $this->layout = 'ajax';

        $groups = $this->Group->find('all', array(
            'recursive' => -1
        ));

        $this->set('groups', $groups);
    }

    public function ajax_edit_role($id = null){
        $this->layout = 'ajax';


        if($id){
            $group = $this->Group->find('first', array(
                'conditions' => array(
                    'Group.id' => $id
                )
            ));
            $acos = $this->Acl->Aro->find('first', array(
                'conditions' => array(
                    'Aro.foreign_key' => $id
                )
            ));
            $aco_values = array();
            foreach($acos['Aco'] as $aco){
                if($aco['parent_id'] == 1){
                    $aco_values[] = $aco['id'];
                }else{
                    $aco_values[] = $aco['id'];
                }
            }
            $this->set('group', $group);
            $this->set('aco_values', $aco_values);
        }

        $this->_aco();

    }

    public function ajax_save_role($id = null){

        if($id){
            if($this->request->data){
                $aroNom = $this->request->data['AcoAro']['aro_nom'];
                $acoIds = $this->request->data['AcoAro']['acos_id'];

                $acos = $this->Acl->Aco->find('all', array(
                    'conditions' => array(
                        'Aco.id' => $acoIds,
                        'Aco.parent_id !=' => ''
                    )
                ));

                $group = $this->User->Group;
                $group->id = $id;

                $parentController = 'controllers';
                $this->Acl->Aro->Permission->deleteAll(array('aro_id = ' . $id));
                if(count($acoIds) == 1 && $acoIds[0] == 1){
                    $this->Acl->allow($group, 'controllers');
                }else{
                    if($acoIds[0] == 1){
                        $this->Acl->allow($group, 'controllers');
                    }
                    foreach($acos as $aco){
                        if($aco['Aco']['parent_id'] == 1){
                            $controller = $aco['Aco']['alias'];
                            $droit = $parentController.'/'.str_replace($parentController, '', $controller);
                            if($this->Acl->allow($group, $droit)){
                                $bool[] = true;
                            }else{
                                $bool[] = false;
                            }
                        }else{
                            $droit = $parentController.'/'.str_replace($parentController, '', $controller).'/'.$aco['Aco']['alias'];
                            if($this->Acl->allow($group, $droit) && $this->Acl->deny($group, $parentController.'/'.str_replace($parentController, '', $controller))){
                                $bool[] = true;
                            }else{
                                $bool[] = false;
                            }
                        }
                    }
                }
                if(!in_array(false, $bool)){
                    if($this->Group->save(array('id' => $id, 'role' => $aroNom))){
                        $this->set('ajax', array('status' => 'success', 'message' => 'Succes'));
                    }else{
                        $this->set('ajax', array('status' => 'error', 'message' => 'Erreur'));
                    }
                }else{
                    $this->set('ajax', array('status' => 'error', 'message' => 'Erreur'));
                }
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Erreur données non envoyées'));
            }
        }else{
            $aroNom = $this->request->data['AcoAro']['aro_nom'];
            $this->Group->create();
            if($this->Group->save(array('role' => strtoupper($aroNom), 'color' => 'label label-default'))){
                $this->set('ajax', array('status' => 'success', 'message' => 'Rôle ajouté avec succès'));

            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de l\'enregistrement'));
            }
        }

        $this->render('/Elements/ajax_value', 'ajax');

    }

    private function _aco(){

        $app_aco = $this->Acl->Aco->find('first', array(
            'conditions' => array(
                'Aco.alias' => 'controllers'
            ),
            'recursive' => -1,
            'order' =>
            'Aco.alias'
        ));
        //On récupère les ACOs enfants
        $app_children_acos = $this->Acl->Aco->children($app_aco['Aco']['id']);
        //On compte le nombre total des ACOS +1 pour la racine
        $total_acos = count($app_children_acos)+1;

        $this->set('app_aco', $app_aco);
        $this->set('app_children_acos', $app_children_acos);
        $this->set('total_acos', $total_acos);
    }

    public function ajax_delete_role($id = null){
        if($id){
            if($this->Group->delete($id)){
                $this->set('ajax', array('status' => 'success', 'message' => 'Rôle supprimé avec succès.'));
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors de la suppression.'));
            }
        }else{
            $this->set('ajax', array('status' => 'error', 'message' => 'Le rôle n\'existe pas.'));
        }
        $this->render('/Elements/ajax_value', 'ajax');
    }

    public function ajax_edit_role_utilisateur($id = null){
        $this->layout = 'ajax';
        $group_options = $this->Group->find('list', array(
            'fields' => array(
                'Group.id',
                'Group.role'
            )
        ));
        if($id){
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $id
                )
            ));
            $group_value = $this->Group->find('first', array(
                'conditions' => array(
                    'id' => $user['User']['group_id']
                )
            ));
            $this->set('group_value', $group_value);
        }
        $this->set('group_options', $group_options);
    }

    public function ajax_save_role_utilisateur($id = null){
        $groupId = isset($this->request->data['User']['group_id']) ? $this->request->data['User']['group_id'] : '';
        if($id){
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $id
                )
            ));
            $aro = $this->Acl->Aro->find('first', array(
                'conditions' => array(
                    'OR' => array(
                        'foreign_key' => $id,
                        'alias' => $user['User']['pseudo']
                    ),
                    'model' => 'User'
                )
            ));
            $datas = array(
                'id' => $user['User']['id'],
                'group_id' => $groupId
            );
            if($this->User->save($datas)){
                if($this->Acl->Aro->save(array('id' => $aro['Aro']['id'], 'parent_id' => $groupId)))
                    $this->set('ajax', array('status' => 'success', 'message' => 'Rôle édité avec succès.'));
            }else{
                $this->set('ajax', array('status' => 'error', 'message' => 'Erreur lors du changement.'));
            }
        }else{
            $this->set('ajax', array('status' => 'error', 'message' => 'L\'utilisateur n\'existe pas.'));
        }
        $this->render('/Elements/ajax_value', 'ajax');
    }

}
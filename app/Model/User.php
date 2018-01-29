<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property SiteImageUtilisateur $SiteImageUtilisateur
 * @property Group Group
 * @property SiteActualiteArticleUtilisateur $SiteActualiteArticleUtilisateur
 * @property SiteActualiteArticle $SiteActualiteArticle
 * @property SiteForumCommentaire $SiteForumCommentaire
 * @property SiteForumPost $SiteForumPost
 */
class User extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed
    public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SiteImageUtilisateur' => array(
			'className' => 'SiteImageUtilisateur',
			'foreignKey' => 'site_image_utilisateur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'SiteActualiteArticleUtilisateur' => array(
			'className' => 'SiteActualiteArticleUtilisateur',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SiteActualiteArticle' => array(
			'className' => 'SiteActualiteArticle',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SiteForumCommentaire' => array(
			'className' => 'SiteForumCommentaire',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SiteForumPost' => array(
			'className' => 'SiteForumPost',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        }
        return array('Group' => array('id' => $groupId));
    }

    public function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }

    public function afterSave($created, $options = array()){
        if(isset($this->data[$this->alias]['pseudo']) && isset($this->data[$this->alias]['group_id'])){
            $this->Aro->save(
                array(
                    'alias'=> $this->data[$this->alias]['pseudo'],
                    'parent_id' => $this->data[$this->alias]['group_id'],
                    'model'=> 'User',
                )
            );
        }

    }

}

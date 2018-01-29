<?php
App::uses('AppModel', 'Model');
/**
 * SiteForumPost Model
 *
 * @property User $User
 * @property SiteForumSujet $SiteForumSujet
 * @property SiteForumCommentaire $SiteForumCommentaire
 */
class SiteForumPost extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SiteForumSujet' => array(
			'className' => 'SiteForumSujet',
			'foreignKey' => 'site_forum_sujet_id',
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
		'SiteForumCommentaire' => array(
			'className' => 'SiteForumCommentaire',
			'foreignKey' => 'site_forum_post_id',
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

}

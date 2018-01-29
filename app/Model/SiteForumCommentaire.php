<?php
App::uses('AppModel', 'Model');
/**
 * SiteForumCommentaire Model
 *
 * @property SiteForumPost $SiteForumPost
 * @property User $User
 */
class SiteForumCommentaire extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SiteForumPost' => array(
			'className' => 'SiteForumPost',
			'foreignKey' => 'site_forum_post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

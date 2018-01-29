<?php
App::uses('AppModel', 'Model');
/**
 * SiteForumSujet Model
 *
 * @property SiteForumPost $SiteForumPost
 */
class SiteForumSujet extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'SiteForumPost' => array(
			'className' => 'SiteForumPost',
			'foreignKey' => 'site_forum_sujet_id',
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

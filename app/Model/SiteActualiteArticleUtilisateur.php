<?php
App::uses('AppModel', 'Model');
/**
 * SiteActualiteArticleUtilisateur Model
 *
 * @property SiteActualiteArticle $SiteActualiteArticle
 * @property User $User
 */
class SiteActualiteArticleUtilisateur extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SiteActualiteArticle' => array(
			'className' => 'SiteActualiteArticle',
			'foreignKey' => 'site_actualite_article_id',
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

<?php
App::uses('AppModel', 'Model');
/**
 * SiteActualiteContenuArticle Model
 *
 * @property SiteActualiteArticle $SiteActualiteArticle
 */
class SiteActualiteContenuArticle extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'SiteActualiteArticle' => array(
			'className' => 'SiteActualiteArticle',
			'foreignKey' => 'site_actualite_contenu_article_id',
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

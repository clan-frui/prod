<?php
App::uses('AppModel', 'Model');
/**
 * SiteCode Model
 *
 * @property SiteActualiteArticle $SiteActualiteArticle
 */
class SiteCode extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'SiteActualiteArticle' => array(
			'className' => 'SiteActualiteArticle',
			'foreignKey' => 'site_code_id',
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

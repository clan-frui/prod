<?php
App::uses('AppModel', 'Model');
/**
 * SiteActualiteArticle Model
 *
 * @property User $User
 * @property SiteActualiteContenuArticle $SiteActualiteContenuArticle
 * @property SiteImageActu $SiteImageActu
 * @property SiteCode $SiteCode
 * @property SiteActualiteArticleUtilisateur $SiteActualiteArticleUtilisateur
 */
class SiteActualiteArticle extends AppModel {


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
		'SiteActualiteContenuArticle' => array(
			'className' => 'SiteActualiteContenuArticle',
			'foreignKey' => 'site_actualite_contenu_article_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SiteImageActu' => array(
			'className' => 'SiteImageActu',
			'foreignKey' => 'site_image_actu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SiteCode' => array(
			'className' => 'SiteCode',
			'foreignKey' => 'site_code_id',
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
			'foreignKey' => 'site_actualite_article_id',
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

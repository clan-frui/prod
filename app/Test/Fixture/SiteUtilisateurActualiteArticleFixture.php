<?php
/**
 * SiteUtilisateurActualiteArticle Fixture
 */
class SiteUtilisateurActualiteArticleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'site_utilisateur_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'site_actualite_article_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'site_utilisateur_id' => 1,
			'site_actualite_article_id' => 1
		),
	);

}

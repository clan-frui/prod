<?php
/**
 * SiteActualiteArticle Fixture
 */
class SiteActualiteArticleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'site_image_actu_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'site_code_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'site_actualite_contenu_article_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'site_actualite_link_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'resume' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'content' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'site_image_actu_id' => array('column' => 'site_image_actu_id', 'unique' => 0),
			'site_code_id' => array('column' => 'site_code_id', 'unique' => 0),
			'site_actualite_contenu_article_id' => array('column' => 'site_actualite_contenu_article_id', 'unique' => 0),
			'site_actualite_link_id' => array('column' => 'site_actualite_link_id', 'unique' => 0)
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
			'site_image_actu_id' => 1,
			'site_code_id' => 1,
			'site_actualite_contenu_article_id' => 1,
			'site_actualite_link_id' => 1,
			'resume' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet',
			'modified' => '2017-12-02 16:56:23',
			'created' => '2017-12-02 16:56:23'
		),
	);

}

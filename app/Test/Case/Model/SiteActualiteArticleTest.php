<?php
App::uses('SiteActualiteArticle', 'Model');

/**
 * SiteActualiteArticle Test Case
 */
class SiteActualiteArticleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_actualite_article',
		'app.site_utilisateur',
		'app.site_commentaire',
		'app.site_image_utilisateur',
		'app.site_image_actu',
		'app.site_code',
		'app.site_actualite_contenu_article',
		'app.site_actualite_link'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteActualiteArticle = ClassRegistry::init('SiteActualiteArticle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteActualiteArticle);

		parent::tearDown();
	}

}

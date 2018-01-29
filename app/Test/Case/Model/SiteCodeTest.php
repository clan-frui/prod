<?php
App::uses('SiteCode', 'Model');

/**
 * SiteCode Test Case
 */
class SiteCodeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_code',
		'app.site_actualite_article',
		'app.site_image_actu',
		'app.site_actualite_contenu_article',
		'app.site_actualite_link',
		'app.site_actualite_article_utilisateur',
		'app.site_utilisateur',
		'app.site_commentaire',
		'app.site_image_utilisateur'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteCode = ClassRegistry::init('SiteCode');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteCode);

		parent::tearDown();
	}

}

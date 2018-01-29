<?php
App::uses('SiteActualiteLink', 'Model');

/**
 * SiteActualiteLink Test Case
 */
class SiteActualiteLinkTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_actualite_link',
		'app.site_actualite_article',
		'app.site_image_actu',
		'app.site_code',
		'app.site_actualite_contenu_article',
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
		$this->SiteActualiteLink = ClassRegistry::init('SiteActualiteLink');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteActualiteLink);

		parent::tearDown();
	}

}

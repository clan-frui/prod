<?php
App::uses('SiteImageUtilisateur', 'Model');

/**
 * SiteImageUtilisateur Test Case
 */
class SiteImageUtilisateurTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_image_utilisateur',
		'app.site_utilisateur',
		'app.site_actualite_article',
		'app.site_image_actu',
		'app.site_code',
		'app.site_actualite_contenu_article',
		'app.site_actualite_link',
		'app.site_actualite_article_utilisateur',
		'app.site_commentaire'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteImageUtilisateur = ClassRegistry::init('SiteImageUtilisateur');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteImageUtilisateur);

		parent::tearDown();
	}

}

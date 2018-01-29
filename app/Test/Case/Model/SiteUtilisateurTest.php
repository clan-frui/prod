<?php
App::uses('SiteUtilisateur', 'Model');

/**
 * SiteUtilisateur Test Case
 */
class SiteUtilisateurTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_utilisateur',
		'app.site_actualite_article',
		'app.site_image_actu',
		'app.site_code',
		'app.site_actualite_contenu_article',
		'app.site_actualite_link',
		'app.site_actualite_article_utilisateur',
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
		$this->SiteUtilisateur = ClassRegistry::init('SiteUtilisateur');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteUtilisateur);

		parent::tearDown();
	}

}

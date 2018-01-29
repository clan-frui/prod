<?php
App::uses('SiteActualiteArticleImageUtilisateur', 'Model');

/**
 * SiteActualiteArticleImageUtilisateur Test Case
 */
class SiteActualiteArticleImageUtilisateurTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_actualite_article_image_utilisateur',
		'app.site_image_utilisateur',
		'app.site_actualite_article'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteActualiteArticleImageUtilisateur = ClassRegistry::init('SiteActualiteArticleImageUtilisateur');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteActualiteArticleImageUtilisateur);

		parent::tearDown();
	}

}

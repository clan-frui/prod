<?php
App::uses('SiteActualiteArticleUtilisateur', 'Model');

/**
 * SiteActualiteArticleUtilisateur Test Case
 */
class SiteActualiteArticleUtilisateurTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_actualite_article_utilisateur',
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
		$this->SiteActualiteArticleUtilisateur = ClassRegistry::init('SiteActualiteArticleUtilisateur');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteActualiteArticleUtilisateur);

		parent::tearDown();
	}

}

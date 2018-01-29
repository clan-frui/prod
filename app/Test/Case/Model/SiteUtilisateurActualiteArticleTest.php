<?php
App::uses('SiteUtilisateurActualiteArticle', 'Model');

/**
 * SiteUtilisateurActualiteArticle Test Case
 */
class SiteUtilisateurActualiteArticleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_utilisateur_actualite_article',
		'app.site_utilisateur',
		'app.site_commentaire',
		'app.site_actualite_article',
		'app.site_actualite_article_image_utilisateur',
		'app.site_image_utilisateur',
		'app.site_actualite_contenu_article',
		'app.site_actualite_link',
		'app.site_code',
		'app.site_image_actus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteUtilisateurActualiteArticle = ClassRegistry::init('SiteUtilisateurActualiteArticle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteUtilisateurActualiteArticle);

		parent::tearDown();
	}

}

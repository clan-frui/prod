<?php
App::uses('SiteCommentaire', 'Model');

/**
 * SiteCommentaire Test Case
 */
class SiteCommentaireTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_commentaire',
		'app.base_utilisateur',
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
		$this->SiteCommentaire = ClassRegistry::init('SiteCommentaire');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteCommentaire);

		parent::tearDown();
	}

}

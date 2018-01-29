<?php
App::uses('SiteForumCommentaire', 'Model');

/**
 * SiteForumCommentaire Test Case
 */
class SiteForumCommentaireTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_forum_commentaire',
		'app.site_forum_post',
		'app.user',
		'app.site_image_utilisateur',
		'app.site_role',
		'app.site_actualite_article_utilisateur',
		'app.site_actualite_article',
		'app.site_actualite_contenu_article',
		'app.site_image_actu',
		'app.site_code'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteForumCommentaire = ClassRegistry::init('SiteForumCommentaire');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteForumCommentaire);

		parent::tearDown();
	}

}

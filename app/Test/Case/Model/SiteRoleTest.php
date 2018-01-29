<?php
App::uses('SiteRole', 'Model');

/**
 * SiteRole Test Case
 */
class SiteRoleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_role',
		'app.user',
		'app.site_image_utilisateur',
		'app.site_actualite_article_utilisateur',
		'app.site_actualite_article',
		'app.site_image_actu',
		'app.site_code',
		'app.site_actualite_contenu_article'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteRole = ClassRegistry::init('SiteRole');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteRole);

		parent::tearDown();
	}

}

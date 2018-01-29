<?php
App::uses('SiteImageActus', 'Model');

/**
 * SiteImageActus Test Case
 */
class SiteImageActusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.site_image_actus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteImageActus = ClassRegistry::init('SiteImageActus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteImageActus);

		parent::tearDown();
	}

}

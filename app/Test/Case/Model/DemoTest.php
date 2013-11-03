<?php
App::uses('Demo', 'Model');

/**
 * Demo Test Case
 *
 */
class DemoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.demo',
		'app.client',
		'app.step'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Demo = ClassRegistry::init('Demo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Demo);

		parent::tearDown();
	}

}

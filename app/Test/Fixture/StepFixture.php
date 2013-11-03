<?php
/**
 * StepFixture
 *
 */
class StepFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'demo_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'step_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'image_url' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'demo_id' => 1,
			'step_number' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'image_url' => 'Lorem ipsum dolor sit amet'
		),
	);

}

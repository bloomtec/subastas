<?php
/* Config Fixture generated on: 2011-04-06 16:04:03 : 1302121743 */
class ConfigFixture extends CakeTestFixture {
	var $name = 'Config';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'tamano_cola' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'creditos_recomendados' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'tamano_cola' => 1,
			'creditos_recomendados' => 1,
			'created' => '2011-04-06 16:29:03',
			'updated' => '2011-04-06 16:29:03'
		),
	);
}
?>
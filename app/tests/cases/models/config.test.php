<?php
/* Config Test cases generated on: 2011-04-06 16:04:04 : 1302121744*/
App::import('Model', 'Config');

class ConfigTestCase extends CakeTestCase {
	var $fixtures = array('app.config');

	function startTest() {
		$this->Config =& ClassRegistry::init('Config');
	}

	function endTest() {
		unset($this->Config);
		ClassRegistry::flush();
	}

}
?>
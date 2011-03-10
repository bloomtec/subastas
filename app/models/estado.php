<?php
class Estado extends AppModel {
	var $name = 'Estado';
	var $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Subasta' => array(
			'className' => 'Subasta',
			'foreignKey' => 'estado_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>
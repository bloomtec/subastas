<?php
class TipoSubasta extends AppModel {
	var $name = 'TipoSubasta';
	var $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Subasta' => array(
			'className' => 'Subasta',
			'foreignKey' => 'tipo_subasta_id',
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
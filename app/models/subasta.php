<?php
class Subasta extends AppModel {
	var $name = 'Subasta';
	var $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'Venta' => array(
			'className' => 'Venta',
			'foreignKey' => 'subasta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $belongsTo = array(
		'TipoSubasta' => array(
			'className' => 'TipoSubasta',
			'foreignKey' => 'tipo_subasta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Oferta' => array(
			'className' => 'Oferta',
			'foreignKey' => 'subasta_id',
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
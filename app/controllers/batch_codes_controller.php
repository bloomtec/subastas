<?php
class BatchCodesController extends AppController {

	var $name = 'BatchCodes';

	function index() {
		$this->BatchCode->recursive = 0;
		$this->set('batchCodes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid batch code', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('batchCode', $this->BatchCode->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->BatchCode->create();
			if ($this->BatchCode->save($this->data)) {
				$this->Session->setFlash(__('The batch code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch code could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid batch code', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BatchCode->save($this->data)) {
				$this->Session->setFlash(__('The batch code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch code could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BatchCode->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for batch code', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BatchCode->delete($id)) {
			$this->Session->setFlash(__('Batch code deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Batch code was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->BatchCode->recursive = 0;
		$this->set('batchCodes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid batch code', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('batchCode', $this->BatchCode->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			debug($this->data['BatchCode']);

			// Validar que los datos enviados sean números positivos
			//

			// Creditos por codigo
			//
			if (!preg_match("/^\d+$/", $this->data['BatchCode']['creditos_por_codigo']) || !$this->data['BatchCode']['creditos_por_codigo'] > 0 ) {
				$this->Session->setFlash(__('El valor para "Creditos Por Código" no es válido.', true));
			} else {
				// Cantidad de codigos
				//
				if (!preg_match("/^\d+$/", $this->data['BatchCode']['cantidad_de_codigos']) || !$this->data['BatchCode']['cantidad_de_codigos'] > 0 ) {
					$this->Session->setFlash(__('El valor para "Cantidad De Códigos" no es válido.', true));
				} else {
					// Ambos campos son validos --> Crear el batch_code
					//
					$this->BatchCode->create();
					$this->BatchCode->set('nombre', $this->data['BatchCode']['nombre']);
					$this->BatchCode->set('descripcion', $this->data['BatchCode']['descripcion']);

					// Guardar el batch_code
					//
					if($this->BatchCode->save()){
						// Crear ahora los codigos para el batchcode
						//
						debug("El ID es: " . $this->BatchCode->id);
						for ($i = $this->data['BatchCode']['cantidad_de_codigos']; $i > 0; $i--) {
							while (!$this->requestAction('/codes/generarCodigo/' . $this->BatchCode->id . '/' . $this->data['BatchCode']['creditos_por_codigo'])) {
								// Repetir hasta que se genere un codigo valido
								//
							}
						}
						$this->Session->setFlash(__('Se creo el batch de codigos', true));
						$this->redirect(array('action' => 'index'));
					} else {
						// Ocurrio un error al guardar el batch code
						//
						$this->Session->setFlash(__('Error al crear el batch code.', true));
					}
				}
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid batch code', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BatchCode->save($this->data)) {
				$this->Session->setFlash(__('The batch code has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The batch code could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BatchCode->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for batch code', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BatchCode->delete($id)) {
			$this->Session->setFlash(__('Batch code deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Batch code was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
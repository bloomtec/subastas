<?php
class SubastasController extends AppController {

	var $name = 'Subastas';

	function index() {
		$this->Subasta->recursive = 0;
		$this->set('subastas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subasta', $this->Subasta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Subasta->create();
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('The subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subasta could not be saved. Please, try again.', true));
			}
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$estadosSubastas = $this->Subasta->EstadosSubasta->find('list');
		$this->set(compact('tipoSubastas', 'estadosSubastas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('The subasta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subasta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subasta->read(null, $id);
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$estadosSubastas = $this->Subasta->EstadosSubasta->find('list');
		$this->set(compact('tipoSubastas', 'estadosSubastas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subasta->delete($id)) {
			$this->Session->setFlash(__('Subasta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subasta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Subasta->recursive = 0;
		$this->set('subastas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subasta', $this->Subasta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Subasta->create();
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('Se añadió la subasta.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La subasta no se pudo añadir. Por favor intente de nuevo.', true));
				debug($this->Subasta->invalidFields());
			}
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$estadosSubastas = $this->Subasta->EstadosSubasta->find('list');
		$this->set(compact('tipoSubastas', 'estadosSubastas'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('Se ha modificado la subasta', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La subasta no se pudo modificar. Por favor intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subasta->read(null, $id);
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$estadosSubastas = $this->Subasta->EstadosSubasta->find('list');
		$this->set(compact('tipoSubastas', 'estadosSubastas'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subasta->delete($id)) {
			$this->Session->setFlash(__('Subasta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subasta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * << seccion de metodos no generados por cake >>
	 */

	/**
	 * Metodo para actualizar el estado de una subasta
	 * @param unknown_type $subastaID		ID de la subasta a actualizar
	 * @param unknown_type $nuevoEstadoID	ID del nuevo estado para la subasta
	 */
	function actualizarEstadoSubasta($id = null, $estados_subasta_id = null){

		$actualizo = false;

		try {
			$this->Subasta->id = $id;
			$this->Subasta->saveField('estados_subasta_id', $estados_subasta_id);
			$actualizo = true;
		} catch (Exception $e) {
			echo debug($e);
		}

		if($actualizo){

			/**
			 *crearVenta()
			 * vencimientoSubasta()
			 * cancelarSubasta()
			 */

			switch($estados_subasta_id){
				/**
				 * Subasta Esperando Activacion
				 */
				case 1:
					// Por ahora no se daria este caso
					break;

					/**
					 * Subasta Activa
					 */
				case 2:
					$this->__subastaActiva($id);
					break;

					/**
					 * Subasta Pendiente De Pago
					 */
				case 3:
					$this->__subastaPendienteDePago($id);
					break;

					/**
					 * Subasta Vencida
					 */
				case 4:
					$this->__subastaVencida($id);
					break;
			}

			return true;
		} else {
			return false;
		}
	}

	function __subastaEsperandoActivacion($id = null){
		//
	}

	function __subastaActiva($id = null){
		//Encontrar la cantidad de subastas activas
		//
		$subastasActivas = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id' => '2')));

		$cantidadSubastasActivas = 0;

		foreach($subastasActivas as $subastaActiva){
			$cantidadSubastasActivas++;
		}
		
		try {
			$this->Subasta->id = $id;
			// No se pone $cantidadSubastasActivas + 1
			// porque ya se activo la subasta actual y daria una de mas
			//
			$this->Subasta->saveField('posicion_en_cola', $cantidadSubastasActivas);
		} catch (Exception $e) {
			echo debug($e);
		}
	}

	function __subastaPendienteDePago($id = null){

	}

	function __subastaVencida($id = null){

	}

}
?>
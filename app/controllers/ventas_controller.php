<?php
class VentasController extends AppController {

	var $name = 'Ventas';

	function index() {
		$this->Venta->recursive = 0;
		$this->set('ventas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid venta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('venta', $this->Venta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Venta->create();
			if ($this->Venta->save($this->data)) {
				$this->Session->setFlash(__('The venta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The venta could not be saved. Please, try again.', true));
			}
		}
		$subastas = $this->Venta->Subasta->find('list');
		$users = $this->Venta->User->find('list');
		$estadosVentas = $this->Venta->EstadosVenta->find('list');
		$this->set(compact('subastas', 'users', 'estadosVentas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid venta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Venta->save($this->data)) {
				$this->Session->setFlash(__('The venta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The venta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Venta->read(null, $id);
		}
		$subastas = $this->Venta->Subasta->find('list');
		$users = $this->Venta->User->find('list');
		$estadosVentas = $this->Venta->EstadosVenta->find('list');
		$this->set(compact('subastas', 'users', 'estadosVentas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for venta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Venta->delete($id)) {
			$this->Session->setFlash(__('Venta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Venta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Venta->recursive = 0;
		$this->set('ventas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid venta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('venta', $this->Venta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Venta->create();
			if ($this->Venta->save($this->data)) {
				$this->Session->setFlash(__('The venta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The venta could not be saved. Please, try again.', true));
			}
		}
		$subastas = $this->Venta->Subasta->find('list');
		$users = $this->Venta->User->find('list');
		$estadosVentas = $this->Venta->EstadosVenta->find('list');
		$this->set(compact('subastas', 'users', 'estadosVentas'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid venta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Venta->save($this->data)) {
				$this->Session->setFlash(__('The venta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The venta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Venta->read(null, $id);
		}
		$subastas = $this->Venta->Subasta->find('list');
		$users = $this->Venta->User->find('list');
		$estadosVentas = $this->Venta->EstadosVenta->find('list');
		$this->set(compact('subastas', 'users', 'estadosVentas'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for venta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Venta->delete($id)) {
			$this->Session->setFlash(__('Venta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Venta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function crearVenta($subastaID = null, $usuarioID = null){
		$this->Venta->create();
		$this->Venta->set('subasta_id', $subastaID);
		$this->Venta->set('user_id', $usuarioID);
		$this->Venta->set('estados_venta_id', 1);
		$this->Venta->save();
	}

	function fechaCreacionVenta($id = null) {
		$unaVenta = $this->Venta->read(null, $id);
		return $unaVenta['Venta']['created'];
	}
	
	function noPagada($id = null) {
		$this->Venta->read(null, $id);
		$this->Venta->set('estados_venta_id', 3);
		$this->Venta->save();
	}
	
	function pagada($id = null) {
		// Cambiar el estado de la venta
		//
		$venta = $this->Venta->read(null, $id);
		$this->Venta->set('estados_venta_id', 2);
		$this->Venta->save();
		// Cambiar el estado de la subasta a Vendida
		//
		$this->requestAction('/subastas/actualizarEstadoSubasta/' . $venta['Venta']['subasta_id'] . '/7');
	}
	
	function ultimoGanador() {
		return $this->Venta->find('first', array("order"=>array("Venta.id DESC")));
	}
	
	function obtenerIdVenta($subasta_id = null){
		if ($subasta_id) {
			$venta = $this->Venta->find('first', array('conditions'=>array('subasta_id'=>$subasta_id), 'fields'=>array('id')));
			return $venta['Venta']['id'];
		}
	}

}
?>
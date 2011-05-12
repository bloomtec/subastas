<?php
class EstadosVentasController extends AppController {

	var $name = 'EstadosVentas';

	function index() {
		$this->EstadosVenta->recursive = 0;
		$this->set('estadosVentas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid estados venta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('estadosVenta', $this->EstadosVenta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EstadosVenta->create();
			if ($this->EstadosVenta->save($this->data)) {
				$this->Session->setFlash(__('The estados venta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estados venta could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid estados venta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EstadosVenta->save($this->data)) {
				$this->Session->setFlash(__('The estados venta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estados venta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EstadosVenta->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for estados venta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EstadosVenta->delete($id)) {
			$this->Session->setFlash(__('Estados venta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Estados venta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->EstadosVenta->recursive = 0;
		$this->set('estadosVentas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid estados venta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('estadosVenta', $this->EstadosVenta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->EstadosVenta->create();
			if ($this->EstadosVenta->save($this->data)) {
				$this->Session->setFlash(__('The estados venta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estados venta could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid estados venta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EstadosVenta->save($this->data)) {
				$this->Session->setFlash(__('The estados venta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estados venta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EstadosVenta->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for estados venta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EstadosVenta->delete($id)) {
			$this->Session->setFlash(__('Estados venta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Estados venta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
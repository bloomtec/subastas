<?php
class SubastasController extends AppController {

	var $name = 'Subastas';

	function index() {
		$this->Subasta->recursive = 0;
		$this->set('subastas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subasta', $this->Subasta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Subasta->create();
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('La subasta ha sido guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La subasta no se pudo guardar. Por favor intente de nuevo.', true));
			}
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$this->set(compact('tipoSubastas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('La subasta ha sido guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La subasta no se pudo guardar. Por favor intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subasta->read(null, $id);
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$this->set(compact('tipoSubastas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('id no valida para subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subasta->delete($id)) {
			$this->Session->setFlash(__('Subasta borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La subasta no fue borrada', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Subasta->recursive = 0;
		$this->set('subastas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subasta', $this->Subasta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Subasta->create();
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('La subasta ha sido guardada.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La subasta no se puedo guardar. Por favor intente de nuevo.', true));
			}
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$this->set(compact('tipoSubastas'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subasta->save($this->data)) {
				$this->Session->setFlash(__('La subasta ha sido guardada', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La subasta no se pudo guardar. Por favor intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subasta->read(null, $id);
		}
		$tipoSubastas = $this->Subasta->TipoSubasta->find('list');
		$this->set(compact('tipoSubastas'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('id no valida para subasta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subasta->delete($id)) {
			$this->Session->setFlash(__('Subasta borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('La subasta no fue borrada', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
<?php
class TestimoniosController extends AppController {

	var $name = 'Testimonios';
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow("random");
	}
	

	private function añadirTestimonio() {
		if (!empty($this->data)) {
			$this->Testimonio->create();
			if ($this->Testimonio->save($this->data)) {
				$this->Session->setFlash(__('Se guardo su testimonio.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar su testimonio.', true));
			}
		}
	}
	function random(){
		return $this->Testimonio->find("first",array("order"=>array("id desc")));
	}
	function index() {
		$this->Testimonio->recursive = 0;
		$this->set('testimonios', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid testimonio', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('testimonio', $this->Testimonio->read(null, $id));
	}

	function add() {
		// titulo, texto descriptivo e imagen
		$this->añadirTestimonio();
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid testimonio', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Testimonio->save($this->data)) {
				$this->Session->setFlash(__('The testimonio has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testimonio could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Testimonio->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for testimonio', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Testimonio->delete($id)) {
			$this->Session->setFlash(__('Testimonio deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Testimonio was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Testimonio->recursive = 0;
		$this->set('testimonios', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid testimonio', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('testimonio', $this->Testimonio->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Testimonio->create();
			if ($this->Testimonio->save($this->data)) {
				$this->Session->setFlash(__('The testimonio has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testimonio could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid testimonio', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Testimonio->save($this->data)) {
				$this->Session->setFlash(__('The testimonio has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testimonio could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Testimonio->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for testimonio', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Testimonio->delete($id)) {
			$this->Session->setFlash(__('Testimonio deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Testimonio was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
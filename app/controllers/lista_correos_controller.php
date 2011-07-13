<?php
class ListaCorreosController extends AppController {

	var $name = 'ListaCorreos';

	function admin_index() {
		$this->ListaCorreo->recursive = 0;
		$this->set('listaCorreos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid lista correo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('listaCorreo', $this->ListaCorreo->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ListaCorreo->create();
			if ($this->ListaCorreo->save($this->data)) {
				$this->Session->setFlash(__('The lista correo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lista correo could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid lista correo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ListaCorreo->save($this->data)) {
				$this->Session->setFlash(__('The lista correo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lista correo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ListaCorreo->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for lista correo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ListaCorreo->delete($id)) {
			$this->Session->setFlash(__('Lista correo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Lista correo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_prueba() {
		if(!empty($this->data)) {
			$this -> enviarCorreos($this -> ListaCorreo -> find('list', array('fields' => 'correo', 'conditions' => array('id' => $this -> data['ListaCorreo']['correos']))));
		}
		$correos = $this->ListaCorreo->find('list');
		$this->set(compact('correos'));
	}
	
	private function enviarCorreos($correos = null) {
		App::import('Vendor', 'MadMimi', array('file' =>'madmimi'.DS.'MadMimi.class.php'));
		$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));
		
		/*foreach($correos as $correo) {
			$options = array(
				'recipients' => $correo . ' < ' . $correo . '>',
				'promotion_name' => 'Untitled Promotion', 'subject' => 'You Gotta Read This',
				'from' => 'Llevatelos Mad Mimi Mailer <noreply@llevatelos.com>');
			$body = array('greeting' => 'Hola, prueba de Mad Mimi', 'name' => $correo);
			$mailer->SendMessage($options, $body);
		}*/
		
		$options = array(
			'recipients' => 'Julio ' . '<juliodominguez@gmail.com>',
			'promotion_name' => 'Esto es una prueba', 'subject' => 'Esto es una prueba',
			'from' => 'Llevatelos Mad Mimi Mailer <llevatelos.com@gmail.com>');
		$body = array('greeting' => 'Hola, prueba de Mad Mimi', 'name' => 'Julio');
		$mailer->SendMessage($options, $body);
		
	}
	
}
?>
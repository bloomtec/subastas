<?php
class OfertasController extends AppController {

	var $name = 'Ofertas';

	function obtenerUsuarioUltimaOferta($subastaID = null,$ofertID=null){
		$this->autoRender = false;
		
		if(isset($_GET['subasta_id'])){
			$subastaID = $_GET['subasta_id'];
		}
		if(isset($_GET['oferta_id'])){
			$ofertID = $_GET['oferta_id'];
		}
		
		if($subastaID){
			$result = $this->Oferta->find('first', array('conditions'=>array('Oferta.subasta_id' => $subastaID,"Oferta.id >"=>$ofertID), 'order' => array('Oferta.created DESC')));
			if(isset($result['User']['username'])){
				$result["Oferta"]["cantidad"]=$this->Oferta->find('count', array('conditions'=>array('Oferta.subasta_id' => $subastaID)));
				return json_encode($result);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function getOfertas($subastaID){
		return $this->Oferta->find("all", array("conditions"=>array("subasta_id"=>$subastaID), "order"=>array("Oferta.created DESC")));
	}
	
	function getCantidadOfertasSubasta($subastaID) {
		return $this->Oferta->find("count", array("conditions"=>array("subasta_id"=>$subastaID)));
	}
	
	function index() {
		$this->Oferta->recursive = 0;
		$this->set('ofertas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid oferta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('oferta', $this->Oferta->read(null, $id));
	}
	
	function crearOferta($userID = null, $subastaID = null, $creditosDescontados = null){
		$this->Oferta->create();
		$this->Oferta->set('subasta_id', $subastaID);
		$this->Oferta->set('user_id', $userID);
		$this->Oferta->set('creditos_descontados', $creditosDescontados);
		$oferta=$this->Oferta->save();
		if(!empty($oferta)){
			$oferta=$this->Oferta->read(null,$this->Oferta->id);
			$oferta["success"]=true;
			return $oferta;
		}else{
			return false;
		}
		
	}

	/*function add() {
		if (!empty($this->data)) {
			$this->Oferta->create();
			if ($this->Oferta->save($this->data)) {
				$this->Session->setFlash(__('The oferta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The oferta could not be saved. Please, try again.', true));
			}
		}
		$subastas = $this->Oferta->Subasta->find('list');
		$users = $this->Oferta->User->find('list');
		$this->set(compact('subastas', 'users'));
	}*/

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid oferta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Oferta->save($this->data)) {
				$this->Session->setFlash(__('The oferta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The oferta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Oferta->read(null, $id);
		}
		$subastas = $this->Oferta->Subasta->find('list');
		$users = $this->Oferta->User->find('list');
		$this->set(compact('subastas', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for oferta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Oferta->delete($id)) {
			$this->Session->setFlash(__('Oferta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Oferta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Oferta->recursive = 0;
		$this->set('ofertas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid oferta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('oferta', $this->Oferta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Oferta->create();
			if ($this->Oferta->save($this->data)) {
				$this->Session->setFlash(__('The oferta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The oferta could not be saved. Please, try again.', true));
			}
		}
		$subastas = $this->Oferta->Subasta->find('list');
		$users = $this->Oferta->User->find('list');
		$this->set(compact('subastas', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid oferta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Oferta->save($this->data)) {
				$this->Session->setFlash(__('The oferta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The oferta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Oferta->read(null, $id);
		}
		$subastas = $this->Oferta->Subasta->find('list');
		$users = $this->Oferta->User->find('list');
		$this->set(compact('subastas', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for oferta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Oferta->delete($id)) {
			$this->Session->setFlash(__('Oferta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Oferta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * << metodos no generados por cake >>
	 */

	function obtenerTotalOfertas($subastaID = null) {
		return $this->Oferta->find('count', array('conditions' => array('Oferta.subasta_id' => $subastaID)));
	}
	
	function obtenerOfertasSubasta($subastaID = null) {
		/**
		 * Obtener todas las ofertas hechas a una subasta
		 */
		return $this->Oferta->find('all', array('conditions' => array('Oferta.subasta_id' => $subastaID)));
	}
	
	function obtenerTotalCreditosDescontados($subastaID = null){
		$this->loadModel('Subasta');
		$subasta = $this->Subasta->read(null, $subastaID);
		$cantidadCreditos = $subasta['Subasta']['cantidad_creditos_puja'];
		$cantidadPujas = $this->Oferta->find("count", array('conditions' => array('Oferta.subasta_id' => $subastaID)));
		return $cantidadCreditos * $cantidadPujas;
	}

	function obtenerUsuarioGanadorSubasta($subastaID = null){
		$ofertaGanadora = $this->Oferta->find("first", array('conditions' => array('Oferta.subasta_id' => $subastaID)));
		return $ofertaGanadora['User']['id'];
	}
	
	function eliminarOfertasSubasta($subasta_id = null) {
		if($subasta_id){
			$ids = $this->Oferta->find('list', array('fields'=>array('Oferta.id'), 'conditions'=>array('Oferta.subasta_id'=>$subasta_id)));
			if ($ids){
				foreach($ids as $id){
					$this->Oferta->delete($id);
				}
			} else {
				// No se encotro algo
			}
		} else {
			// No se ingreso un id de subasta
		}
	}

}
?>
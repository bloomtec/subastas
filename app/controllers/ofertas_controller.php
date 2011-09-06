<?php
class OfertasController extends AppController {

	var $name = 'Ofertas';

	function obtenerUsuarioUltimaOferta($subastaID = null,$ofertaID=null){	
		$subastaID = $_GET['subasta_id'];
		$ofertaID = $_GET['oferta_id'];
		
		$result = $this->Oferta->query(

			"SELECT Oferta.id, Oferta.user_id, Oferta.subasta_id, Subasta.precio, Subasta.aumento_duracion, Subasta.estados_subasta_id, Subasta.fecha_de_venta,User.username, User.creditos
			FROM ofertas as Oferta, users as User, subastas as Subasta
			WHERE Subasta.id = '$subastaID'
			AND Oferta.subasta_id = Subasta.id
			AND Oferta.id > '$ofertaID'
			ORDER BY Oferta.created DESC"
		);
		if(isset($result[0])) {
			$result = $result[0];
			$result["actualizada"]=true;
			$fecha= date_create_from_format('Y-m-d H:i:s',	$result["Subasta"]["fecha_de_venta"]);
			$result["Subasta"]["fecha_de_venta"]=$fecha->format('Y M d H:i:s');;
			echo json_encode($result);
		} else {
			$this->Subasta->recursive=-1;
			$result=$this->Oferta->Subasta->read(null,$subastaID);
			$result["actualizada"]=false;
			$fecha= date_create_from_format('Y-m-d H:i:s',	$result["Subasta"]["fecha_de_venta"]);
			$result["Subasta"]["fecha_de_venta"]=$fecha->format('Y M d H:i:s');;
			
			echo json_encode($result);
		}
			
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}
	
	function getOfertas($subastaID){
		return $this->Oferta->find("all", array("conditions"=>array("subasta_id"=>$subastaID), "order"=>array("Oferta.created DESC")));
	}
	
	function getCantidadOfertasSubasta($subastaID) {
		return $this->Oferta->find("count", array("conditions"=>array("subasta_id"=>$subastaID)));
	}
	
	function getOfertasUsuarioSubasta($user_id, $subasta_id) {
		$this->autoRender = false;
		if($user_id && $subasta_id) {
			return $this->Oferta->find('all', array('conditions' => array('user_id' => $user_id, 'subasta_id' => $subasta_id)));			
		} else {
			return array();
		}
	}
	
	function getTotalBonosUsuarioSubasta($user_id, $subasta_id) {
		$this->autoRender = false;
		if($user_id && $subasta_id) {
			$ofertasUsuarioSubasta = $this->Oferta->find('all', array('conditions' => array('user_id' => $user_id, 'subasta_id' => $subasta_id)));
			$totalBonos = 0;
			foreach ($ofertasUsuarioSubasta as $key => $value) {
				$totalBonos += $value['Oferta']['bonos_descontados'];
			}
			return $totalBonos;	
		} else {
			return 0;
		}
	}
	
	function getTotalCreditosUsuarioSubasta($user_id, $subasta_id) {
		$this->autoRender = false;
		if($user_id && $subasta_id) {
			$ofertasUsuarioSubasta = $this->Oferta->find('all', array('conditions' => array('user_id' => $user_id, 'subasta_id' => $subasta_id)));
			$totalCreditos = 0;
			foreach ($ofertasUsuarioSubasta as $key => $value) {
				$totalCreditos += $value['Oferta']['creditos_descontados'];
			}
			return $totalCreditos;	
		} else {
			return 0;
		}
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
	
	function crearOferta($userID = null, $subastaID = null, $creditosDescontados = null, $bonosDescontados = null) {
		
		$this->Oferta->create();
		$this->Oferta->set('subasta_id', $subastaID);
		$this->Oferta->set('user_id', $userID);
		$this->Oferta->set('creditos_descontados', $creditosDescontados);
		$this->Oferta->set('bonos_descontados', $bonosDescontados);
		
		if($this->Oferta->save()) {
				
			$oferta = $this->Oferta->read(null, $this->Oferta->id);
			$subasta['Subasta'] = $oferta['Subasta'];
			$subasta['Subasta']['precio'] += $subasta['Subasta']['aumento_precio'];
			
        	if($this->Oferta->Subasta->save($subasta)) {
        		$oferta['Subasta'] = $subasta['Subasta'];
				$fecha = date_create_from_format('Y-m-d H:i:s',	$oferta['Subasta']['fecha_de_venta']);
				$oferta['Subasta']['fecha_de_venta'] = $fecha->format('Y M d H:i:s');
				$oferta['success'] = true;
				return $oferta;
			} else {
				$oferta['success'] = false;
				return $oferta;
			}
			
		}else{
			$oferta['success'] = false;
			return $oferta;
		}
		
	}

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
	
	function obtenerTotalCreditosDescontados($subasta_id = null){
		$creditos_ofertados = 0;
		$ofertas_subasta = $this->Oferta->find('all', array('conditions' => array('Oferta.subasta_id' => $subasta_id)));
		foreach($ofertas_subasta as $oferta_subasta) {
			$creditos_ofertados += $oferta_subasta['Oferta']['creditos_descontados'];
		}
		return $creditos_ofertados;
	}

	function obtenerUsuarioGanadorSubasta($subastaID = null){
		$ofertaGanadora = $this->Oferta->find("first", array('order' => 'Oferta.id DESC', 'conditions' => array('Oferta.subasta_id' => $subastaID)));
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
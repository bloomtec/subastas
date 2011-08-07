<?php
class SubastasController extends AppController {

	var $name = 'Subastas';
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow("index","subastasFinalizadas","ultimaOferta","pruebas");
	}
	function pruebas(){
	$subasta=$this->Subasta->find("first");
		debug($subasta["Subasta"]["fecha_de_venta"]);
		debug(gmdate('Y-m-d H:i:s', time() + (3600 * -5) + 1));
		debug(gmdate('Y-m-d H:i:s', time() + (3600 * -5)));
	}
	function ultimaOferta($subastaID){
		$oferta=$this->Subasta->Oferta->find("first",array("conditions"=>array("Oferta.subasta_id"=>$subastaID),"order"=>array("Oferta.id DESC")));
		return $oferta;
	}
	function getStatus(){
		$time=$_GET["ms"];
		$date=date("Y-m-d H:i:s", substr($time,0,-3));
		$dateTime=new DateTime($date);
		$this->Subasta->Behaviors->attach('Containable');
		$this->Subasta->recursive=2;
		$subastas=$this->Subasta->find("all",array("conditions"=>array("Subasta.id"=>$_POST["subastas"]),'contain' => array(
		'Oferta' => array(
			'order' => array('Oferta.id DESC'),
			'limit'=>1,
			'User'
			
		))));
		
		echo json_encode($subastas);
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0); 
		
	}
	function congelar($duracion = null) {
		
		if ($duracion) {
			
			$subastas = $this->Subasta->find(
				"all",
				array(
					'conditions' => array(
						'Subasta.estados_subasta_id' => '2',
						'Subasta.posicion_en_cola <=' => $this->requestAction('/configs/tamanoCola')
					),
					'order' => array(
						'Subasta.posicion_en_cola'
					)
				)
			);
			
			foreach ($subastas as $subasta) {
				$fecha_de_venta = date($subasta['Subasta']['fecha_de_venta']);
				$fecha_de_venta = strtotime(date("Y-m-d H:i:s", strtotime($fecha_de_venta)) . " +" . $duracion . " minutes");
				$fecha_de_venta = date("Y-m-d H:i:s", $fecha_de_venta);
				$fecha_de_venta = new DateTime($fecha_de_venta);
				$fecha_de_venta = $fecha_de_venta->format('Y-m-d H:i:s');
				$this->Subasta->set('fecha_de_venta', $fecha_de_venta);
				$this->Subasta->save();
			}
			
		}
		
	}
	
	function admin_cola(){
		$this->set("subastas",$this->Subasta->find("all",array("conditions"=>array("Subasta.posicion_en_cola >"=>0),"order"=>"Subasta.posicion_en_cola ASC")));
	}

	/**
	 * Devuelve todas las subastas activas
	 * en la que este usuario ha participado
	 */
	function subastasActivas(){
		$this->autoRender=false;
		$userID = $this->Auth->user("id");

		//Encontrar las subastas con estado activo
		// y que se encuentren en sus 'fecha_de_venta'
		//
		$gmt = 3600*-5; // GMT -5 para hora colombiana
		$fechaActual = gmdate('Y-m-d H:i:s', time() + $gmt); // Generar la fecha actual formateada para comparar con la fecha de mysql
		$query =
			"SELECT DISTINCT Subasta.id, Subasta.nombre, Subasta.valor, Subasta.precio, Subasta.imagen_path, Subasta.fecha_de_venta, Subasta.aumento_precio
			FROM subastas as Subasta, users as User, ofertas as Oferta
			WHERE User.id = $userID
			AND Oferta.user_id = User.id
			AND Subasta.id = Oferta.subasta_id
			AND Subasta.estados_subasta_id = '2'
			AND Subasta.fecha_de_venta > '$fechaActual'";
		$subastas = $this->Subasta->query($query);
		return $subastas;
	}

	/**
	 * Devuelve todas las subastas finalizadas
	 * en la que este usuario ha participado
	 */
	function finalizadas(){
		$userID = $this->Auth->user("id");
		$query =
			"SELECT DISTINCT Subasta.id, Subasta.nombre, Subasta.valor, Subasta.precio, Subasta.imagen_path, Subasta.fecha_de_venta, Subasta.aumento_precio
			FROM subastas as Subasta, users as User, ofertas as Oferta
			WHERE User.id = $userID
			AND Oferta.user_id = User.id
			AND Subasta.id = Oferta.subasta_id
			AND Subasta.estados_subasta_id > '2'";
		$subastas = $this->Subasta->query($query);
		$this->set(compact("subastas"));
	}
	
	function ganadas(){
		$userID = $this->Auth->user("id");
		$this->set('user_id', $userID);
		$query =
			"SELECT *
			FROM subastas as Subasta
			WHERE Subasta.id IN (
				SELECT subasta_id
				FROM ventas
				WHERE estados_venta_id = 1
				AND user_id = $userID
			)";
		$subastas = $this->Subasta->query($query);
		$this->set(compact('subastas'));
	}

	function subastasFinalizadas(){
		$subastas=$this->Subasta->find("all",array("conditions"=>array("estados_subasta_id >"=>2)));
		$this->set(compact("subastas"));
	}

	function ofertar($subastaID = null) {
		$time=$_GET["ms"];
		$date=date("Y-m-d H:i:s", substr($time,0,-3));
		if (!$this->requestAction('/configs/isCongelado')) {
			$subastaID=$_GET["subasta_id"];
			$subasta=$this->Subasta->read(null, $subastaID);
			
			if ($subasta["Subasta"]["estados_subasta_id"] != 2 || $date>=$subasta["Subasta"]["fecha_de_venta"]) {
				echo false;
				Configure::write("debug",0);
				$this->autoRender=false;
				exit(0);
			} else {
				echo json_encode($this->__ofertar($subasta));
			}
			Configure::write("debug",0);
			$this->autoRender=false;
			exit(0);
		} else {
			echo null;
		}
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}

	function __ofertar($subasta = null) {
		$userId = $this->Session->read('Auth.User.id');
		//$userId=1;
		// Validar que el usuario tenga suficientes creditos para ofertar
		// SUBASTA VENTA FIJA
		if ($subasta['TipoSubasta']['id'] == 1) {
			
			if($this->requestAction('/users/creditosSuficientes/' . $userId. '/' . $subasta['Subasta']['cantidad_creditos_puja'])) {
				// Como el usuario tiene suficientes creditos proceder a descontar los creditos
				//
				return $this->requestAction('/users/descontarCreditos/' . $subasta['Subasta']['id'] . '/' . $userId . '/' . $subasta['Subasta']['cantidad_creditos_puja']);

			} else {
				return array("success"=>false,"mensaje"=>"No tiene suficiente credito, Por favor compra mas creditos para poder ofertar","code"=>"1");
			}
			
		} else {
			// Validar que el usuario tenga suficientes creditos para ofertar
			// SUBASTA MINIMO DE CREDITOS
			if($this->requestAction('/users/creditosSuficientes/' . $userId . '/' . $subasta['Subasta']['cantidad_creditos_puja'] . '/' . $subasta['Subasta']['umbral_minimo_creditos'])) {
				// Como el usuario tiene suficientes creditos proceder a descontar los creditos
				//
				return $this->requestAction('/users/descontarCreditos/' . $subasta['Subasta']['id'] . '/' . $userId . '/' . $subasta['Subasta']['cantidad_creditos_puja']);

			} else {
				return array("success"=>false,"mensaje"=>"No tiene suficiente credito, Por favor compra mas creditos para poder ofertar","code"=>"1");
			}
			
		}
	}

	function index() {
		$this->Subasta->recursive = 0;
		$config=$this->Config->read(null,1);
		$gmt = 3600*-5;
		$fechaActual = gmdate('Y-m-d H:i:s', time() + $gmt);
		if (!empty($this->params['requested'])) {
			return $this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
			 		"Subasta.posicion_en_cola <="=>$config["Config"]["tamano_cola"],
			 		"Subasta.fecha_de_venta >"=>"$fechaActual"
			)
			));
		} else {
			$subastas=$this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
			 		"Subasta.posicion_en_cola <="=>$config["Config"]["tamano_cola"],
			 		"Subasta.fecha_de_venta >"=>"$fechaActual"
			)));
			$this->set('subastas',$subastas);
			$this->set("registrado",$this->Cookie->read("registrado"));
		}
	}

	function ultimasSubastas(){
		if (!empty($this->params['requested'])) {
			return $this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>7//vendida
			)
			));
		} else {
			$this->Paginate=array("Subasta",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>7//vendida
			)
			));
			$this->set('subastas', $this->paginate());
		}
	}

	function proximasSubastas(){
	 $config=$this->Config->read(null,1);
	 if (!empty($this->params['requested'])) {
	 	return $this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
			 		"Subasta.posicion_en_cola >"=>$config["Config"]["tamano_cola"]
	 	)
	 	));
	 } else {
	 	$this->Paginate=array("Subasta",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
					"Subasta.posicion_en_cola >"=>$config["Config"]["tamano_cola"]
	 	)
	 	));
	 	$this->set('subastas', $this->paginate());
	 }
	}
	function proximaSubasta(){
	 $config=$this->Config->read(null,1);
	 if (!empty($this->params['requested'])) {
	 	$subastas=$this->Subasta->find("all",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
			 		"Subasta.posicion_en_cola >"=>$config["Config"]["tamano_cola"]
	 	)
	 	));
	 	if(isset($subastas[0])){
	 		return $subastas[0];
	 	}else{
	 		return null;
	 	}
	 } else {
	 	$this->Paginate=array("Subasta",array(
			 	"conditions"=>array(
			 		"Subasta.estados_subasta_id"=>2,//activa
					"Subasta.posicion_en_cola >"=>$config["Config"]["tamano_cola"]
	 	)
	 	));
	 	$this->set('subastas', $this->paginate());
	 }
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subasta', $this->Subasta->read(null, $id));
	}

	function admin_index() {
		$this->Subasta->recursive = 0;
    $this->paginate=array("order"=>array("Subasta.estados_subasta_id"=>"asc","Subasta.posicion_en_cola"=>"asc"));
		$this->set('subastas', $this->paginate("Subasta"));
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
				$this->__sincronizarPosiciones();
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
				$this->__sincronizarPosiciones();
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
			$this->__sincronizarPosiciones();
			$this->Session->setFlash(__('Subasta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subasta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function sync() {
		$this->__sincronizarPosiciones();
	}

	function __sincronizarPosiciones(){
		// << Sacar la subasta de la cola si su estado no es "Activa" >>
		//
		$subastasNoActivas = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id <>' => '2', 'Subasta.posicion_en_cola >' => '0')));

		foreach($subastasNoActivas as $subastaNoActiva) {
			$this->Subasta->read(null, $subastaNoActiva["Subasta"]["id"]);
			$this->Subasta->set('posicion_en_cola', -1);
			$this->Subasta->save();
		}

		// << Reasignar numeros a las subastas con estado "Activa" >>
		//

		$subastasActivas = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id' => '2'), 'order' => array('Subasta.posicion_en_cola')));

		$posicion_en_cola = 1;
		$subastasActivasPorPrimeraVez = array();

		foreach($subastasActivas as $key=>$subastasActiva) {
			if($subastasActiva['Subasta']['posicion_en_cola'] == -1) {
				$subastasActivasPorPrimeraVez[$key] = $subastasActiva;
			} else {
				$this->Subasta->read(null, $subastasActiva["Subasta"]["id"]);
				$this->Subasta->set('posicion_en_cola', $posicion_en_cola);
				$this->Subasta->save();
				$posicion_en_cola++;
			}
		}
		
		foreach ($subastasActivasPorPrimeraVez as $subastasActiva) {
			$this->Subasta->read(null, $subastasActiva["Subasta"]["id"]);
			$this->Subasta->set('posicion_en_cola', $posicion_en_cola);
			$this->Subasta->save();
			$posicion_en_cola++;
		}
		
		$this->__verificarFechaDeVentaSubastasActivas();

	}
	
	function __verificarFechaDeVentaSubastasActivas(){
		$subastasActivas = $this->Subasta->find(
			"all",
			array(
				'conditions' => array(
					'Subasta.estados_subasta_id' => '2',
					'Subasta.posicion_en_cola <=' => $this->requestAction('/configs/tamanoCola')
				),
				'order' => array(
					'Subasta.posicion_en_cola'
				)
			)
		);
		
		foreach ($subastasActivas as $subastaActiva) {
			if (empty($subastaActiva['Subasta']['fecha_de_venta'])) {
				$this->Subasta->read(null, $subastaActiva['Subasta']['id']);
				$gmt = 3600*-5; // GMT -5 para hora colombiana
				$duracionInicial = 60*$subastaActiva['Subasta']['duracion_inicial'];
				$fechaDeVenta = gmdate('Y-m-d H:i:s', time() + $gmt + $duracionInicial);
				$this->Subasta->set('fecha_de_venta', $fechaDeVenta);
				$this->Subasta->save();
			}
		}
		
	}

	function __cambiarEstadoSubasta($id = null, $estados_subasta_id = null) {
		$this->Subasta->read(null, $id);
		$this->Subasta->set('estados_subasta_id', $estados_subasta_id);
		if ($this->Subasta->save())
			return true;
		else
			return false;
	}
	
	/**
	 * Metodo para actualizar el estado de una subasta
	 * @param unknown_type $subastaID		ID de la subasta a actualizar
	 * @param unknown_type $nuevoEstadoID	ID del nuevo estado para la subasta
	 */
	function actualizarEstadoSubasta($id = null, $estados_subasta_id = null){

		// Tomar acciones acorde el nuevo estado de la subasta
		//
		switch($estados_subasta_id){
			/**
			 * Subasta Esperando Activacion
			 * Nota : Segun los ultimos cambios este caso nunca se daria
			 */
			case 1:
				// Este caso actualmente no se da
				break;

				/**
				 * Subasta Activa
				 */
			case 2:
				$this->__cambiarEstadoSubasta($id, $estados_subasta_id);
				return $this->__subastaActiva($id);
				break;

				/**
				 * Subasta Pendiente De Pago
				 * Se crea una venta para proceder con el pago
				 */
			case 3:
				$this->__cambiarEstadoSubasta($id, $estados_subasta_id);
				return $this->__crearVenta($id);
				break;

				/**
				 * Subasta Vencida
				 * Nota : Acorde los ultimos cambios
				 * este caso no se daria
				 */
			case 4:
				$this->__cambiarEstadoSubasta($id, $estados_subasta_id);
				return $this->__subastaVencida($id);
				break;
				/**
				 * Subasta cancelada
				 */
			case 5:
				// Aqui toca validar el estado actual de la subasta para ver que se hace
				// Los diferentes casos a considerar son son si esta en espera de pago o no lo esta
				//
				$subasta = $this->Subasta->find('first', array('conditions'=>array('Subasta.id'=>$id)));
				
				// Tomar la decision de que hacer
				//
				if($subasta['Subasta']['estados_subasta_id'] == 3) {
					// En esta seccion la subasta esta en espera de pago
					//
					$this->__cambiarEstadoSubasta($id, $estados_subasta_id);
					return $this->__cancelEsperaDePago($id);
				} else {
					// En esta seccion la subasta NO esta en espera de pago
					//
					$this->__cambiarEstadoSubasta($id, $estados_subasta_id);
					return $this->__cancel($id);
				}
				
				break;
				/**
				 * Se cerro la subasta
				 * Nota : Por ahora solo es cambiar el estado de la subasta
				 */
			case 6:
				$this->__cambiarEstadoSubasta($id, $estados_subasta_id);
				return $this->__cerrar($id);
				break;
				/**
				 * Vendida
				 */
			case 7:
				$this->__cambiarEstadoSubasta($id, $estados_subasta_id);
				return $this->__vendida($id);
				break;
		}

	}

	function __cerrar($id = null){
		// NOTA:
		// Acorde el documento --> solo para que no se muestre en las subastas
		$this->__sincronizarPosiciones();
		return true;
	}

	function __subastaEsperandoActivacion($id = null){
		//por ahora no se llama este metodo
	}

	function __subastaActiva($id = null){
		//Encontrar la cantidad de subastas activas
		//
		$cantidadSubastasActivas = $this->Subasta->find('count', array('conditions' => array('Subasta.estados_subasta_id' => '2')));

		$this->Subasta->read(null, $id);
		$this->Subasta->set('posicion_en_cola', $cantidadSubastasActivas + 1);
		
		if ($this->Subasta->save()){
			return true;
		} else {
			return false;
		}
	}

	function __crearVenta($id = null){
		/**
		 * Crea un registro en la tabla ventas, user_id = usuarioGanador()
		 * y subasta_id = (parametro subasta_id) y estado="pendiente_de_pago"
		 */
		$this->requestAction('/ventas/crearVenta/'.$id.'/'.$this->requestAction('/ofertas/obtenerUsuarioGanadorSubasta/'.$id));
		$this->enviarCorreoSubastaGanada($id);
		$this->__sincronizarPosiciones();
		return true;
	}

	function __subastaVencida($id = null){
		// TODO : SUBASTA VENCIDA (Falta definicion del cliente)
		$this->__sincronizarPosiciones();
		return true;
	}

	function admin_cerrar($id = null) {
		if(!$id){
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		if($this->actualizarEstadoSubasta($id, 6)){
			$this->Session->setFlash(__('Se cerro la subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('No se pudo cerrar la subasta', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_vendida($id = null) {
		if(!$id){
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		if($this->actualizarEstadoSubasta($id, 7)){
			$this->Session->setFlash(__('Se cambio el estado de la subasta a VENDIDA', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('No se pudo cerrar la subasta', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function __vendida($id = null) {
		return true;
	}

	function admin_cancel($id = null) {
		if(!$id){
			$this->Session->setFlash(__('Subasta no valida', true));
			$this->redirect(array('action' => 'index'));
		}
		if($this->actualizarEstadoSubasta($id, 5)){
			$this->Session->setFlash(__('Se cancelo la subasta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('No se pudo cancelar la subasta', true));
		$this->redirect(array('action' => 'index'));
	}

	function __cancelEsperaDePago($subasta_id = null) {
		// Este metodo queda por si toca hacer algo cuando se cancele la
		// subasta luego de estar en espera de pago
		//
		
		return true;
	}
	
	function __cancel($subasta_id = null){
		/**
		 * Recorrer todas las ofertas de la subasta cancelada y a todos los
		 * usuarios que ofertaron se les devuelve el credito que habian
		 * pagado. Enviar correo de notificacion
		 * 
		 * OJO :: Lo anterior es valido para cuando se cancela una subasta activa.
		 * Para cuando se cancele una subasta pendiente de pago se cambia de estado solamente.
		 * Verificar el otro metodo de cancelacion en caso de estar en esa situacion y se requiera
		 * hacer algo.
		 * 
		 */
		
		// Encontrar las ofertas correspondientes a una subasta
		//
		$ofertasHechas = $this->requestAction('/ofertas/obtenerOfertasSubasta/' . $subasta_id);

		if ($ofertasHechas) {
			// Recorrer las ofertas y devolver los creditos
			//
			foreach($ofertasHechas as $unaOfertaHecha) {
				// Reponer los creditos de la oferta
				//
				$creditosAReponer = $unaOfertaHecha['Oferta']['creditos_descontados'];
				$bonosAReponer = $unaOfertaHecha['Oferta']['bonos_descontados'];
				$this->requestAction('/users/reponerCreditos/'.$unaOfertaHecha['User']['id'].'/'.$creditosAReponer.'/'.$bonosAReponer);
			}

			/**
			 * Proceder a enviar correos
			 */

			// Correos ofertantes
			//
			$correos = $this->obtenerListaCorreoOfertas($subasta_id);
			$subasta = $this->Subasta->read(null, $subasta_id);

			foreach ($correos as $key=>$correo) {
				$this->enviarCorreoSubastaCancelada($correo['User']['email'], $subasta['Subasta']['nombre']);
			}

			// Correos lista correos
			//
			$this->loadModel('ListaCorreo');
			$correos = $this->ListaCorreo->find('list');

			foreach ($correos as $correo) {
				$this->enviarCorreoSubastaCancelada($correo, $subasta['Subasta']['nombre']);
			}

			/**
			 * Finalmente eliminar las ofertas relacionadas con la subasta
			 */

			$this->requestAction('/ofertas/eliminarOfertasSubasta/' . $subasta_id);

			$this->__sincronizarPosiciones();
		}

		return true;
	}

	function obtenerListaCorreoOfertas($subasta_id = null) {
		$this->loadModel('Oferta');
		$correos = $this->Oferta->find('all', array('conditios'=>array('Oferta.subasta_id'=>$subasta_id), 'fields'=>array('DISTINCT User.email')));
		return $correos;
	}

	function diasEspera($subastaID = null) {
		$unaSubasta = $this->Subasta->read(null, $subastaID);
		return $unaSubasta['Subasta']['dias_espera'];
	}

	function enviarCorreoSubastaCancelada($correo = null, $nombre_subasta) {

		if($correo) {
			
			App::import('Vendor', 'MadMimi', array('file' =>'madmimi'.DS.'MadMimi.class.php'));
			App::import('Vendor', 'MadMimi', array('file' =>'madmimi'.DS.'Spyc.class.php'));
			
			$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));
			
			$options = array(
				'promotion_name' => 'subasta_cancelada',
				'recipients' => $correo,
				'subject' => 'Subasta Cancelada',
				'from' => 'no-reply@llevatelos.com'
			);
			
			$html_body =
				"<html xmlns=\"http://www.w3.org/1999/xhtml\">
				<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
					<title></title>
					<style type=\"text/css\">
						.txt {
							font-family: Arial, Helvetica, sans-serif;
							font-size: 14px;
						}
						.nombre {
							color: #666;
						}
						.rojo {
							color: #F00;
						}
						.verde {
							color: #9C0;
						}
						.peke {
							font-size: 12px;
						}
			
					</style>
				</head>
				<body>
					[[tracking_beacon]]
					<table summary=\"\" width=\"696\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>
							<td width=\"50\" rowspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//subasta_cancelada//rp01.jpg\" width=\"50\" height=\"525\" /></td>
							<td align=\"center\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//subasta_cancelada//sc03.jpg\" width=\"480\" height=\"270\" /></td>
							<td width=\"50\" rowspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//subasta_cancelada//rp02.jpg\" width=\"50\" height=\"525\" /></td>
						</tr>
						<tr>
							<td width=\"600\" valign=\"top\">
							<table summary=\"\" width=\"600\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">
								<tr>
									<td>
									<p class=\"txt\">
										Hola,
									</p>
									<p class=\"txt\">
										<span class=\"rojo\">Lo Sentimos</span>, la subasta $nombre_subasta en la que estabas
										<br />
										trabajando ha sido cancelada. Tus créditos serán reembolsados en máximo 24 horas.
										<br />
										Sigue trabajando con nosotros para atrapar tus sueños.
										<br />
										Revisa el listado de subastas actuales de llevatelos.com y escoge el próximo artículo
										<br />
										que puede ser tuyo.
									</p>
									<p class=\"txt\">
										<span class=\"nombre\">Hasta pronto.</span>
										<br />
										Equipo llevatelos.com - Atrapa tus sueños.
									</p></td>
								</tr>
							</table></td>
						</tr>
					</table>
				</body>
			</html>";
			
			$result = $mailer->SendHTML($options, $html_body);

			return;
		} else {
			return;
		}

	}

	function enviarCorreoSubastaGanada($subastaID = null) {
		
		App::import('Vendor', 'MadMimi', array('file' =>'madmimi'.DS.'MadMimi.class.php'));
		App::import('Vendor', 'MadMimi', array('file' =>'madmimi'.DS.'Spyc.class.php'));
		$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));

		if (!empty($subastaID)) {
			$subasta = $this->Subasta->read(null, $subastaID);
			$userID = $this->requestAction('/ofertas/obtenerUsuarioGanadorSubasta/' . $subastaID);
			$usuario = $this->requestAction('/users/getUsuario/' . $userID);

			// Enviar correo ganador
			//
			$options = array(
				'promotion_name' => 'te_lo_llevaste',
				'recipients' => $usuario['User']['email'],
				'subject' => '¡Te Lo Llevaste!',
				'from' => 'no-reply@llevatelos.com'
			);
			
			$nombre_subasta = $subasta['Subasta']['nombre'];
			$precio_subasta = $subasta['Subasta']['precio'];
			
			$html_body =
				"<html xmlns=\"http://www.w3.org/1999/xhtml\">
				<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
					<title></title>
					<style type=\"text/css\">
						.txt {
							font-family: Arial, Helvetica, sans-serif;
							font-size: 14px;
						}
						.nombre {
							color: #666;
						}
						.rojo {
							color: #F00;
						}
						.verde {
							color: #9C0;
						}
						.peke {
							font-size: 12px;
						}
			
					</style>
				</head>
				<body>
					[[tracking_beacon]]
					<table summary=\"\" width=\"700\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>
							<td width=\"50\" rowspan=\"4\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//te_lo_llevaste//rp01.jpg\" width=\"50\" height=\"525\" /></td>
							<td width=\"310\" height=\"165\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//te_lo_llevaste//rp02.jpg\" width=\"310\" height=\"165\" /></td>
							<td width=\"340\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//te_lo_llevaste//rp03.jpg\" width=\"340\" height=\"165\" /></td>
						</tr>
						<tr>
							<td height=\"75\" colspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//te_lo_llevaste//rp05.jpg\" width=\"340\" height=\"75\" /></td>
						</tr>
						<tr>
							<td height=\"205\" colspan=\"2\">
							<table summary=\"\" width=\"650\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">
								<tr>
									<td>
									<p class=\"txt\">
										<strong>Hola,</strong>
									</p>
									<p class=\"txt\">
										<span class=\"rojo\">¡Felicitaciones!</span><span class=\"txt\"> has logrado atrapar tu sueño de tener $nombre_subasta.
											<br />
											Para el envío del artículo remite tus datos completos a</span><span class=\"rojo\"> contacto@llevatelos.com</span><span class=\"txt\"> y recibirás unos
											<br />
											sencillos pasos que deberás seguir.
											<br />
											Ayuda a otros a atrapar sus sueños deja tu testimonio en</span><span class=\"rojo\"> testimoniales@llevatelos.com</span>
									</p>
									<p class=\"txt\">
										<strong>Hasta pronto.
										<br />
										<br />
										<span class=\"peke\">Equipo llevatelos.com - Atrapa tus sueños.</span></strong>
									</p></td>
								</tr>
							</table></td>
						</tr>
						<tr>
							<td height=\"80\" colspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//te_lo_llevaste//rp04.jpg\" width=\"650\" height=\"80\" /></td>
						</tr>
					</table>
				</body>
			</html>";
			
			$result = $mailer->SendHTML($options, $html_body);
				
			// Obtener correos ofertantes
			// Recorrer la lista ofertantes y enviar correos
			//
			$correos = $this->obtenerListaCorreoOfertas($subastaID);
				
			foreach ($correos as $key=>$correo) {
				
				$options = array(
					'promotion_name' => 'subasta_finalizada',
					'recipients' => $correo['User']['email'],
					'subject' => 'Subasta Finalizada',
					'from' => 'no-reply@llevatelos.com'
				);
				
				$html_body =
					"<html xmlns=\"http://www.w3.org/1999/xhtml\">
					<head>
						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
						<title>Documento sin título</title>
						<style type=\"text/css\">
							.txt {
								font-family: Arial, Helvetica, sans-serif;
								font-size: 14px;
							}
							.nombre {
								color: #666;
							}
							.rojo {
								color: #F00;
							}
							.verde {
								color: #9C0;
							}
							.peke {
								font-size: 12px;
							}
				
						</style>
					</head>
					<body>
						[[tracking_beacon]]
						<table summary=\"\" width=\"700\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
							<tr>
								<td width=\"50\" rowspan=\"4\" valign=\"top\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//subasta_finalizada//rp01.jpg\" width=\"50\" height=\"525\" /></td>
								<td width=\"310\" height=\"165\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//subasta_finalizada//rp02.jpg\" width=\"310\" height=\"165\" /></td>
								<td width=\"340\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//subasta_finalizada//rp03.jpg\" width=\"340\" height=\"165\" /></td>
							</tr>
							<tr>
								<td height=\"75\" colspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//subasta_finalizada//sf01.jpg\" width=\"380\" height=\"75\" /></td>
							</tr>
							<tr>
								<td height=\"205\" colspan=\"2\">
								<table summary=\"\" width=\"650\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">
									<tr>
										<td>
										<p class=\"txt\">
											<strong>Hola,</strong>
										</p>
										<p class=\"txt\">
											Te informamos que la subasta correspondiente a $nombre_subasta en la que estabas trabajando ya se ha cerrado.
											<br />
											El usuario ganador se la llevó por el increíble valor de <span class=\"rojo\">$$precio_subasta</span>
											<br />
											En tu perfil de usuario podrás comparar el último valor que ofertaste y te darás cuenta
											<br />
											que no estabas tan lejos de llevártelo. Revisa el listado de subastas actuales de llevatelos.com
											<br />
											y escoge el próximo artículo que puede ser tuyo.
											<br />
											Gracias por participar y sigue trabajando con nosotros para atrapar tus sueños.
										</p>
										<p class=\"txt\">
											No te desanimes, ingresa, participa y atrapa tus sueños.
										</p>
										<p class=\"txt\">
											<strong><span class=\"peke\">Equipo llevatelos.com - Atrapa tus sueños.</span></strong>
										</p></td>
									</tr>
								</table></td>
							</tr>
							<tr>
								<td height=\"80\" colspan=\"2\"><img alt=\"\" src=\"http://www.llevatelos.com//app//webroot//plantillas_correos//subasta_finalizada//rp04.jpg\" width=\"650\" height=\"80\" /></td>
							</tr>
						</table>
					</body>
				</html>";
				
				$result = $mailer->SendHTML($options, $html_body);

			}

			// Correos lista correos
			//
			$this->loadModel('ListaCorreo');
			$correos = $this->ListaCorreo->find('list');

			foreach ($correos as $correo) {

				$para = $correo;
				$asunto = 'Subasta Terminada!';
				$mensaje =	'La subasta: ' .
				$subasta['Subasta']['nombre'] .
							' ha terminado!';
					
				$cabeceras = 'From: webmaster@example.com' .
					"\r\n" . 
					'Reply-To: webmaster@example.com' . "\r\n" . 
					'X-Mailer: PHP/' . phpversion();

				if(mail($para, $asunto, $mensaje, $cabeceras)) {
					//$this->Session->setFlash(__('Datos enviados a su correo', true));
				} else {
					//$this->Session->setFlash(__('Datos no enviados a su correo, por favor intenta mas tarde', true));
				}

			}

		}
	}
  
  function reOrder(){
   /* 
      * Ordena las categorias se une con el widget de sortable
    * */
    foreach($this->data["Item"] as $id=>$posicion){
    $this->Subasta->id=$id;
     $this->Subasta->saveField("posicion_en_cola",$posicion);
    
    }
    
    echo "yes";
    Configure::write('debug', 0);   
    $this->autoRender = false;   
    exit(); 
  }
}
?>
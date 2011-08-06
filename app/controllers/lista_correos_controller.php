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
		App::import('Vendor', 'MadMimi', array('file' =>'madmimi'.DS.'Spyc.class.php'));
		
		foreach($correos as $correo) {
			
			/**
			 * username=YourMadMimiEmailAddress
			 * api_key=YourMadMimiApiKey
			 * promotion_name=Welcome to Acme Widgets
			 * recipients=Dave Hoover <dave@example.com>
			 * subject=Welcome to Acme Widgets
			 * bcc=admin@example.com
			 * from=no-reply@example.com
			 * reply_to=Nicholas Young <nicholas@example.com>
			 * body=--- \nname: Some YAML data\n
			
			$postData = array(
				'username' => Configure::read('madmimiEmail'),
				'api_key' => Configure::read('madmimiKey'),
				'promotion_name' => 'Prueba',
				'recipients' => $correo,
				'from' => 'no-reply@llevatelos.com'
			);
			
			$x = curl_init('https://api.madmimi.com/mailer');
			//curl_setopt($x, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			//curl_setopt($x, CURLOPT_HEADER, 0);
			curl_setopt($x, CURLOPT_POST, TRUE);
			//curl_setopt($x, CURLOPT_SSL_VERIFYPEER, FALSE);
			//curl_setopt($x, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($x, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($x, CURLOPT_RETURNTRANSFER, TRUE);
			debug($x);
			$data = curl_exec($x);
			curl_close($x);
			debug($data);
			 * 
			 */
			
			$mailer = new MadMimi(Configure::read('madmimiEmail'), Configure::read('madmimiKey'));
			
			$options = array(
				'promotion_name' => 'pruebas',
				'recipients' => $correo,
				'subject' => 'Prueba del API MadMimi',
				'from' => 'no-reply@llevatelos.com'
			);
			
			$nombre_subasta = 'Imaginatelo';
			
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
			
			debug($result);
			
		}
		
	}
	
}
?>
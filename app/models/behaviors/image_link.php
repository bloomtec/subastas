<?php 
class ImageLinkBehavior  extends ModelBehavior  {
	var $name = 'ImageLink';
	private $inUpdate=false;
	function rafterSave(&$Model,$created){
		if($this->inUpdate){
		$model=&$Model;
		$alias=$model->alias;
		$fields=$model->_schema;
		//debug($model);
			foreach($fields as $key=>$value){
				if($this->endsWith($key,"_image")){
					if(!isset($model->data[$alias][$key])){
						$model->data[$alias][$key]="default";
					}
					$image=Classregistry::init('Image')->find("first",array("conditions"=>array("model"=>$alias,"foreign_key"=>$model->id,"field_name"=>$key)));
					if($image){
						$image["Image"]["path"];
					}else{
						$image=array("Image"=>array(
							"model"=>$alias,
							"foreign_key"=>$model->id,
							"field_name"=>$key,
							"path"=>$model->data[$alias][$key],			
							)
						);						
					}
					
					Classregistry::init('Image')->save($image);
					$this->inUpdate=true;
					//debug($model->id);
					$model->saveField($key, Classregistry::init('Image')->getLastInsertID());
				}
			}
		}else{
			$this->inUpdate=false;
		}
		
		return true;
	}
	function beforeSave(&$Model){
	$model=&$Model;
	$alias=$model->alias;
	$fields=$model->_schema;
		foreach($fields as $key=>$value){
			if($this->endsWith($key,"_image")){
				if(!isset($model->data[$alias][$key])){
						$model->data[$alias][$key]="default_image";
				}
				
				$resultado = $model->query("select last_insert_id() from ".$model->useTable." LIMIT 1;");
				if(isset($resultado[0][0]["last_insert_id()"])){
					//Forma de saber cual es el ultimo id de una tabla
					$foreignkey=$resultado[0][0]["last_insert_id()"];
				}else{
					$foreignkey=1;
				}
			//Verificamos si alguna imagen de este modelo ya se encuentra guardada
				$ImageModel=Classregistry::init('Image');
				$image=$ImageModel->find("first",array(
							"conditions"=>array(
								"model"=>$alias,
								"foreign_key"=>$foreignkey,
								"field_name"=>$key)
							)
						);	
				if($image){
					$image["Image"]["path"];
				}else{
					$image=array("Image"=>array(
							"model"=>$alias,
							"foreign_key"=>$foreignkey,
							"field_name"=>$key,
							"path"=>$model->data[$alias][$key],			
							)
						);						
				}
				if($ImageModel->save($image)){
					if(!isset($image["Image"]["id"])){// si no esta el id es porque es creacion si esta el Id es porque es modificacion y no hay que cambiar el valor del campo
						$model->data[$alias][$key]=$ImageModel->getLastInsertID();
					}
				}else{
					return false;
				}			
			}
		}
		return true;
	}
	function afterFind(&$Model,$results,$primary){
		//debug(&$Model->alias);
		//debug($results);
		//debug($primary);
		return $results;
	}

function EndsWith($Haystack, $Needle){
    // Recommended version, using strpos
    return strrpos($Haystack, $Needle) === strlen($Haystack)-strlen($Needle);
}
}
?>
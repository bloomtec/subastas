<?php $config=$this->requestAction("/configs/config");?>
<?php $subastas=$this->requestAction("/subastas/entregadosIndex");?>

<h1 class="titulo-amarillo" style="color:white; background:url(../img/trama-verde.png) repeat-x scroll 0 0 transparent">Productos Entregados</h1>
<?php if (!empty($subastas)):?>
 <ul class="productos-entregados index" id="subastas-vendidas">
	 <?php $i=0;
	 		$last=1;
			$first=0;
	 ?>
	 <?php foreach ($subastas as $subasta):?>
	 <li <?php if($last++==4){ echo "class='last'"; $last=1;}?> <?php if($last==2) echo "class='first'"?>  id="<?php echo $subasta["Subasta"]["id"]; ?>" title="<?php echo $subasta["Subasta"]["nombre"]; ?>"> 
			 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
		 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
		 
	     <?php echo $this->Html->para("pvp","Precio Cial. $ ".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
	     <div  rel="<?php echo $subasta["Subasta"]["id"]; ?>">
	     <?php if(!$config["Config"]["congelado"]):?>
	     <p class="contador" id="contador<?php echo $subasta["Subasta"]["id"]?>">
			Finalizado
		 </p>
	
	     <?php endif;?>

	     <p class="precio" title="pesos colombianos"><?php echo "$ ".number_format($subasta["Subasta"]['precio'], 0, ' ', '.');?><p>
			<?php $ultimaOferta= $this->requestAction("/subastas/ultimaOferta/".$subasta["Subasta"]["id"]);?>
			<?php $ultimaOferta= $this->requestAction("/subastas/ultimaOferta/".$subasta["Subasta"]["id"]);?>
		<p class="ultimo-usuario" rel="<?php if($ultimaOferta) echo $ultimaOferta["Oferta"]["id"];?>">
			<?php if($ultimaOferta) echo "Se lo llevo ".$ultimaOferta["User"]["username"];?>
		 </p>
	     <?php 
	     	
	  
	     		echo $this->Html->link("Entregado",array("controller"=>"subastas","action"=>"ofertar",$subasta["Subasta"]['id']),array('class'=>'boton ofertar','rel'=>$subasta["Subasta"]['id']));
			
	     ?>
	 	<div>
	 </li>
	 <?php 
	 $i++;
	 endforeach; ?>
 </ul>
 <div style="clear:both"></div>
<?php endif; ?>
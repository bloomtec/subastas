<?php $config=$this->requestAction("/configs/config");?>
<?php echo $html->script("monitorear.js");?>
<?php if (!empty($subastas)):?>
 <ul class="subastas-activas index <?php if(!$config["Config"]["congelado"]) echo "activo"?>">
	 <?php $i=0;?>
	 <?php foreach ($subastas as $subasta):?>
	 <li <?php if($i%3==1) echo "class='centro'"?>  id="<?php echo $subasta["Subasta"]["id"]; ?>" title="<?php echo $subasta["Subasta"]["nombre"]; ?>"> 
		  <div class="fecha_vencimiento">
			 </div>
			 <div class="hora_servidor">
			 </div>
		 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
		 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
	     <?php echo $this->Html->para("pvp","Precio Cial. $ ".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
	     <div  rel="<?php echo $subasta["Subasta"]["id"]; ?>">
	     <?php if(!$config["Config"]["congelado"]):?>
	     <p class="contador" id="contador<?php echo $subasta["Subasta"]["id"]?>">
			--:--:--
		 </p>
	     <p class="pvp">Tiempo Para termnar la oferta</p>
	     <?php endif;?>
	     <?php if($config["Config"]["congelado"]):?>
	     	<br />
	     	<p class="pvp">La subasta se reanudara a las 8:00 am</p>
	     	<br />
	     <?php endif;?>
	     <p class="precio"><?php echo "$ ".number_format($subasta["Subasta"]['precio'], 0, ' ', '.');?><p>
			<?php $ultimaOferta= $this->requestAction("/subastas/ultimaOferta/".$subasta["Subasta"]["id"]);?>
		<p class="ultimo-usuario" rel="<?php if($ultimaOferta) echo $ultimaOferta["Oferta"]["id"];?>">
			<?php if($ultimaOferta) echo "Última oferta ".$ultimaOferta["User"]["username"];?>
		 </p>
		 <p class="pvp">Bonos</p>
		 <p class="bonos" rel="<?php if($ultimaOferta) echo $ultimaOferta["Oferta"]["id"];?>">
			
		 </p>
		 <p class="pvp">Creditos</p>
		 <p class="creditos" rel="<?php if($ultimaOferta) echo $ultimaOferta["Oferta"]["id"];?>">
			
		 </p>
	 	<div>
	 </li>
	 <?php 
	 $i++;
	 endforeach; ?>
 </ul>
 <div style="clear:both"></div>
<?php endif; ?>


<?php $proximasSubastas = $this->requestAction('/subastas/proximasSubastas'); ?>
<?php if (!empty($proximasSubastas)):?>
	<ul class="proximas-subastas">
		 <h1 class="titulo-amarillo">Próximas Ofertas<h1>
		 <?php $i=0;?>
		 <?php foreach ($proximasSubastas as $subasta):?>
		 <li <?php if($i%3==1) echo "class='centro'"?> rel="<?php echo $subasta["Subasta"]["id"]; ?>"> 
			 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
			 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
		     <?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
		    
		 </li>
		 <?php 
		 $i++;
		 endforeach; ?>
 	</ul>
 <div style="clear:both"></div>
<?php endif; ?>
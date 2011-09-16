<?php echo $this -> Html -> script("subastas.js"); ?>
<div id="left-content">
	 <?php echo $this->element("left");?>

</div>
<div id="right-content">
	<div class="corner">
	<h1 class="titulo-amarillo">Productos Ganados</h1>
	<?php if (!empty($subastas)):?>
 <ul class="subastas-activas" id="user-subastas">
	 <?php $i=0;?>
	 <?php foreach ($subastas as $subasta):?>
	<li <?php if($i%3==1) echo "class='centro'"?>  id="<?php echo $subasta["Subasta"]["id"]; ?>" title="<?php echo $subasta["Subasta"]["nombre"]; ?>"> 
		<div class="imagen">
			<?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200")); ?>
			<?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]); ?>
		</div>
		<div class="ofertas">
				<?php $ofertas=$this->requestAction("/ofertas/getOfertas/".$subasta["Subasta"]["id"]); ?>
				<?php foreach($ofertas as $oferta):?>
					<div <?php if($i==0) echo "class='actualizado nocufon'" ?> ><?php echo $oferta["Oferta"]["created"]?></div>
				<?php endforeach;?>
		</div>
		<div class="acciones-ofertas" rel="<?php echo $subasta["Subasta"]["id"]; ?>">
			 <?php echo $this->Html->para("pvp","PVP $ ".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
		      <?php if(false):?>
			     <p class="contador"  id="contador<?php echo $subasta["Subasta"]["id"]?>"></p>
			     <p class="pvp">Tiempo Para termnar la oferta</p>
			     <?php endif;?>
			     <?php if(false):?>
			     	<br />
			     	<p class="pvp">La subasta se reanudara a las 8:00 am</p>
			     	<br />
			     <?php endif;?>
			     <p class="precio"><?php echo "$ ".number_format($subasta["Subasta"]['precio'], 0, ' ', '.');?><p>
			     <p class="ultimo-usuario"> <p>
			     <?php 
			     	
						echo $this->Html->link("Entregado","#",array('class'=>'boton pausado'));
					?>
			    
		</div>
	 </li>
	 <?php 
	 $i++;
	 endforeach; ?>
 </ul>
 <div style="clear:both"></div>
<?php endif; ?>
<?php if(empty($subastas)): ?>
<div class="mensaje">
	No te has llevado ningún producto
</div>
<?php endif;?>
</div>
</div>
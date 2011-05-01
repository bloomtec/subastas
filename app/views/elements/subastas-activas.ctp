<?php $subastas=$this->requestAction("/subastas/subastasActivas");?>
<?php if (!empty($subastas)):?>
 <ul class="subastas-activas">
	 <?php $i=0;?>
	 <?php foreach ($subastas as $subasta):?>
	 <li> 
		<div class="imagen">
			<?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
			<?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>	
		</div> 
		<div class="ofertas">
			<ul class="ofertas">
				<?php $ofertas=$this->requestActions("/ofertas/getOfertas/".$subasta["Subasta"]["id"]);?>
				<?php foreach($ofertas as $oferta):?>
					<li><?php echo $oferta["Usert"]["username"]."-".$oferta["Oferta"]["created"]?></li>
				<?php endforeach;?>
			</ul>
		</div>
		<div class="acciones-ofertas">
			 <?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
		     <p class="contador">00</p>
		     <p class="precio">00<p>
		     <p class="ultimo-usuarior">user<p>
		     <?php echo $this->Html->link("¡Oferte ya!",array("controller"=>"subastas","action"=>"ofertar",$subasta["Subasta"]['id']),array('class'=>'boton')) ?>
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
	No ha realizado ninguna subasta
</div>
<?php endif;?>
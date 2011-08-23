<?php //debug($registrado)?>
<div id="left-content">
	<?php echo $this->element("seguridad");?>
	 <?php echo $this->element("ultimo-ganador");?>
	 <?php echo $this->element("proxima-oferta");?>
	 <?php echo $this->element("banner-lateral");?>
	 <?php echo $this->element("social");?>
	
</div>
<div id="right-content">
	<div class="WYSIWYG banner-home">
	   <?php 
	     echo $this->requestAction("/pages/bannerHome");
	   ?>
	   <div style="clear:both"></div>
	</div>
	<h1 class="titulo-amarillo">Ofertas Activas</h1>
	<?php echo $this->element("listado-subastas");?>
	 <div style="clear:both"></div>
</div>
<?php if(!$session->read("Auth.User.id")):?>
<script type="text/javascript">

$(function(){
var cookie=getCookie("mailing");
	if(cookie==undefined||cookie==null||cookie==""||cookie=="false"){
		$("#register-overlay").overlay({

		// custom top position
		/*top: 260,*/

		// some mask tweaks suitable for facebox-looking dialogs
		mask: {

			// you might also consider a "transparent" color for the mask
			color: '#fff',

			// load mask a little faster
			loadSpeed: 200,

			// very transparent
			opacity: 0.5
		},

		// disable this for modal dialog-type of overlays
		closeOnClick: false,

		// load it immediately after the construction
		load: true

	});
}
});
</script>
<?php endif;?>
		


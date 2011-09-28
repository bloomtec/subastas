<a href="/users/register" class="banner-productos" id="slider">
	<?php echo $html->image("slide-registro/1.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/2.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/3.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/4.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/5.png",array("width"=>200));?>
	<?php echo $html->image("slide-registro/6.png",array("width"=>200));?>
</a>
<script type="text/javascript">
$(function(){
	var fotos2=[];
	var j2=0;
	var fotosCargadas2=0;
	$("#slider img").load(function(){
		fotosCargadas2++;
		if(fotosCargadas2==6){
			$.each($("#slider img"), function(i2,val2) {
				fotos2[i2]=val2;
			});
			setInterval( function() {
				$("#slider img").fadeOut("slow");
				$(fotos2[j2]).fadeIn("slow");
				console.log(fotos2[j2]);
				j2++;
				if(j2==fotos2.length) j2=0;
			},5000);
		}
	});
		
		
		
	});

</script>
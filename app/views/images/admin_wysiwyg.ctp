<div id="fileBrowser">
	<div class="folders">
	 <?php // debug($path[0]);?>
	</div>
	<ul class="container">
	 	<?php foreach($folder[1] as $fileName):
			$fileParts=(pathinfo($fileName));
			switch($fileParts["extension"]){
				case "gif":
				case "jpg":
				case "png":
				case "ico":
				case "GIF":
				case "JPG":
				case "PMG":
				case "ICO":
				?>
				<li> 
	 				<?php echo $html->image($folderPath."/".$fileName,array("class"=>"preview"));?>
	 				<div class="info">
						<h2> <?php echo $fileName ?></h2>
						<div class="actions">
							<div class="delete"  rel="<?php echo $folderPath."/".$fileName?>">borrar</div>
							<div class="seleccionar"  rel="<?php echo $folderPath."/".$fileName?>">seleccionar</div>
						</div>
					</div>
				</li>
				<?php	
				//--------------				
				break;
				case "docx":
				case "doc":
				?>
				<li rel=<?php echo "/".$folderPath."/".$fileName?>> 
	 				<?php echo $html->image("word.png",array("class"=>"preview"));?>
	 				<div class="info">
						<h2> <?php echo $fileName ?></h2>
					</div>
				</li>
				<?php					
				break;
				//-------------
				case "xls":
				case "xlsx":
				?>
				<li rel=<?php echo $folderPath."/".$fileName?>> 
	 				<?php echo $html->image("excel.png",array("class"=>"preview"));?>
	 			</li>
				<?php
				break;
				//-----------
				case "ppt":
				case "pptx":
				?>
				<li rel=<?php echo $folderPath."/".$fileName?>> 
	 				<?php echo $html->image("power-point.png",array("class"=>"preview"));?>
	 			</li>
				<?php
				break;
				//-------------
				case "swf":
				?>
				<li rel=<?php echo $folderPath."/".$fileName?>> 
	 				<?php echo $html->image($folderPath."/".$fileName,array("class"=>"preview"));?>
	 				<div class="info">
						<h2> <?php echo $fileName ?></h2>
						<div class="actions">
							<div class="delete"  rel="<?php echo $folderPath."/".$fileName?>">borrar</div>
							<div class="seleccionar"  rel="<?php echo $folderPath."/".$fileName?>">seleccionar</div>
						</div>
					</div>
	 			</li>
				<?php
				break;
				//-------------
			}
	 		
	 	 endforeach;?>
	</ul>
<div style="clear:both;"></div>
</div>
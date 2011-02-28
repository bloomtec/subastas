<div id="developer-utilities">
	<ul>
		<li><?php echo $this->Html->link("Init CMS database",array("controller"=>"users","action"=>"init","admin"=>false)); ?></li>
		<li><?php echo $this->Html->link("Reset Users and ACL",array("controller"=>"users","action"=>"reset","admin"=>false)); ?></li>
	</ul>
</div>
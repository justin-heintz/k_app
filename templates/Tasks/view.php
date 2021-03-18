<div class="container">
	<div class="row">
		<div class="col col-md-1"></div>
		<div class="col col-md-2 text-center"><h5>Status</h5></div>
		<div class="col col-md-2 text-center"><h5>Title</h5></div>
		<div class="col col-md-2 text-center"><h5>Description</h5></div>
		<div class="col col-md-2 text-center"><h5>Start/End Date</h5></div>
		<div class="col col-md-1 text-center"><h5>Tasks</h5></div>
		<div class="col col-md-2 text-center"><h5>Manage</h5></div>
	</div>	
	<hr>
		<?PHP foreach ($groups as $group) {  
		$date = "";
		if(empty($group->start_date) || empty($group->end_date)){ $date = 'No Date Set';} 
		?>
		<div class="row">
			<div class="col col-md-1 "><?= $this->Html->image( '../'.$group->img, ['width' => '100%','height'=>'100%']); ?> </div>
			<div class="col col-md-2 text-center"><?= $group->status ?></div>
			<div class="col col-md-2 text-center"><?= $group->title ?></div>
			<div class="col col-md-2 text-center"><?= $group->description ?></div>
			<div class="col col-md-2 text-center"><?= $date ?></div>
			<div class="col col-md-1 text-center"><?= count( $group->tasks )  ?></div>
			<div class="col col-md-2 text-center">
				<a class="btn btn-primary" title="Edit Tasks" href="<?= $this->Url->build(["controller" => "tasks", "action" => "edit"]); ?>">Manage</a> <a class="btn btn-danger" title="Edit Tasks" href="<?= $this->Url->build(["controller" => "tasks", "action" => "edit"]); ?>">Remove</a>
			</div>
		</div>	
		<?PHP } ?>
</div>
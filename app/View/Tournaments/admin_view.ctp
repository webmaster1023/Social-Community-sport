<section class="content-header">
	<h1><?php echo __dbt('Tournament'); ?>
	  <small><?php echo __dbt('View Tournament Details'); ?></small>
	</h1>
	 <?php echo $this->element($elementFolder.'/breadcrumb'); ?>
</section>
<section class="content">
	<div class="row">
	  <div class="col-md-12">
		<div class="box">
			<div class="box-header">
			  <h3 class="box-title"></h3>
                          <a class="btn btn-warning pull-right" href="javascript:window.history.back();"><?php echo __dbt('Back'); ?></a>
			</div>
			<div class="box-body no-padding">
				<table class="table table-striped">
					<tbody>
						<tr>
						  <td><?php echo __dbt('Tournament Name'); ?></td>
						  <td><?php echo h($tournament['Tournament']['name']); ?></td>
						</tr>
						<tr>
						  <td><?php echo __dbt('Sport'); ?></td>
						  <td><?php echo $this->Html->link($tournament['Sport']['name'], array('controller' => 'sports', 'action' => 'view', base64_encode($tournament['Sport']['id']))); ?></td>
						</tr>
						<tr>
						  <td><?php echo __dbt('Description'); ?></td>
						  <td><?php echo h($tournament['Tournament']['description']); ?></td>
						</tr>
                                                <tr>
						  <td><?php echo __dbt('Status'); ?></td>
						  <td><?php echo h($tournament['Tournament']['status_name']); ?></td>
						</tr>
						<tr>
						  <td><?php echo __dbt('Created'); ?></td>
						  <td><?php echo h($tournament['Tournament']['created']); ?></td>
						</tr>
						<tr>
						  <td><?php echo __dbt('Modified'); ?></td>
						  <td><?php echo h($tournament['Tournament']['modified']); ?></td>
						</tr>
					
						
					</tbody>
				</table>
			</div>
		</div>	
	  </div>
	 </div>
</section>	  	
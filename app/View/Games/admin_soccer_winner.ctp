<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo __dbt('Predictions'); ?>
    <small><?php echo __dbt('Soccer prediction'); ?></small>
  </h1>
  <?php echo $this->element($elementFolder.'/breadcrumb'); ?>
  
</section>
<?php 

foreach($new as $soccer_option)
{
  $tournament[$soccer_option['Tournament']['id']]=$soccer_option['Tournament']['name'];
  $league[$soccer_option['League']['id']]=$soccer_option['League']['name'];
  $game[$soccer_option['SoccerPrediction']['game_day']]=$soccer_option['SoccerPrediction']['game_day'];
}

?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
	<div class="box">
		<div class="box-header">
		    <div class="UserAdminIndexForm">
			<div class="box-body">	
			   <div class="row">
			     <?php  echo $this->Form->create('SoccerPrediction', array('type' => 'get', 'url' => array('controller' => 'games', 'action' => 'soccerWinner', $this->params["prefix"] => true), "novalidate"=>"novalidate")); ?>
					    <?php echo "<div class='col-xs-3'>". $this->Form->input("SoccerPrediction.tournament_id", array("label"=>false, "placeholder"=>"Search by League", "div"=>false,'empty'=>'Select Tournament', 'options' => @$tournament,'class'=>"form-control"))."</div>"; ?>
					    <?php echo "<div class='col-xs-2'>". $this->Form->input("SoccerPrediction.league_id", array("label"=>false, "div"=>false,"placeholder"=>"Search by Game",'empty'=>'Select League', 'options' => @$league,'class'=>"form-control"))."</div>"; ?>
					    <?php echo "<div class='col-xs-2'>". $this->Form->input("SoccerPrediction.teams_gameday", array("label"=>false, "div"=>false,"placeholder"=>"Search by Game",'empty'=>'Select Day', 'options' => @$game,'class'=>"form-control"))."</div>"; ?>
					    
						<div class='col-xs-offset-4 admin-search-btn'>
						  <input type="submit" class="btn bg-olive margin" value="Search">	
						  <a href="<?php echo $this->here; ?>" class="btn btn-warning" ><?php echo __dbt("Reset"); ?></a>
						</div>	
			    <?php echo $this->Form->end(); ?>    
			   </div>
			</div>	   
		    </div>
		</div>	
		<!-- filters starts-->
		<div class="box-body">
			<table id="example" class="table table-striped">
				<thead>
					<tr>
							<th><?php echo $this->Paginator->sort('name'); ?></th>
							<th><?php echo $this->Paginator->sort('tournament_id'); ?></th>
							<th><?php echo $this->Paginator->sort('league_id'); ?></th>
							
							<th><?php echo $this->Paginator->sort('game_day'); ?></th>
							<th class="actions"><?php echo __dbt('Actions'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php  if(!empty($soccerwinnerdata_array)) {
				    
                                    foreach ($soccerwinnerdata_array as $soccers): 
									 foreach ($soccers as $soccer): 
									  ?>
					<tr>
						<td><?php echo $this->Html->link($soccer['User']['name'],  'javascript:void(0)',array('class'=>'viewprofile','title'=>'View profile','userId' =>base64_encode($soccer['User']['id']))); ?></td>
						<td>
							<?php echo $this->Html->link($soccer['Tournament']['name'], array('controller' => 'tournaments', 'action' => 'view', base64_encode($soccer['Tournament']['id']))); ?>
						</td>
						<td>
							<?php echo $this->Html->link($soccer['League']['name'], array('controller' => 'leagues', 'action' => 'view', base64_encode($soccer['League']['id']))); ?>
						</td>
						
						<td><?php echo h($soccer['SoccerPrediction']['game_day']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__dbt(''),  'javascript:void(0)',array('class'=>'fa fa-eye viewresult','title'=>'View Game','userId' 
						=>base64_encode($soccer['User']['id']),'gameDay' => base64_encode($soccer['SoccerPrediction']['game_day']))); ?>
							
						
                                                </td>
					</tr> 
                                <?php endforeach;
                                endforeach;} else { ?>
                                    <tr>    
                                        <td class="text-center" colspan="6"><?php echo __dbt('No result found.'); ?>&nbsp;</td>
                                    </tr>    
                                <?php } ?>        
				</tbody>
				</table>
				<div class="row">
					<div class="col-sm-5">
						<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
						</div>
					</div>
					<div class="col-sm-7">
						<?php echo $this->element('pagination',array('paging_action'=>$this->here));?>
					</div>
				</div>
			</div>
		
	</div>
    </div>
  </div>
</section>
<div class="bloger-modal">
    <div class="modal fade" id="putPrediction" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo __dbt('Prediction Details'); ?></h4>
                </div>
                <div class="modal-bodys">
            
			    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bloger-modal">
    <div class="modal fade" id="putPredictions" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo __dbt("User's Profile"); ?></h4>
                </div>
                <div class="modal-body">
            
			    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="/js/datatable/dataTables.bootstrap.min.css"/>
<script src="/js/datatable/jquery.dataTables.min.js"></script>
<script src="/js/datatable/dataTables.bootstrap.min.js"></script>
<script>

$(document).ready(function() {
   $('div#example_filter').hide();
   $('#example').DataTable( {
        "bPaginate": $('#example tbody tr').length>10,
        "pagingType": "full_numbers",
        "info":     false,
        "bFilter":false,
        "bLengthChange": false


    } );
} );



    $('.viewresult').click(function () {
        var user_Id = $(this).attr("userId");
        var game_day = $(this).attr("gameDay");
       
        var base_url = window.location.origin;
        $('.modal-bodys').load(base_url+'/'+'admin/games/soccerPredictionResult/' + user_Id +'/' +  game_day, function (result) {
            $('#putPrediction').modal({show: true});
        });

   
    });
     $('.viewprofile').click(function () {
        var user_Id = $(this).attr("userId");
        var base_url = window.location.origin;
        $('.modal-body').load(base_url+'/'+'admin/games/soccerWinnerprofile/' + user_Id, function (result) {
            $('#putPredictions').modal({show: true});
        });

   
    });
</script>

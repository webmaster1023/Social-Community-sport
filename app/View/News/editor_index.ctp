<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo __dbt('News'); ?>
    <small><?php echo __dbt('List News');?></small>
  </h1>
  <?php echo $this->element($elementFolder.'/breadcrumb'); ?>
  
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
	<div class="box">
		<div class="box-header">
		<!-- filters starts-->
		<div class="UserAdminIndexForm">
			<div class="box-body">	
			   <div class="row">
			     <?php echo $this->Form->create('News', array('type' => 'get', 'url' => array('controller' => 'editors', 'action' => 'index', $this->params["prefix"] => true,'class'=>"form-control"), "novalidate"=>"novalidate")); ?>
				<?php echo "<div class='col-xs-2'>". $this->Form->input("News.name", array("label"=>false, "placeholder"=>"Search by name", "div"=>false,'class'=>"form-control"))."</div>"; ?>
				<?php //echo "<div class='col-xs-2'>". $this->Form->input("News.news_type", array("label"=>false, "div"=>false, "placeholder"=>"Search by type",'class'=>"form-control"))."</div>"; ?>
				<?php echo "<div class='col-xs-3'>". $this->Form->input("News.foreign_key", array("type"=>"select", "empty"=>"-- sports --", "options"=>$sports, "label"=>false, "div"=>false,'class'=>"form-control"))."</div>"; ?>
				<?php echo "<div class='col-xs-2'>". $this->Form->input("News.status", array("type"=>"select", "empty"=>"--All Status--", "options"=>$status, "label"=>false, "div"=>false,'class'=>"form-control"))."</div>"; ?>
				<div class='col-xs-3 admin-search-btn'>
					<input type="submit" class="btn bg-olive margin" value="Search">	
					<a href="<?php echo $this->here; ?>" class="btn btn-warning" ><?php echo __dbt('Reset'); ?></a>
				</div>	
			    <?php echo $this->Form->end(); ?>
			   </div>
			</div>	   
		</div>
		</div>
		<div style="clear:both;"></div>
		<!-- filters ends-->
		<div class="box-body">
			<table id="example2" class="table table-striped">
				<thead>
					<tr>      
                                           <th><?php echo $this->Paginator->sort('name'); ?></th>
                                           <th style="width:40%"><?php echo $this->Paginator->sort('description'); ?></th>
                                           <th><?php echo $this->Paginator->sort('news_type'); ?></th>
                                           <th><?php echo $this->Paginator->sort('status'); ?></th>
                                           <th class="actions"><?php echo __dbt('Actions'); ?></th>
                                        </tr>
				</thead>
				<tbody>
				<?php if(!empty($news)) { 
                                        foreach ($news as $news): ?>
				<tr>
					<td><?php echo h($news['News']['name']); ?>&nbsp;</td>
					<td><?php if(strlen($news['News']['description'])>50){
						echo h(substr($news['News']['description'],0,50).'....');
					      }else{
						echo h($news['News']['description']);
					      } ?>&nbsp;</td>
					<td><?php //echo h($news['News']['news_type']);?></td>
					<td><?php echo h($news['News']['status_name']); ?>&nbsp;</td>
					<td class="actions">
                                            <?php echo $this->Html->link(__dbt(''), array('action' => 'view', base64_encode($news['News']['id'])),array('class'=>'fa fa-eye','title'=>'View News')); ?>
                                            <?php echo $this->Html->link(__dbt(''), array('action' => 'edit', base64_encode($news['News']['id'])),array('class'=>'fa fa-edit','title'=>'Edit News')); ?>
                                            <?php echo $this->Form->postLink(__dbt(''), array('action' => 'delete', base64_encode($news['News']['id'])),array('class'=>'fa fa-remove','title'=>'Delete News'), array(__dbt('Are you sure you want to delete this news ?'))); ?>
                                            <?php if($news['News']['top_news'] == 0){ ?>
                                            <a id="change-status_<?php echo $news['News']['id'];?>" data-uri="<?php echo base64_encode($news['News']['id'])?>" data-value="1" data-sport="<?php echo h($news['News']['foreign_key']);?>" href="javascript:void(0)" class='change-status fa fa-arrow-up' title='Set Top News'></a>
                                        `   <?php } else { ?>
                                            <a id="change-status_<?php echo $news['News']['id'];?>" data-uri="<?php echo base64_encode($news['News']['id'])?>" data-value="0" data-sport="<?php echo h($news['News']['foreign_key']);?>" href="javascript:void(0)" class='change-status fa fa-star' title='Set Normal News'></a>
                                            <?php } ?>
                                                </td>
                                       
				</tr>
                                <?php endforeach; } else {?>
                                <tr>    
                                    <td class="text-center" colspan="5"><?php echo __dbt('No result found.'); ?>&nbsp;</td>
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

<script>
$(document).on('click','.change-status',function(){
	var newsId = $(this).attr("data-uri");
        var value = $(this).attr("data-value");
        var sportId = $(this).attr("data-sport");
        var sid = $(this).attr('id');
       
  	var url = "<?php echo $this->Html->url(array("controller"=>"News", "action"=>"changeToTopNews", $this->params["prefix"] => true)); ?>/";
        $.post(url, {id:newsId,value:value,sportId:sportId}, function(data){
        if(data == 'saved')
                {
                   if(value == 1){ 
                    $('#'+sid).replaceWith('<a id="'+sid+'" data-uri="'+newsId+'"  data-value="0" data-sport="'+sportId+'" href="javascript:void(0)" class="change-status fa fa-star" title="Set Normal News"></a>');
                    } else {
                    $('#'+sid).replaceWith('<a id="'+sid+'" data-uri="'+newsId+'"  data-value="1" data-sport="'+sportId+'" href="javascript:void(0)" class="change-status fa fa-arrow-up" title="Set Top News"></a>');   
                    }
                    
                }  else if(data == 2)
                    {
                        alert('You cannot create more than 2 top news for a category.');
                    } else {
                        alert('News status not changed! Please, try again');
                        }
            
        });  
  
	
});
</script>
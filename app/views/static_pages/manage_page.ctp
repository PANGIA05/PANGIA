<?php ?>
<script type="text/javascript">
function activatePage(id, status){
	jQuery.ajax({
			type	: 'POST',
			async	: false,
			data	: {'data[StaticPage][id]':id, 'data[StaticPage][status]':status},
			url		: '<?php echo LIVE_SITE; ?>/static_pages/activatePage',
			success:function(data)
			{
				if(data == 1){
					src = '<img src="<?php echo LIVE_SITE; ?>/img/images/yes.png">';
				}else{
					src = '<img src="<?php echo LIVE_SITE; ?>/img/images/no.png">';
				}
				//jQuery("#cmdiv"+id).hide();
				$("#activatePageStatus"+id).html(src);
				//alert(url);

				//jQuery("#activateUserStatus"+id).html(data);
			}
		});
		return false;
}
</script>
<style>.submit{ display:none; }</style>
<div id="icon-mydetails" class="icon32"><br></div>
<h2 class="dash">
	Manage Page 
	<a class="button-new" href="<?php echo $this->webroot."static_pages/addPage"; ?>" title="Add page">Add New Page</a>
	
	<?php if(count($pages) > 0){ ?>
	<a id="removeAll" class="button-new" title="Remove" style="cursor:pointer">Remove Selected</a>
</h2>
<?php echo $this->Form->create('StaticPage',array(
											'url'=>'removePage',
											'style'=>'clear:none;',
											'id' => 'priceForm')); 
	echo $this->Form->input('idArr',array('id'=>'idArr','style'=>'display:none;','label'=>false));	?>
<?php echo $this->Form->end('Remove'); 
echo $this->Session->flash(); ?>
<br /><br />
    <?php
    echo '<div class="pagingDetails">'.$this->Paginator->counter(array(
    'format' => 'Page %page% of %pages%, showing %current% records out of
    %count% total, starting on record %start%, ending on %end%'
    )).'</div>';
    ?>
<div id="pagination">
<?php
      echo $paginator->prev('<< Previous',array('id'=>'prev','class'=>'roundButtons')); 
      echo $paginator->numbers(array('separator'=>'-')); 
      echo $paginator->next('Next >>',array('id'=>'next','class'=>'roundButtons'));
?>
</div>
<?php
if(isset($this->params['named']['page']) && $this->params['named']['page'] > 1){
	$pageNo = 10 * $this->params['named']['page'] - 10;
}else{
	$pageNo = 0;
}
?>
<table width="100%" class="myTable">
	<tr>
		<th class="centeralign" width="3%">
			<?php echo $this->Form->checkbox('selectAll',array('id'=>'selectall', 'style' => 'float : none;')); ?>
		</th>
		<th class="centeralign" width="6%">S.No.</th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Page Title', 'page_title'); ?></th>
		<th class="centeralign" width="13%">Preview</th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Status', 'status'); ?></th>
	</tr>
	<?php 
	if(count($pages) > 0){ 
		$index = 1; 
		foreach($pages as $detail){//pr($detail); 
			$alias='/'.$detail['StaticPage']['alias'];
			//pr($alias);
			//Router::connect('/about_us', array('controller' => 'static', 'action' => 'index'));		
	
			$Id=$detail['StaticPage']['id'];
			 
			if($detail['StaticPage']['status'] == 1){
				$statusu = $html->link('<span id="activatePageStatus'.$Id.'">'.$html->image("/images/yes.png").'</span>', array('controller'=>'static_pages', 'action' => 'activatePage', $Id.'/0'), array('escape' => false, 'onclick' => 'javascript:return activatePage('.$Id.', 0);'));
				
				}
			else{
				
				$statusu = $html->link('<span id="activatePageStatus'.$Id.'">'.$html->image("/images/no.png").'</span>', array('controller'=>'static_pages', 'action' => 'activatePage', $Id.'/1', ), array('escape' => false, 'onclick' => 'javascript:return activatePage('.$Id.', 1);'));
				
				} 			
	?>
			<tr>
				<td class="centeralign" width="10%">
					<?php echo $this->Form->checkbox('check',array('class'=>'case','id'=>$detail['StaticPage']['id'], 'style' => 'float:none;'));?>
				</td>
				<td class="centeralign" ><?php echo $index + $pageNo; ?></td>
				<td class="centeralign" ><?php  $detail['StaticPage']['page_title']; ?>
				
				<?php echo $html->link($detail['StaticPage']['page_title'], array('controller'=>'static_pages', 'action' => 'editPage', $Id.'/0'), array('escape' => false, 'title' => 'Edit Page')); ?>
				 </td>
				 
				<td class="centeralign" ><?php echo $html->link('Preview', LIVE_SITE.'/'.$detail['StaticPage']['alias'], array('escape' => false,'target'=>'blank'));?></td>
				<td class="centeralign"><?php echo $statusu; ?></td> 
				</tr> 
	<?php	
		$index += 1;
		} 
	} 
	?>
</table>

			

<div id="pagination">
<?php
      echo $paginator->prev('<< Previous',array('id'=>'prev','class'=>'roundButtons')); 
      echo $paginator->numbers(array('separator'=>'-')); 
      echo $paginator->next('Next >>',array('id'=>'next','class'=>'roundButtons'));
?>
</div>
<br/>
<?php }else{ echo "</h2>";
	echo "<h2 align='center'>No Pages Found</h2>";
	}
?>

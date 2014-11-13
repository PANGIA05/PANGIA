<?php
echo    $this->Html->script('fckeditor/fckeditor');

?> 
<div id="icon-mydetails" class="icon32"><br></div>
<h2 class="dash">Add New Page <?php echo $html->link('back', array('controller'=>'static_pages', 'action' => 'managePage'), array('escape' => false,'class'=>'button-new')); ?></h2>
<table class="newtable">
	<?php echo $this->Form->create('StaticPage',array('url'=>'addPage/',  "enctype" => "multipart/form-data")); ?>	
	<tr>
		<td>Page Title* : </td>
		<td><?php echo $this->Form->input('page_title',array('label'=>false)); ?></td>
	</tr>
	
	<tr>
		<td>Alias : </td>
		<td><?php echo $this->Form->input('alias',array('label'=>false)); ?></td>
	</tr>


	<tr>
		<td>Page Description* : </td>
		<td><?php 
		/*  echo $cksource->create('StaticPage');
          echo $cksource->ckeditor('page_description', array('textarea'=>'description','label'=>false));*/
		echo $this->Form->input('page_description',array('label'=>false,'id'=>'PageDescription','type'=>'textarea'));
   echo $this->Fck->load('PageDescription','600','250');



         /* $config['toolbar'] = array(
		  array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
		  array( 'Image', 'Link', 'Unlink', 'Anchor' )
		  );
		  $events['instanceReady'] = 'function (ev) {
          alert("Loaded: " + ev.editor.name);
      }';

			echo $cksource->ckeditor('page_description', array('value'=>'It works!', 'config'=>$config, 'events'=>$events));*/
			//echo $cksource->end(); ?>
		</td>
	</tr>
	<tr>
		<td>Meta Keywords</td>
		<td><?php echo $this->Form->input('meta_keyword', array('type' => 'textarea','label'=>false));	?></td>
	</tr>
	<tr>
		<td>Meta Description</td>
		<td><?php echo $this->Form->input('meta_description', array('type' => 'textarea','label'=>false)); ?></td>
	</tr>
	<tr>
		<td>Status : </td>
		<td><?php echo $form->input('status',array('type'=>'select', 'width' => 100, 'options'=>$statusArray, 'label' => '')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->end('Save'); ?></td>
		<td>&nbsp;</td>
	</tr>
</table>
<!--
  <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>
                
                        <script>
                
                            CKEDITOR.replace( 'editor1' );
                
                        </script>
-->

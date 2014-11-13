<?php //pr($userDesce);
$data=$this->requestAction('users/articlecategory/');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


<h2 class="dash">Edit Article <?php echo $html->link('back', array('controller'=>'admins', 'action' => 'manageArticle'), array('escape' => false,'class'=>'button-new')); ?></h2>
<table class="newtable">
	<?php echo $this->Form->create('Article',array('url'=>'editArticle/'.$id,'onsubmit' => 'return Checkform();', "enctype" => "multipart/form-data")); ?>	
	<tr>
		<td>Fundraiser goal* : </td>
		<td><?php echo $this->Form->input('amount',array('label'=>false,'id'=>'amount')); ?></td>
	</tr>
	<tr>
		<td>Title* : </td>
		<td><?php echo $this->Form->input('title',array('label'=>false,'id'=>'title')); ?></td>
	
	</tr>
<!--
	<tr>
		<td>Zip Code* : </td>
		<td><?php 
		//~ if($userDesce['Article']['author']=="admin")
		//~ {
			//~ $zip = $userDesce['Admin']['zip'];
		//~ }
		//~ else
		//~ {
			//~ $zip = $userDesce['User']['zip'];
		//~ }
		//~ 
		//~ echo $this->Form->input('zip',array('label'=>false,'id'=>'zip','vlaue'=>$zip)); ?></td>
	
	</tr>
-->
	<tr>
		<td>Category*: </td>
		<td><?php echo $this->Form->input('category', array('id'=>'category','label'=>false,'options' => $data)); ?></td>
	
	</tr>
	<tr>
		<td>Short Summary:* : </td>
		<td><?php 
		echo $this->Form->input('summary',array('label'=>false,'id'=>'summary','type'=>'textarea')); ?>
		</td>
	</tr>
	<tr>
		<td>Description:* : </td>
		<td><?php 
		echo $this->Form->input('description',array('label'=>false,'id'=>'description','type'=>'textarea'));
		?>
		</td>
	</tr>
	
	<tr>
		<td>Image : </td>
		<td><?php echo $form->input('image',array("type" => "file", "label" => false)); ?></td>
	</tr>
	<?php if($userDesce['Article']['totaldonation']>=$userDesce['Article']['amount'])
			{ ?>
					<tr>
	<td>Related Press : </td>
		<td><?php echo $form->input('press',array("type" => "text", "label" => false)); ?></td>
	</tr>
		<?php	}
			else
			{
				echo "";
			}

	?>

	<tr>
		<td>Status : </td>
		<td><?php echo $form->input('status',array('type'=>'select', 'width' => 100, 'options'=>$statusArray, 'label' => '')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->end('Update'); ?></td>
		<td>&nbsp;</td>
	</tr>
</table>
<script>

function Checkform()
{
	
	var mamount = document.getElementById('amount').value;
	var amount= mamount.trim();
	amount = amount.replace(/\s{2,}/g, ' ');
	document.getElementById('amount').value=amount;
	if(amount=='')
	{
		alert('Enter the amount.');
		document.getElementById('amount').focus();
		return false;
	}else {
		var filter = /^[0-9-+]+$/;
		if (!filter.test(amount) == true) {
			alert('Amount should be Numeric only.');
			document.getElementById('amount').focus();
			return false;
		} 
	}
		
	var mtitle = document.getElementById('title').value;
	var title= mtitle.trim();
	title = title.replace(/\s{2,}/g, ' ');
	document.getElementById('title').value=title;
	if(title=='')
	{
		alert('Enter the title.');
		document.getElementById('title').focus();
		return false;
	}
	
	var dcategory = document.getElementById('category').value;
	var category= dcategory.trim();
	category = category.replace(/\s{2,}/g, ' ');
	document.getElementById('category').value=category;
	if(category=='')
	{
		alert('Select the category.');
		document.getElementById('category').focus();
		$('#category').addClass("redclass");
		return false;
	}
	var asummary = document.getElementById('summary').value;
	var summary= asummary.trim();
	summary = summary.replace(/\s{2,}/g, ' ');
	document.getElementById('summary').value=summary;
	if(summary=='')
	{
		alert('Enter the Summary.');
		document.getElementById('summary').focus();
		return false;
	}
	var dics = document.getElementById('description').value;
	var description= dics.trim();
	description = description.replace(/\s{2,}/g, ' ');
	document.getElementById('description').value=description;
	if(description=='')
	{
		alert('Enter the Description.');
		document.getElementById('description').focus();
		return false;
	}		

	var imge = document.getElementById('image').value;
	if(imge=='')
	{
		alert('Please select image.');
		document.getElementById('image').focus();
		return false;

		var ext = $('#chekcimg').val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{		
			alert('Invalid File Extension Choose Like gif,png,jpg,jpeg');
			document.getElementById('image').focus();
			return false;
		} 	
	} else {

		var ext = $('#image').val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{		
			alert('Invalid File Extension Choose Like gif,png,jpg,jpeg');
			document.getElementById('image').focus();
			return false;
		} 	

	}
}
</script>


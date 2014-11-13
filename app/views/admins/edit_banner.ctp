<?php ?>
<style>
.dollar_sign
{
float:left;
margin:3px;
}

div.input
{
float:left;
}
</style>

<div id="icon-mydetails" class="icon32"><br></div>
<h2 class="dash">Edit <?php  echo $html->link('back', array('controller'=>'admins', 'action' => 'manageBanners'), array('escape' => false,'class'=>'button-new'));  ?> </h2>
<table class="newtable">
	<?php 
		echo $this->Form->create('Banner',array('onsubmit' => 'return Checkform();','url'=>'editBanner/'.$id, "enctype" => "multipart/form-data")); ?>	
	<tr>
		<td>Select category  : </td>
		<td><?php $option = array(1=>'Slider Banner'); 
	echo $form->input('category',array('id'=>'category','type'=>'select','options'=>$option,'selected'=>$bdata['Banner']['category'],'div'=>false,'label'=>false)); ?>   
</td>
	</tr>
	<tr>
		<td>Title : </td>
		<td><?php echo $this->Form->input('title',array('id'=>'title','label'=>false,'value'=>$bdata['Banner']['title'])); ?></td>
	</tr>
	<tr>
		<td>Content : </td>
		<td><?php echo $this->Form->input('content',array('id'=>'contents','label'=>false,'value'=>$bdata['Banner']['content'])); ?></td>
	</tr>
	
	<tr>
		<td>Image : </td>
		<td><?php echo $form->input('image',array('id'=>'image',"type" => "file", 'label' => false,'value'=>$bdata['Banner']['image'])); ?></td>
	</tr>
	<tr>
		<td>Order : </td>
		<td><?php echo $this->Form->input('order',array('id'=>'order','label'=>false,'value'=>$bdata['Banner']['order'])); ?></td>
	</tr>
	
	<tr>
		<td><?php echo $this->Form->end('Update'); ?></td>
		<td>&nbsp;</td>
	</tr>
</table>
<script>

function Checkform()
{//alert('here');
	
	var dcategory = document.getElementById('category').value;
	var category= dcategory.trim();
	category = category.replace(/\s{2,}/g, ' ');
	document.getElementById('category').value=category;
	if(category=='')
	{
		alert('Select the category.');
		document.getElementById('category').focus();
		return false;
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
	var mcontents = document.getElementById('contents').value;
	var contents= mcontents.trim();
	contents = contents.replace(/\s{2,}/g, ' ');
	document.getElementById('contents').value=contents;
	if(contents=='')
	{
		alert('Enter the contents.');
		document.getElementById('contents').focus();
		return false;
	}
	
	var imge = document.getElementById('image').value;
	if(imge!=''){

		var ext = $('#image').val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{		
			alert('Invalid File Extension Choose Like gif,png,jpg,jpeg');
			document.getElementById('image').focus();
			return false;
		}
		var size = document.getElementById('image').files[0].size;
		//alert(size);
		if(size > 1024000)
		{
			alert('Image size should not be more then 1 MB.');
			document.getElementById('image').focus();
			$('#image').addClass("redclass");
			return false;
		}

	}
	var morder = document.getElementById('order').value;
	var order= morder.trim();
	order = order.replace(/\s{2,}/g, ' ');
	document.getElementById('order').value=order;
	if(order=='')
	{
		alert('Enter the order.');
		document.getElementById('order').focus();
		return false;
	}else {
		var filter = /^[0-9-+]+$/;
		if (!filter.test(order) == true) {
			alert('Order should be Numeric only.');
			document.getElementById('order').focus();
			return false;
		} 
	}
		
	
	
	
	
}
</script>

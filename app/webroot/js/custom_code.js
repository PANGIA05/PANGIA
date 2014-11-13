/* Get the root path */

var pathArray = window.location.href.split( '/' );
var protocol = pathArray[0];
var host = pathArray[2];
var hosts = pathArray[3];
var url = protocol + '//' + host +'/' + hosts ;
	


$(function(){
$(".search").keyup(function() 
{ 
//alert(url);
var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;
if(inputSearch!='')
{
      $.ajax({
      type: "POST",
      url: url+"/users/searchforuser",
      data: dataString,
      cache: false,
      success: function(html)
      {
      $("#divResult").html(html).show();
      }
      });
}return false;    
});

});
$(function(){
$(".searchuser").keyup(function() 
{ 
//alert(url);
var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;
if(inputSearch!='')
{
      $.ajax({
      type: "POST",
      url: url+"/admins/searchforadminuser",
      data: dataString,
      cache: false,
      success: function(html)
      {
      $("#divResult").html(html).show();
      }
      });
}return false;    
});

});
$(function(){
$(".searchzip").keyup(function() 
{ 
//alert(url);
var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;
if(inputSearch!='')
{
      $.ajax({
      type: "POST",
      url: url+"/static/zipnamesearch",
      data: dataString,
      cache: false,
      success: function(html)
      {
      $("#divResult").html(html).show();
      }
      });
}return false;    
});

});

$(function(){


});

$(function(){
$(".searchtitle").keyup(function() 
{ 
//alert(url);
var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;
if(inputSearch!='')
{
      $.ajax({
      type: "POST",
      url: url+"/static/titlesearch",
      data: dataString,
      cache: false,
      success: function(html)
      {
      $("#divResultTitle").html(html).show();
      }
      });
}return false;    
});

});
$(function(){
$(".searchbyzip").keyup(function() 
{ 
//alert('url');
var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;
if(inputSearch!='')
{
      $.ajax({
      type: "POST",
      url: url+"/static/zipsearch",
      data: dataString,
      cache: false,
      success: function(html)
      {
      $("#divResultZip").html(html).show();
      }
      });
}return false;    
});

});$(function(){
$(".searchbycategory").keyup(function() 
{ 
//alert(url);
var inputSearch = $(this).val();
var dataString = 'searchword='+ inputSearch;
if(inputSearch!='')
{
      $.ajax({
      type: "POST",
      url: url+"/static/categorysearch",
      data: dataString,
      cache: false,
      success: function(html)
      {
      $("#divResultCategory").html(html).show();
      }
      });
}return false;    
});

});
/* Js for Photo section as well as Create album and Image detail page */
				
			/* Submit Create album box */
			  function Subfiles()
					{
				//var check=$('#imgtag').val();
				
				if(( !$('#current-album').val() ) && (!$('#albumname').val())) { 
					alert('Please write a album name');
					return false
				}
				 if(!$('.imgpresent')['0'])
				{
						alert('Please select any image');
						return false;
					}
				else
				{
				document.getElementById('movepics').submit();
				}
			}
	
			
		function setAlb(id)
			{
			var id =id.split("_");
			var ids=id[1];
			var r = confirm('Are you sure you want to delete the album ?');
					if (r == true) {
						$.ajax({
							type: "POST",
							url: url+"/photos/delalbum/"+ids,
							success: function(res)
							{
								if(res==0)
								   {
								  $('.albbum').hide(); 
								  $('.remove_'+ids).hide(); 
								  $('#imgdeleted').show();
								    setTimeout(function(){
								       $('#imgdeleted').hide();
								      $('.albbum').show(); 
								 

								   // window.location.reload(true);

								  }, 3000);
								     
								     
								  } else {
										alert('Something went wrong here !');
									  }
							}	
							
							}); 

					} else {
			
				return false;
				}

	  		  }
	


     /* Image detail page use only */
	function setVal(id)
		{
			var id =id.split("_");
			var ids=id[1];
			
			var r = confirm('Are you sure you want to delete the image ?');
					if (r == true) {
						$.ajax({
							type: "POST",
							url: url+"/photos/delimage/",
							data: { id:ids }
							})
							.done(function( res ) {
						    if(res==0)
					  		 {
							   
								$('.albbum').hide(); 
								$('.remove_'+ids).hide(); 
								  $('#imgdeleted').show();
								    setTimeout(function(){
								       $('#imgdeleted').hide();
								      $('.albbum').show(); 
								 

								   // window.location.reload(true);

								  }, 3000);
							   							   							   
				 		    } else {				
						   
							 	 alert('Something Went wrong here !');
						  
						  		}
							});
			
						    } else {
			
							return false;
							}

	    }

	
	
				/* Designer custom  code for notification section */
	
						$(function() {
								var pull 		= $('#pull');
									mainMenu 		= $('#main-nav ul');
									menuHeight	= mainMenu.height();

								$(pull).on('click', function(e) {
									e.preventDefault();
									mainMenu.slideToggle();
								});

								$(window).resize(function(){
									var w = $(window).width();
									if(w > 320 && mainMenu.is(':hidden')) {
										mainMenu.removeAttr('style');
									}
								});
								
								/* Notification Bar */
						$('.nfs-icon i').click(function(e){
						e.stopPropagation()
							if($('#nfs-main').is(':visible')){
								$('#nfs-main').hide();
								$('.nfs-icon i').removeClass('img-icon-bellBlue');
							} else{			
								$('#nfs-main').show();
								$('.nfs-icon i').addClass('img-icon-bellBlue');
							}
						});
						
						
						
						$(window).click(function(){
							if($('#nfs-main').is(':visible')){
								$('#nfs-main').hide();	
								$('.nfs-icon i').removeClass('img-icon-bellBlue');
							}
							
							if($('.rs-links').is(':visible')){
								$('.rs-links').hide();	
							}
							
						})
						
						$('#nfs-main').click(function(e){e.stopPropagation()})
						
						/* Boxes equalisation  
						function boxesEqual(){
						var leftHeight = $('#left-sec').height()
						var rightHeight = $('#right-sec').height()
						if($(window).width() >= 768){
						if($(rightHeight) >= $(leftHeight)){
							$('#left-sec').height(rightHeight - 20)
						} else{
							$('#right-sec').height(leftHeight + 20)
						}
						} else{
							$('#left-sec').height("auto");
							$('#right-sec').height("auto");
						}
						}; 
						$(document).ready(boxesEqual);
						$(window).resize(boxesEqual); */ 
						
						function boxesEqual(){
						  var leftHeight = $('#left-sec').height();
						  var rightHeight = $('#right-sec').height();
						  if($(window).width() >= 768){
							if(leftHeight <= rightHeight){
								$('#left-sec').height(rightHeight - 20)
							} else {
								$('#right-sec').height(leftHeight + 20)
							}
						  } else{
							  $('#left-sec').height("auto");
							  $('#right-sec').height("auto");
						  }
						}
						
						$(document).ready(boxesEqual);
						$(window).resize(boxesEqual);
						
						/* Fluid image */
						var imgWid = $('.fluid-image img').width()
						var imgHeight = $('.fluid-image img').height()
						if($(imgWid)  >= $(imgHeight)){
							$('.fluid-image img').width("100%")
						} else{
							$('.fluid-image img').height("100%")
						}	
						
					});
							
					

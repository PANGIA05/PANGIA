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
	
	/* Report Show/hide */
	$('.rs-open-btn').click(function(e){
		e.stopPropagation();
		if($('.rs-links').is(':visible')){
			$('.rs-links').hide();
		} else{
			$('.rs-links').show();
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
		
/* IE Specific */
		
if (old_ie){
	 $('#main-nav ul li').last().css("float", "none")
	 $('#main-nav ul li').last().css("overflow", "hidden")
	
	 $(".at-box:nth-child(1)").css("background-color", "#4254da")
	 $(".at-box:nth-child(2)").css("background-color", "#865bb3")
	 $(".at-box:nth-child(3)").css("background-color", "#f1b000")
	 $(".at-box:nth-child(4)").css("background-color", "#303030")
	 $(".at-box:nth-child(5)").css("background-color", "#e00073")
	 $(".at-box:nth-child(6)").css("background-color", "#303030")
	 $(".at-box:nth-child(7)").css("background-color", "#ff5a00")
	 $(".at-box:nth-child(8)").css("background-color", "#a45197")
     $(".at-box:nth-child(4n+4)").css("margin-right", 0);
	 $("#three-column .with-photo:nth-child(3n+3)").css("margin-right", 0);
	 
	$('[placeholder]').focus(function() {
         var input = $(this);
         if (input.val() == input.attr('placeholder')) {
            input.val('');
            input.removeClass('placeholder');
        }
    }).blur(function() {
    var input = $(this);
    if (input.val() == '' || input.val() == input.attr('placeholder')) {
        input.addClass('placeholder');
        input.val(input.attr('placeholder'));
    }
}).blur();


$('[placeholder]').parents('form').submit(function() {
  $(this).find('[placeholder]').each(function() {
    var input = $(this);
    if (input.val() == input.attr('placeholder')) {
      input.val('');
    }
  })
}); 

$("#s-content .sf-row:last-child").css("border-bottom", 0)

}
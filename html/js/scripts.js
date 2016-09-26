// JavaScript Document

jQuery(document).ready(function($) {          

	//------>  Start Slider
	$('#banner-slide').bjqs({
		height        : 225,
		width         : 816,
		showcontrols  : false,
		responsive    : true,
		randomstart   : true
	});
	
	$( "#tabs" ).tabs();
	
	$(".ShowHideMenu").click( function(){
		$(".Navigation").toggleClass("CloseNavigation");
		});
		
	
          
});





$(document).ready(function() {
	$('.menu_trigger').click(function() {
		$('.main_nav2').slideUp(function(){
			$('.main_nav').slideToggle();
		});
	});
	$('.ctas a').click(function() {
		$('.main_nav').slideUp(function(){
			$('.main_nav2').slideToggle();
		});
	});
	$('.play_btn').click(function() {
		$('.video_overlay').fadeIn();
	});
	$('.close_vid').click(function() {
		$('.video_overlay').fadeOut();
	});
	//menu trigger end
	$('.bxslider').bxSlider({
	  hideControlOnEnd: true,
	  speed: 2000,
	  pagerCustom: '#bx-pager',
	  auto: true,
	  controls:false
	});
	//slider ends
	$('ul.grid_gallery li a img').click(function() {
			$('.image_overlay').fadeIn();
            var src = $(this).attr('src').replace('.png', 'large.png');
            $('#largeImage').attr('src', src).show();
      });
	$('.close_imgoverlay').click(function() {
		$('.image_overlay').fadeOut();
	});
	$('.prof_trigger').click(function() {
		$(this).removeClass('active');
		$('.second').slideToggle('fast',function(){
			$('.first').slideToggle('fast', function(){
				$('.dropper').slideToggle('fast');
			});
		});
	});
	//trigger banner
	$('.custom-upload input[type=file]').change(function(){
	    $(this).next().find('input').val($(this).val());
	});
	//file upload
	$("select").change(function () { 
	   var str = ""; 
	   str = $(this).find(":selected").text(); 
	   $(".out").text(str); 
	}).trigger('change');
	//select box
	$("#content div.tabs_hide").hide(); // Initially hide all content
    $("#tabs li:first").attr("id","current"); // Activate first tab
    $("#content div.tabs_hide:first").fadeIn(); // Show first tab content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();        
        $("#content div.tabs_hide").hide(); //Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('title')).fadeIn(); // Show content for current tab
    });
    //tabs 
    $( ".social-hover-flyout" ).hover(
	  function() {
	    $( '.social-list').animate({width:'157px'});
	  }, function() {
	    $( '.social-list' ).animate({width:0});
	  }
	);
	//social media hover
	$('.bxslider2').bxSlider({
	  auto: true,
	  autoControls: false,
	  pause: 5000,
	  slideMargin: 0,
	  pager:false,
	  nextSelector: '.next_slide',
  	  prevSelector: '.prev_slide',
  	  nextText: '',
  	  prevText: ''
	});
});
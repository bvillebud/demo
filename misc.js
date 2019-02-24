jQuery(document).ready(function($) {

    //contact form success or failure
	$("body").on("my-contact-sent-ok", function($contactForm){
		$('.sentOrFail').css({'background': 'rgba(0, 128, 0, 0.9)'}).fadeIn();
		$('.sentOrFail .success').show();
		setTimeout(function(){
			$('.sentOrFail').fadeOut();
			$('.sentOrFail .success').hide();
		}, 4000);
	});

	$('.footer').removeClass('has-fg-bg');

	//*** lazy load page images ***
	$('.lazy').Lazy({
		scrollDirection: 'both',
		effect: 'fadeIn',
		visibleOnly: true,
		onError: function(element) {
			console.log('error loading ' + element.data('src'));
		}
	});

	var showing = 0; //not showing by default

//*** Scroll to Top ***
	$(window).scroll(function() {
	    if ($(this).scrollTop() >= 50) {        
	    // If page is scrolled more than 50px
	      if( showing == 0 ){
	          showing = 1;
	          $('#return-to-top').animate({ right: '+=120' });    // Fade in the arrow
	      }
	    } else {
	       if( showing == 1){
	         showing = 0;
	        $('#return-to-top').animate({ right: '-=120px' });   // Else fade out the arrow
	       }
	    }
	});

	$('#return-to-top').click(function() {      // When arrow is clicked
	    $('body,html').animate({
	        scrollTop : 0                       // Scroll to top of body
	    }, 500);
	});

	$('nav > ul > li > a').not('.parent').hover(function(e) {
		$(this).stop().animate({ 'padding-top': '30px' });
	}, function(e){
		$(this).stop().animate({ 'padding-top': '10px' });
	});


	$('.page_main').click(function(){
		if ( $('.nav_wrapper').hasClass('show') ) {
			$('#nav-icon2').toggleClass('open');
			$('.nav_wrapper').toggleClass('show');
		}
	});

//*** Logo spinner ***
	var rotate_interval;
	var angle = 0;
	$('.spinner_hover').hover(
		function(){
			var spinner_img = $(this).next('.spinner_btn');
			angle = parseInt(spinner_img.attr('id'));
			rotate_interval=setInterval(function(){
				angle+=3;
				spinner_img.css('-webkit-transform','rotate('+angle+'deg)').attr('id', angle);
				spinner_img.css('-moz-transform','rotate('+angle+'deg)').attr('id', angle);
				spinner_img.css('-ms-transform','rotate('+angle+'deg)').attr('id', angle);
				spinner_img.css('-o-transform','rotate('+angle+'deg)').attr('id', angle);
				spinner_img.css('transform','rotate('+angle+'deg)').attr('id', angle);
			},50); //setInterval
		},
		function(){
			angle = parseInt($(this).next('.spinner_btn').attr('id'));
			function find_angle_deg(angle){
				if(angle > 360){
					angle -= 360;
					return find_angle_deg(angle);
				}
				else return angle;
			}
			angle = find_angle_deg(angle);
			$(this).next('.spinner_btn').attr('id', angle);

			clearInterval(rotate_interval);
		}
	);

});
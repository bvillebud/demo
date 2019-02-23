//jQuery is required to run this code
jQuery(document).ready(function($) {

	// var screenSize = $( window ).width();
	
    $( "#tabs" ).tabs(); //jQuery UI tabs
	
	if( $("#tabbed-content").length ) {
		$('.sticky-header').width( $('#tabbed-content').width() ); //on load
		$( window ).resize(function() {
			//$( "body" ).prepend( "<div>" + $( window ).width() + "</div>" );
			$('.sticky-header').css('width', $('#tabbed-content').css('width') );
		});
	
		$( window ).scroll(function() {
			var sticky = $('#tabbed-content').offset();
			var tabbedHeight = $('#tabbed-content').height() + (sticky.top - 100);
			if (window.pageYOffset >= sticky.top && window.pageYOffset < tabbedHeight ) {
				$('.ui-tabs-panel:visible .sticky-header').css('visibility', 'visible');
			} 
			else {
				$('.ui-tabs-panel:visible .sticky-header').css('visibility', 'hidden');
			}
		});
	}//tabbed content page
	
	$('ul#mega-menu-menu-1 li').removeClass('mega-menu-flyout').addClass('mega-menu-megamenu');
	$('ul.mega-sub-menu li').removeClass('mega-menu-columns-1-of-8');
	
	$('.mega-sub-menu > li > a').unbind('click'); 
	//allow menu landing pages to be clicked on mobile
});
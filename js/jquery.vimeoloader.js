/* 
    jquery.vimeoloader.js
    =-=-=-=-=-=-=-=-=-=-=
    This jQuery file is used to support the VimeoLoader for MODX add-on
*/

$(document).ready(function(){
	var vidwrapper = $('#featuredVideoWrapper');
	
	$('.video-loader').click(function(){
		
		if(!($(this).hasClass('current-video'))) {
		
		var id = $(this).attr('id');
		var vidstring = '<iframe src="http://player.vimeo.com/video/'+id+'?title=0&amp;byline=0&amp;portrait=0" width="675" height="380" frameborder="0"></iframe>'
		
		vidwrapper.html(vidstring);
		$('.current-video').removeClass('current-video');
		$(this).addClass('current-video')
		
		// move the "now playing" tag
		var flag = $('.current-tag');
		$('.current-tag').remove();
		
		$(this).closest('.video-loader').prepend(flag);
		}
	
	});
});
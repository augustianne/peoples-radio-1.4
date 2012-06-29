(function($){
	$.fn.vote = function(options){
		return $(this).each(function(){
			$(this).unbind('click').bind('click', function(){
				var obj = $(this);
				$.ajax({
					url: '/main/vote',
					data: { id: obj.attr('data-id') },
					dataType: 'json',
					success: function(data){
						obj.parent('li').remove();
					}
				});                     
				return false;
			});
		});
	}   

	$.fn.page_update = function(options){   
		var settings = $.extend({ url: 'main/update', container: '#this' }, options);
		return $(this).each(function(){
			var obj = $(this);              
			var u = function(obj){
				$.ajax({
					url: settings.url,
					type: 'POST',
					success: function(data){  
						$(settings.container).html(data);
						$('.vote').vote(); 
					}
				});	
			}

			setInterval(u, 10000);
		});
	}   
	
	$(function(){
		$('.vote').vote(); 
		$('#vote_queue').page_update( { url: '/main/updateVoteQueue', container: '#vote_queue' } );
		$('#community').page_update( { url: '/main/updatePlaylist', container: '#community' } );
	});
})(jQuery);
(function($){
	$.fn.vote = function(options){
		return $(this).each(function(){
			$(this).unbind('click').bind('click', function(){
				var obj = $(this);
				var l = new Image();
				l.src = '/images/icon-loader.gif';
				
				$.ajax({
					url: '/main/vote',
					data: { id: obj.attr('data-id'), channel: obj.attr('data-channel') },
					dataType: 'json',
					beforeSend: function(){
						obj.html('<img src="'+l.src+'" width="20" />');
					},
					success: function(data){
						if(data.success)
							obj.parent('li').remove();
						if(!data.hasVotingRights)
							$('.vote').hide();
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
					data: { channel: obj.attr('data-channel') },
					type: 'POST',
					success: function(data){  
						$(settings.container).html(data);
						$('.vote').vote(); 
					}
				});	
			}

			setInterval(u(obj), 10000);
		});
	}   
	
	$(function(){
		$('.vote').vote(); 
		$('#vote_queue').page_update( { url: '/main/updateVoteQueue', container: '#vote_queue' } );
		$('#community').page_update( { url: '/main/updatePlaylist', container: '#community' } );
	});
})(jQuery);
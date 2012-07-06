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
		var settings = $.extend({ url: 'main/update', container: '#this', update_type: 'override'}, options);
		return $(this).each(function(){
			var obj = $(this);              
			var u = function(){
				$.ajax({
					url: settings.url,
					data: { channel: obj.attr('data-channel') },
					type: 'POST',
					success: function(data){  
						if(settings.update_type == 'override'){
							$(settings.container).html(data);
						}else if(settings.update_type == 'append'){
							$(settings.container).append(data);
						}
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
		$('#community').page_update( { url: '/main/updatePlaylist', container: '#community ul' } );
		$('#cover_art').page_update( { url: '/main/updateCoverArt', container: '#cover_art' } );
		$('#listeners').page_update( { url: '/main/updateListeners', container: '#listeners' } );

		$("#create-room-button").click(function(){
			$("#create-room-modal").reveal();
		});

		$("#change-room-button").click(function(){
			$("#change-room-modal").reveal();
			return false;
		});

		$("#create-room-form").submit(function(){
			var postUrl = $(this).attr('action');
			alert(postUrl);
			$.ajax({
				url: postUrl,
				data: $(this).serialize(),
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){},
				success: function(data){
					alert(data.success);
				}
			});
			return false;
		});

	});


})(jQuery);
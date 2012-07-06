<?php use_helper('MPD'); ?>

<div id="sidebar" class="grid_4">
	<div class="side">
		<article class="que clear">
			<div class="radio">
				<!-- Put Player Here -->                  
				<div id="cover_art">
					<?php include_partial('main/coverArt', $vars); ?>
				</div>
				<audio controls="controls" autoplay="autoplay" class="player">
                  <source src="<?php echo $channel->getServer(); ?>" type="audio/mpeg" />
                </audio>        
			</div>
			<h3>Playlist</h3>                                            

			<div id="community" data-channel="<?php echo $channelId; ?>">
				<ul>
					<?php include_component('main', 'playlist', array('channelId' => $channelId)); ?>
				</ul>
			</div>
		</article>
	</div>
</div>
<?php use_helper('MPD'); ?>
<img src="/uploads/assets/cover/<?php echo mpd_get_current_track_art($channel->getPort()); ?>" border="0" align="left" class="fl mr10">
<div class="atr">
	<span>Now Playing</span>
	<h3><?php echo mpd_get_current_track_info($channel->getPort(), 'title'); ?>
		<em><small class="mr5">by</small> <?php echo mpd_get_current_track_info($channel->getPort(), 'artist'); ?></em>
		<em><?php echo mpd_get_current_track_info($channel->getPort(), 'album'); ?></em>
	</h3>
</div>
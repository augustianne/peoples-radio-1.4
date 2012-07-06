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
                  <source src="http://www.icecast-streaming.com.local:8000/<?php echo $channelId; ?>" type="audio/mpeg" />
                </audio>
			</div>
			<h3>Playlist</h3>                                            
			
			<div id="community" data-channel="<?php echo $channelId; ?>">
				<ul>
				<?php include_component('main', 'playlist', array('channelId' => $channelId)); ?>
				</ul>
			</div>
		</article>
		<!-- <article class="blg">
			<h3>People's News</h3>
			<ul>
				<li>
					<a href="#">Lorem ipsum</a>
					<p>Mauris in leo nisl, quis varius felis. Donec suscipit tempor convallis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
				</li>
				<li>
					<a href="#">Lorem ipsum</a>
					<p>Mauris in leo nisl, quis varius felis. Donec suscipit tempor convallis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
				</li>
			</ul>
		</article> -->
	</div>
</div>
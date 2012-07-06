<div id="sidebar">
	<div class="side">
		<article class="sts">
			<img src="/images/headphone.png" border="0" alt=" " class="fl mr5">
			<p><span>20356</span> are Currently Listening!</p>
		</article>
		<article class="que clear">
			<div class="radio">
				<!-- Put Player Here -->
				<img src="/images/album/mon.jpg" border="0" align="left" class="fl mr10">
				<div class="atr">
					<span>Now Playing</span>
					<h3>Lets Get Loud
						<em><small class="mr5">by</small> Augustianne Laurenne Barreta</em>
						<em>Album Name</em>
					</h3>
				</div>                     
				<audio controls="controls" autoplay="autoplay" class="player">
                  <source src="http://www.icecast-streaming.com.local:8181/<?php echo $room; ?>" type="audio/mpeg" />
                </audio>
			</div>
			<h3>Playlist</h3> 
			<div id="community">  
				<?php include_component('main','playlist', array('channelId' => $channelId)); ?>
			</div>
		</article>
		<article class="blg">
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
		</article>
	</div>
</div>
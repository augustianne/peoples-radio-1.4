<div id="container" class="grid_8">
	<ul class="sml bd">
		<li class="room">A Room Title</li>
		<li class="user">1020 Listeners</li>
		<li class="last"><a href="#">Change Channel</a></li>
	</ul>
	<div class="liquid bd">
		<article class="que">
			<h2>Vote three Songs for the next Queue! :))</h2>
			<div id="vote_queue" data-channel="<?php echo $channelId; ?>">
				<?php include_partial('main/list', array('pager' => $pager, 'hasVotingRights' => $hasVotingRights, 'channel' => $channel)); ?>
			</div>
		</article>
	</div> 
</div>
<?php include_partial('main/sidebar', array('channelId' => $channelId, 'channel' => $channel)); ?>
<div id="chat"> 
	<div class="cht">
		<ul>
			<li>
				<p><a href="#">Janvan Valleramos</a> pls vote for Justin Beiber boyfriend song pls pls pls <3</p>
			</li>
			<li>
				<p><a href="#">Andamon A. Abilar</a> me too i wub justin so much!!!!</p>
			</li>
			<li class="frm">
				<textarea></textarea><input type="submit" value="Send" class="mt10"/>     				
			</li>
		</ul>
	</div>
</div>

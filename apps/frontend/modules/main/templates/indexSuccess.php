<div id="container" class="grid_8">
	<ul class="sml bd">
		<li class="room"><?php echo $channel->getName(); ?></li>
		<li class="user" id="listeners"><?php include_partial('main/listeners', array('channel' => $channel)); ?></li>
		<li class="last"><a href="" id="change-room-button">Change Channel</a></li>
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
<div id="change-room-modal" class="reveal-modal">
	<?php include_component('main','selectChannels', array('channel' => $channel)); ?>
</div>                                          

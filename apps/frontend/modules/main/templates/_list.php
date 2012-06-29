<ul>
	<?php foreach($pager->getResults() as $iList): ?>
		<li>
			<span class="fl"><img src="/images/timer.png" border="0" alt="Duration:" class="fl mr5"> <?php echo $iList->getTime(); ?> <img src="/images/song.png" border="0" alt="Song:" class="fr"> </span>
			<h4><?php echo $iList->getName(); ?> <em><small class="mr5">by</small> <?php echo $iList->getArtist(); ?></em></h4>
			<a id="vote" data-id="<?php echo $iList->getId(); ?>" href="#" class="fr vote">vote this song</a>
		</li>
   	<?php endforeach; ?>
</ul>

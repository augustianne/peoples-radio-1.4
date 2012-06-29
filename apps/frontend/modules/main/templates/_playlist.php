<ul>
	<?php foreach($pager->getResults() as $iList): ?>
		<li>
			<span class="fl"><img src="/images/timer.png" border="0" alt="Duration: <?php echo $iList->getTime(); ?>" class="fl mr5"> <?php echo $iList->getTime(); ?> <img src="/images/song.png" border="0" alt="Song: <?php echo $iList->getName(); ?>" class="fr"></span><h4><?php echo $iList->getName(); ?> <em><small class="mr5">by</small> <?php echo $iList->getArtist(); ?></em></h4>

		</li>
   	<?php endforeach; ?>
</ul>

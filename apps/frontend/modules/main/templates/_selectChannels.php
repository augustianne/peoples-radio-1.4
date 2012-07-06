<h2>Select a Room!</h2>
<hr class="carved" />
<ul name="changeChannel">
	<?php foreach($pager->getResults() as $iChannel): ?>
		<li>
			<a href="<?php echo url_for($iChannel->getUrl()); ?>"><?php echo $iChannel->getName(); ?></a>
		</li>
	<?php endforeach; ?>
</ul>
<a class="close-reveal-modal">&#215;</a>
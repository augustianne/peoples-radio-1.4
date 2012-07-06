<div id="create-room-modal" class="reveal-modal">
    <h2>Create a Room!</h2>
    <hr class="carved" />
    <form id="create-room-form" action="<?php echo url_for('create-channel') ?>" method="post">
    	<label>Enter Room Name:</label>
    	<input type="text" name="channel" size="88"/>
    	<input type="submit" value="SUBMIT" />
    </form>
    <a class="close-reveal-modal">&#215;</a>
</div>
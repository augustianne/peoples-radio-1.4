<div id="create-room-modal" class="reveal-modal">
    <h2>Create a Room!</h2>
    <form id="create-room-form" action="<?php echo url_for('create-channel') ?>" method="post" class="frm">
    	<label>Enter Room Name:</label>
    	<input type="text" name="channel" size="83" class="text"/>
    	<input type="submit" value="Submit" class="button create fr"/>
    </form>
    <a class="close-reveal-modal">&#215;</a>
</div>
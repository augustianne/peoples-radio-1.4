<?php
	
	// add track to playlist
	function mpd_add_track($track, $port){               
		system("mpc -p $port add ".escapeshellarg($track));
	}
	
	function mpd_get_current_track($port){
		system("mpc -p $port current", $current);
		return $current;
	}
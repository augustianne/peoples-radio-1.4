<?php
	
	// add track to playlist
	function mpd_add_track($track, $port){               
		shell_exec("mpc -p $port add ".escapeshellarg($track));
	}
	
	function mpd_get_current_track($port){
		$current = shell_exec("mpc -p $port current");
		return $current;
	}
	
	function mpd_get_current_track_info($port, $info){
		$tag = shell_exec("mpc -p $port current -f %$info%");
		return $tag;
	}                                       
	
	function mpd_get_current_track_art($port){                                           
		$title = mpd_get_current_track_info($port, "title");
		$title = trim($title);

		$files = sfFinder::type('file') 
			->relative()
			->name("$title.*")
			->in(sfConfig::get('sf_upload_dir')."/assets/cover/");

		return $files[0];
	}
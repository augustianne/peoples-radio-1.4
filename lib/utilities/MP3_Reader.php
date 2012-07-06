<?php

require_once dirname(__FILE__).'/getid3/getid3.php';

class MP3_Reader {

	public static function readMp3($dir){                      
	    $result = array();

	    // Read the current directory
	    $d = dir($dir);

		$reader = new getID3();
	    // Loop through all the files in the current directory:
	    while (false !== ($file = $d->read())){
	        // Skip '.' and '..'
	        if (($file == '.') || ($file == '..')) continue;

	        // If this is a directory, then recursively call it
	        if(is_dir("{$dir}/{$file}")){ 
				self::readMp3("{$dir}/{$file}"); 
			}else{
	            // It's a mp3 file so read the tags
	            if(strtolower(substr($file, strlen($file) - 3, 3)) == "mp3"){   
					$reader->option_tag_id3v1 = false;
					$reader->analyze("{$dir}/{$file}");

					$trackInfo = $reader->info['tags']['id3v2'];

					if (isset($reader->info['id3v2']['APIC'][0]['data'])) {
					    $cover = $reader->info['id3v2']['APIC'][0]['data'];
					} elseif (isset($reader->info['id3v2']['PIC'][0]['data'])) {
					    $cover = $reader->info['id3v2']['PIC'][0]['data'];
					} else {
					    $cover = null;
					}
					if (isset($reader->info['id3v2']['APIC'][0]['image_mime'])) {
					    $mimetype = $reader->info['id3v2']['APIC'][0]['image_mime'];
					} else {
					    $mimetype = 'image/jpeg'; // or null; depends on your needs
					}

					$result[] = array(
						'filename' => $reader->info['filename'],
						'name' => $trackInfo['title'][0],
						'artist' => $trackInfo['artist'][0],
						'genre' => $trackInfo['genre'][0],
						'length' => $reader->info['playtime_string'],
						'cover' => $cover,
						'extension' => self::getExtension($mimetype)
					);    
	            }
	        }
	    }

	    return $result;
	}
	
	public static function getExtension($mimeType){
		switch($mimeType){
			case 'image/jpeg':
				return 'jpg';
			case 'image/png':
				return 'png';
			case 'image/gif':
				return 'gif';
		}
	}
	
}
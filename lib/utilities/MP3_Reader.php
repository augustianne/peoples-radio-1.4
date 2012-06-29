<?php

class MP3_Reader {

	public static function readMp3($dir)
	{
	    static $result = array();
	    static $i = 0;

	    $tag_string = "";

	    $mp3 = &new MP3_Id();

	    // Tags supported by the MP3_Id class
	    $tags = array(
	                  "name", "artists", "album",
	                  "year", "comment", "track",
	                  "genre", "genreno"
	                  );


	    // Read the current directory
		var_dump($dir);
	    $d = dir($dir);
		var_dump($d);
	    // Loop through all the files in the current directory:
	    while (false !== ($file = $d->read()))
	    {
	        // Skip '.' and '..'
	        if (($file == '.') || ($file == '..'))
	        {
	            continue;
	        }

	        // If this is a directory, then recursively call it
	        if (is_dir("{$dir}/{$file}"))
	        {
	            self::readMp3("{$dir}/{$file}");
	        }
	        else
	        {
	            // It's a mp3 file so read the tags
	            if(strtolower(substr($file, strlen($file) - 3, 3)) == "mp3") 
	            {
	                $data = $mp3->read("{$dir}/{$file}");

	                // OOPs, some error occured, just save the filename
	                if (PEAR::isError($data))
	                { 
	                    $result[$i]['filename'] = $file;
	                    $result[$i]['directory'] = $dir;
	                }
	                else
	                {
	                    $result[$i]['filename'] = $file;
	                    $result[$i]['directory'] = $dir;

	                    // Read all the tags of the particular file
	                    foreach($tags as $tag)
	                    {
	                        $result[$i][$tag] = $mp3->getTag($tag);
	                    }
	                }
	                $i++;
	            }
	        }
	    }

	    return $result;
	}
	
}
<?php

require_once dirname(__FILE__).'/getid3/getid3.php';
require_once dirname(__FILE__).'/getid3/write.php';

class MP3_Writer {

	public static function writeDbId($filename, $value){
		$getID3 = new getID3;
		$getID3->setOption(array('encoding' => 'UTF-8'));

		$tagwriter = new getid3_writetags();
		$tagwriter->filename = $filename;

		$tagwriter->tagformats = array('id3v2.3');

		// set various options (optional)
		$tagwriter->overwrite_tags = true;

		$tagwriter->tag_encoding   = 'UTF-8';
		$tagwriter->remove_other_tags = false;
		
		$getID3->analyze($filename);
		$trackInfo = $getID3->info['tags']['id3v2'];
		// populate data array
		$TagData = $trackInfo;
		$TagData['comment'] = array($value);
		$tagwriter->tag_data = $TagData;

		// write tags
		if ($tagwriter->WriteTags()) {
			echo 'Successfully wrote tags<br>';
			if (!empty($tagwriter->warnings)) {
				echo 'There were some warnings:<br>'.implode('<br><br>', $tagwriter->warnings);
			}
		} else {
			echo 'Failed to write tags!<br>'.implode('<br><br>', $tagwriter->errors);
		}

	}
	
}
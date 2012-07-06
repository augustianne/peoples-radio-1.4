<?php 

class Slugify
{
	private static $instance = null;
	public static function getInstance()
	{
		if( is_null(self::$instance) )
		{
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	private $dashChars = array("$","&","+",",","/",":",";","=","?","@","<",">","{","}","|",'\\','^','~','[',']','%',' ',',','(',')','.');
	//private $removeChars = array('`','"',"'",);
	private $removeChars = array('#','`','"',"'",'!');

	private function __construct(){}

	public function format($string=''){
		$string = strtolower(trim($string));
		$string = str_replace($this->removeChars,'',$string);
		$string = str_replace($this->dashChars,'-', $string);
		$string = preg_replace('/--*/','-',$string);
		return preg_replace('/-$/','',$string);
	}

	public function getSlug($text = '')
	{
		return str_replace(' ', '-', $text);
	}

	public function getSlugText($text = '')
	{
		return str_replace('-', ' ', $text);
	}
}
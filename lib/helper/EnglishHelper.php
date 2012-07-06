<?php
/**
* This file is part of the GoAbroadNetwork lib package.
* (c) 2011 GoAbroad Green Tech Team<green.tech@goabroad.com>
* 
*/

/**
* Handles grammatical issues with strings
*
*
*
* @package lib
* @subpackage helper
* @author  Augustianne Laurenne Barreta
* @version dated: February 3, 2011 11:19:26
*/

/**
 * Retrieves possesive form of the text
 *
 * @param string Text
 * @return string Possessive form of the text
 * @author Czarisse Daphne
 * @version dated: May 24, 2011 11:41:24
 * @access public
 */
function to_possessive($text){
	return "s" == substr($text, -1) ? $text."'" : $text."'s";
}				


/**
 * Retrieves singular or plural form of the text
 *
 * @param string
 * @param int 
 * @return string Formatted string in singular/plural form
 * @author Czarisse Daphne
 * @version dated: May 24, 2011 11:41:24
 * @access public
 */
function quantify_noun($noun, $quantity=1){
	if($quantity > 1){
		// add es to words ending in s, x, ch, sh
		$noun = preg_replace('/(\w*)(s|ch|x|sh)$/', '$0es', $noun);
		// change y to i and add es
		$noun = preg_replace('/(\w*)y$/', '$1ies', $noun);
		// words ending in is change to es
		$noun = preg_replace('/(\w*)(is)$/', '$1es', $noun);
		// words ending in z add zes
		$noun = preg_replace('/(\w*)(z)$/', '$0zes', $noun);
	}
	
	return ("s" == substr($noun, -1) || 1 >= $quantity) ? $noun : "{$noun}s";
}

/**
 * Retrieves singular or plural form of the text
 *
 * @param string
 * @param int 
 * @param string (optional) - alternate word to be used if quantity is 0
 * @return string Formatted string in singular/plural form
 * @author Augustianne Laurenne Barreta
 * @version dated: April 26 2012, 2011 11:41:24
 * @access public
 */
function format_plural($noun, $quantity=1, $emptySub=null){
	$qtyText = $quantity;
	
	if(!is_null($emptySub) && $quantity < 1){
		$qtyText = $emptySub;
	}
	
	return "{$qtyText} ".quantify_noun($noun, $quantity);
}

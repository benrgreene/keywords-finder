<?php

class Text_Cleaner {
	// What the other classes/functions should call.
	// This will create a standardized version of text
	public static function clean ($text) {
		$to_return = strtolower($text);
		$to_return = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $to_return);
		$to_return = trim($to_return);
		// remove double spacing
		while (strpos($to_return, '  ')) {
			$to_return = str_replace('  ', ' ', $to_return);
		}
		return $to_return;
	}

	// Get text turned into an array of keywords.
	public static function get_keywords( $text ) {
		$dict  = Ignore_Dict::get_instance();
		$array = explode( ' ', $text );
		$array = $dict::strip_words($array);
		return $array;
	}
}
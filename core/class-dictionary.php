<?php

/**
 *	Dictionary for tracking words that should be ignored
 *  Also will strip ignored words from a text
 */

class Ignore_Dict {

	public static $instance;
	public static $to_ignore;

	private function __construct ($file) {
		$to_ignore = array();
		$f_pointer = fopen($file, 'r');
		// if we couldn't open, just return
		if (!$f_pointer) { return; }
		// assume that each line is it's own word
		while (false !== ($line = fgets($f_pointer))) {
			self::$to_ignore[] = trim($line);
		}
		self::$to_ignore = array_unique(self::$to_ignore);
		fclose($f_pointer);
	}

	public static function get_instance ($file=false) {
		if ( null == self::$instance) {
			self::$instance = new Ignore_Dict($file);
		}
		return self::$instance;
	}

	// strip all words from the ignore set from a text array
	public static function strip_words ($text_array) {
		for ($i = 0; $i < count($text_array); $i++) {
			$word = $text_array[$i];
			if (in_array(self::$to_ignore, $word)) {
				unset($text_array[$i]);
				$i--;
			}
		}
		return $text_array;
	}
}
<?php

/**
 *	Dictionary for tracking words that should be ignored
 *  Also will strip ignored words from a text
 *
 *  Should only be used by the Cleaner class
 */

class Ignore_Dict {

	public static $instance;
	public static $to_ignore;

	private function __construct () { }

	public static function get_instance () {
		if ( null == self::$instance) {
			self::$instance = new Ignore_Dict();
		}
		return self::$instance;
	}

	// build up our ignored set of words
	public static function set_ignores ($file) {
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

	// strip all words from the ignore set from a text array
	public static function strip_words ($text_array) {
		for ($i = 0; $i < count($text_array); $i++) {
			$word = $text_array[$i];
			if (in_array($word, self::$to_ignore)) {
				unset($text_array[$i]);
			}
		}
		return $text_array;
	}

	// adds ignored words to the ignore file
	public function append_to_ignores ($file, $word) {
		$file_handle = fopen($file, 'a');
		fwrite($file_handle, "\n" . $word);
		fclose($file_handle);
	}
}
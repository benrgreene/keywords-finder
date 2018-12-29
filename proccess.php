<?php

// require all our core files
include 'core/class-cleaner.php';
include 'core/class-dictionary.php';
include 'core/class-tracker.php';

class Text_Proccessor {
	public function __construct() {
		// setup our dictionary
		$this->file_location     = sprintf('%s/dictionaries/ignores.txt', __DIR__);
		$ignore_dict = Ignore_Dict::get_instance();
		$ignore_dict::set_ignores($this->file_location);
		// tracker that contains our master list of keywords
		$this->tracker     = new Word_Tracker();
	}

	// add the keywords of a message to the tracker
	public function add_message ($message, $timestamp=false) {
		if (!$timestamp) {
			$timestamp = time();
		}
		$this->tracker->add_keywords($message, $timestamp);
	}

	// returns a list of the keywords sorted by frequency
	public function get_keywords ($timeframe=false) {
		return $this->tracker->get_keywords();
	}

	public function ignore_word ($word) {
		$ignore_dict = Ignore_Dict::get_instance();
		$ignore_dict->append_to_ignores($this->file_location, $word);
	}
}
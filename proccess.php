<?php

// require all our core files
include 'core/class-cleaner.php';
include 'core/class-dictionary.php';
include 'core/class-tracker.php';

class Text_Proccessor {
	public function __construct() {
		// setup our dictionary
		$file_location     = sprintf('%s/dictionaries/ignores.txt', __DIR__);
		$this->ignore_dict = Ignore_Dict::get_instance($file_location);
		$this->tracker     = new Word_Tracker();
	}

	// add the keywords of a message to the tracker
	public function add_message ($message, $timestamp=false) {

	}

	// returns a list of the keywords sorted by frequency
	public function get_keywords ($timeframe=false) {

	}
}
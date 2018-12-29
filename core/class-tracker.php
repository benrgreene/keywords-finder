<?php

class Word_Tracker {
	// Tracks all the words. 
	// Should have an array with timestamps for each keyword
	private $master_list = array();

	public function get_keywords ($options=array()) {
		$options = array_merge( array(
			'sort'   => true,
			'sortby' => 'size',
			'limit'  => count($this->master_list),
		), $options );

		// our returnable list of keywords (need copy because we may edit it)
		$to_return = $this->master_list;

		if ($options['sort']) {
			if ('name' == $options['sortby']) {
				ksort($to_return);
			} else {
				uasort($to_return, function ($a, $b) use ($options) {
					return $this->sort_list($a, $b, $options['sortby']);
				});
			}
		}

		return $to_return;
	}

	// sort a cleaned list by a given sortby arg
	public function sort_list ($a, $b, $sortby) {
		$return_val = 0;
		switch ($sortby) {
			default:
				$return_val = count($b) - count($a);
				break;
		}
		return $return_val;
	}

	// take in a message and add all the keywords
	public function add_keywords ($message, $timestamp) {
		$message  = Text_Cleaner::clean($message);
		$keywords = Text_Cleaner::get_keywords($message);
		// add the timestamp to each keyword's sub array
		foreach ($keywords as $word) {
			$this->ensure_word_exists($word);
			$this->master_list[$word][] = $timestamp;
		}
	}

	// ensure that the master list has a keyword in it
	public function ensure_word_exists ($word) {
		if (!array_key_exists($word, $this->master_list)) {
			$this->master_list[$word] = array();
		}
	}
}
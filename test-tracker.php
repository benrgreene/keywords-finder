<?php

include 'proccess.php';

$prs = new Text_Proccessor();
$file = fopen('test-input.txt', 'r');
while (false !== ($line = fgets($file))) {
	$prs->add_message(trim($line));
}

echo '<pre>';
var_dump($prs->get_keywords());
echo '</pre>';
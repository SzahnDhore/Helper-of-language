<?php

// --- Setting up simple benchmarking for the script.
$start_time = microtime(TRUE);

// --- Makes sure that the output is sent as UTF-8 to the browser.
header('Content-Type: text/html; charset=utf-8');

// --- Sets up support for different languages.
include_once 'lang/class.language.php';		// --- Includes the language library.
$lang = new language();						// --- Initiates the language library with the selected language.

// --- Time to output the actual HTML.
?><!DOCTYPE html>
<html lang="<? $lang->langcode() ?>">
	<head>
		<meta charset="UTF-8" />
		<title><? $lang->phrase('fr_title') ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<h1><? $lang->phrase('fr_title') ?></h1>
		<? $lang->langlist() ?>
		<? $lang->phrase('fr_para') ?>

<?php

// --- Ends the benchmarking.
$end_time = microtime(TRUE);

// --- Calculates execution time.
$total_time = round($end_time - $start_time,4);

// --- Displays the time it took to execute the script.
echo '
		<p><strong>Script time:</strong> '.$total_time.' sec.</p>';

?>

	</body>
</html>
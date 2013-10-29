<?php

// --- Setting up simple benchmarking for the script.
$start_time = microtime(true);

// --- Makes sure that the output is sent as UTF-8 to the browser.
header('Content-Type: text/html; charset=utf-8');

// --- Sets up support for different languages.
include_once 'lang/class.language.php';		// --- Includes the language library.
$lang = new language();						// --- Initiates the language library.

// --- Time to output the actual HTML.
?><!DOCTYPE html>
<!-- To get the most out of these comments, please look at the source code before being parsed by PHP. -->
<html lang="<?=$lang->getinfo()?>"> <!-- getinfo() returns the two letter language code by default. -->
	<head>
		<meta charset="UTF-8" />
		<title><?=$lang->phrase('fr_title')?></title> <!-- phrase() returns the specified phrase. -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
			html { background-color:#823345; }
			body { background-color:#F2D9BB; color:#2E2D2C; max-width:600px; margin:1em auto; padding:1em; font-family:sans-serif; }
			dl { border:1px dashed #2E2D2C; border-right:none; border-left:none; padding-top:0.5em; }
			dt { font-weight:bold; float:left; width:10em; height:1.9em; }
			dd { clear:right; height:2em; }
		</style>
	</head>
	<body<?=($lang->getinfo('direction')=='rtl'?' style="direction:rtl;text-align:right;"':'')?>> <!-- Here we use language info and PHP to print the text direction, but only if it's RTL. -->
		<h1><?=$lang->phrase('fr_title')?></h1>
		<!-- This is the default language list, without any arguments passed. -->
<?=$lang->langlist()?>

		<p><?=$lang->phrase('fr_para')?></p>
		<dl>
			<dt><?=$langs->phrase('name')?></dt>
			<dd><?=$lang->getinfo('name')?></dd>
			<dt><?=$lang->phrase('iso6391')?></dt>
			<dd><?=$lang->getinfo('iso6391')?></dd>
			<dt><?=$lang->phrase('iso6393')?></dt>
			<dd><?=$lang->getinfo('iso6393')?></dd>
			<dt><?=$lang->phrase('direction')?></dt>
			<dd><?=$lang->getinfo('direction')?></dd>
		</dl>
		<!-- This is a language list with a tab depth of 2, a custom class name and images. -->
		<?=$lang->langlist(2,'this_is_a_custom_classname',true)?>

<?php

// --- Ends the benchmarking.
$end_time = microtime(TRUE);

// --- Calculates execution time.
$total_time = round($end_time - $start_time,4);

// --- Displays the time it took to execute the script.
?>
		<p><strong>Script time:</strong> <?=$total_time?> sec.</p>
	</body>
</html>

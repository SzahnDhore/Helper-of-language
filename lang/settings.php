<?php

// ============================================================================
// Author: Staffan Lindsgård
// ----------------------------------------------------------------------------
// These are the settings for the language module. You should only need to edit
// these and the phrasebooks to make the system work for you.
// ============================================================================

$settings = array(
	'default'	=> 'swe',			// --- Default language to use if no value is passed to the constructor. This language file must be present in the library and should be complete.
	'nophrase'	=> '(( -- ERROR: Phrase not in phrasebook. -- ))',		// --- String to replace any non-existing phrase.
	'getvar'	=> 'lang',			// --- Name of $_GET-variable for the language.
	'll_class'	=> 'lang_list',		// --- Class name of the language list.



// ============================================================================
// There shouldn't be any need to edit the following stuff at all.

// --- Settings for file- and directory names.
	'imgdir'	=> 'images',		// --- Directory where the images are located. Must be a child directory of the one this file resides in.
	'pbdir'		=> 'library',		// --- Directory where the phrasebooks are located. Must be a child directory of the one this file resides in.
	'libfile' 	=> 'library.json',	// --- Name of the file that stores the static library info.
	'chgfile' 	=> '.changefile',	// --- Name of the file used to check for changes in the library.
);

// --- A few modifications to the settings to make sure all the paths work as intended.
$installdir = dirname(__FILE__).'/';
$settings['dirurl'] = $_SERVER['DOMAIN_NAME'].dirname(str_replace($_SERVER['DOCUMENT_ROOT'], '', __FILE__));
$settings['imgdir'] = $settings['dirurl'].'/'.$settings['imgdir'];
$settings['pbdir'] = $installdir.$settings['pbdir'];
$settings['libfile'] = $installdir.$settings['libfile'];
$settings['chgfile'] = $installdir.$settings['chgfile'];

?>
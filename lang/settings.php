<?php

// ====================================================================================
// Author: Staffan Lindsgård
// ------------------------------------------------------------------------------------
// Here are the settings for the language module. In most cases you only need to edit
// this file (and the phrasebooks, of course) to make it work for you.
// ====================================================================================

$settings = array(
	'default'	=> 'swe',			// --- Default language to use if no value is passed to the constructor. This language file must be present in the library and should be complete.
	'nophrase'	=> '(( -- ERROR: Phrase not in phrasebook. -- ))',		// --- String to replace any non-existing phrase.
	'imgdir'	=> 'images',		// --- Directory where the images are located. Must be a child directory of the one this file resides in.
	'pbdir'		=> 'library',		// --- Directory where the phrasebooks are located. Must be a child directory of the one this file resides in.
	'libfile' 	=> 'library.json',	// --- Name of the file that stores the static library info.
	'chgfile' 	=> '.changefile',	// --- Name of the file used to check for changes in the library.
	'getvar'	=> 'l',				// --- Name of $_GET-variable for the language.
	'll_class'	=> 'lang_list',		// --- Class name of the language list.
);



// ====================================================================================
// --- A few modifications to the settings to make sure the paths are correct.
// --- You shouldn't modify these unless you have to.

$installdir = dirname(__FILE__).'/';
$settings['dirurl'] = 'http://www.'.$_SERVER['DOMAIN_NAME'].dirname(str_replace($_SERVER['DOCUMENT_ROOT'], '', __FILE__));
$settings['imgdir'] = $settings['dirurl'].'/'.$settings['imgdir'];
$settings['pbdir'] = $installdir.$settings['pbdir'];
$settings['libfile'] = $installdir.$settings['libfile'];
$settings['chgfile'] = $installdir.$settings['chgfile'];

?>
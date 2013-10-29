<?php namespace HolQaH;

// ====================================================================================
// Author: Staffan Lindsgård
// ------------------------------------------------------------------------------------
// This is a swedish phrasebook.
// ====================================================================================


// --- Phrases and language info is contained in a single array.
$phrasebook = array(

	// --- Information about the language is stored in a nested array. All info is mandatory.
	'pbook_meta' => array(
		'name'		=> 'svenska',	// --- The native name of the language.
		'iso6391'	=> 'sv',		// --- ISO639-1 code for the language.
		'iso6393'	=> 'swe',		// --- ISO639-3 code for the language.
		'direction'	=> 'ltr',		// --- Which direction the language is read in; 'ltr' for left to right or 'rtl' for right to left.
	),

// --- Write the phrases to be used in the following format: 'keyword' => 'Actual phrase',
// --- The phrases are called using the keyword. All keywords must be unique.

'fr_title'	=> 'Titeltext',
'fr_para'	=> 'Detta är en kort, enkel text som är skriven för att hjälpa till med språkmodulen.',
'name'		=> 'Språknamn',
'iso6391'	=> 'ISO639-1',
'iso6393'	=> 'ISO639-3',
'direction'	=> 'Textriktning',

);

?>
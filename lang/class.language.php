<?php

// ====================================================================================
// Author: Staffan Lindsgård
// ------------------------------------------------------------------------------------
// This is a class that enables support for different languages in your project.
// Add new languages by adding new phrasebooks. The language code used is normally the
// ISO639-3 version, but ISO639-1 is also used at times since HTML uses that standard.
// ====================================================================================


class language {


	// --- Loads the correct phrasebook based on what language has been set.
	public function __construct() {
		include 'settings.php';		// --- Includes the settings file.
		$this->set = $settings;		// --- Stores the settings in a variable.

		$l = (isset($_GET[$this->set['getvar']]) ? $_GET[$this->set['getvar']] : $this->set['default'] );	// --- Recieves the incoming language variable and, if it isn't empty, assigns it to a variable.
		$this->l = $l;		// --- We need access to the language throughout the class.

		if (file_exists($this->set['pbdir'].'/'.$this->set['default'].'.php')) {	// --- If a phrasebook for the default language exists,
			include_once $this->set['pbdir'].'/'.$this->set['default'].'.php';		// --- include it in the script and...
			$pdef = $p;																// --- ... load the default phrasebook into an array.
		} else { $pdef = array(); }													// --- If the phrasebook doesn't exist we set an empty array.

		if (file_exists($this->set['pbdir'].'/'.$l.'.php')) {		// --- If a phrasebook for the specified language exists,
			include_once $this->set['pbdir'].'/'.$l.'.php';			// --- include it in the script and...
			$pspc = $p;												// --- ... load the specified phrasebook into an array.
		} else { $pspc = array(); }									// --- If the phrasebook doesn't exist we set an empty array.

		$this->p = (object) array_merge($pdef,$pspc);		// --- Merge the default and the specified phrasebooks, overwriting default values with specific ones.

	}



	// --- Looks for a specific phrase and prints it.
	public function phrase($phrase,$echo=1) {		// --- First argument is what phrase to print, second if you want to print it at once or just return it.
		$return = ( isset($this->p->$phrase) ? $this->p->$phrase : $this->set['nophrase'] );	// --- If the specified phrase exists, return it. Otherwise, print an error.
		if ($echo===1) {		// --- If second argument is 1 (which it is by default),
			echo $return;		// --- print the corresponding phrase at once.
		} else {				// --- If second argument is anything but 1,
			return $return;		// --- just return the corresponding phrase.
		}
	}



	// --- Prints the ISO639 code for the current language.
	public function langcode($v=1,$echo=1) {		// --- First argument lets the user choose between the ISO639-1 and ISO639-3 codes. Default is ISO639-1.
		$return = ( $v==3 ? $this->p->pbook_meta['iso6393'] : $this->p->pbook_meta['iso6391'] );	// --- If the first argument is 3, get the ISO639-3 code. Otherwise, get the ISO639-1 code.
		if ($echo===1) {		// --- If second argument is 1 (which it is by default),
			echo $return;		// --- print the language code.
		} else {				// --- If second argument is anything but 1,
			return $return;		// --- just return the language code.
		}
	}


}

?>
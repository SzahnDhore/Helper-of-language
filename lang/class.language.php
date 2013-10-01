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
		$this->wdir = $this->set['pbdir'].'/';	// --- Sets up the phrasebook directory.

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
	public function phrase($phrase,$echo=true) {		// --- First argument is what phrase to print, second if you want to echo it at once or just return it.
		$return = ( isset($this->p->$phrase) ? $this->p->$phrase : $this->set['nophrase'] );	// --- If the specified phrase exists, return it. Otherwise, print an error.
		if ($echo===true) {		// --- If second argument is 1 (which it is by default),
			echo $return;		// --- print the corresponding phrase at once.
		} else {				// --- If second argument is anything but 1,
			return $return;		// --- just return the corresponding phrase.
		}
	}



	// --- Prints the ISO639 code for the current language.
	public function langcode($echo=true,$v=1) {		// --- First argument echoes or returns the result. Second argument lets the user choose between the ISO639-1 and ISO639-3 codes. Default is ISO639-1.
		$return = ( $v==3 ? $this->p->pbook_meta['iso6393'] : $this->p->pbook_meta['iso6391'] );	// --- If the first argument is 3, get the ISO639-3 code. Otherwise, get the ISO639-1 code.
		if ($echo===true) {		// --- If first argument is true (which it is by default),
			echo $return;		// --- print the language code.
		} else {				// --- If first argument is anything but true,
			return $return;		// --- just return the language code.
		}
	}



	// --- Prints a list of currently supported languages, as defined in the settings.
	public function langlist($flags=false) {
		$ll = '
		<ul class="'.$this->set['ll_class'].'">
';
		$langs = $this->getLibrary();
		foreach ($langs as $code => $name) {
			if ($code=='_time' || $code=='_updated') {
			} else {
				$namestring = ($flags==true ? '<img class="'.$this->set['ll_class'].'_img" src="'.$this->set['imgdir'].'/'.$name['iso6393'].'.png" alt="'.$name['iso6393'].'" /><span class="'.$this->set['ll_class'].'_name">'.$name['name'].'</span>' : $name['name'] );
				$lurl = ($code!=$this->set['default'] ? '?'.$this->set['getvar'].'='.$code : '' );
				$ll .= '			<li class="'.$this->set['ll_class'].'_'.$code.'"><a href="'.$_SERVER['PHP_SELF'].$lurl.'">'.$namestring.'</a></li>
';
			}
		}
		$ll .= '		</ul>

';
		echo $ll;
	}



	// --- Reads the contents of a directory and returns an array with names and dates of modification for each file.
	private function getDir() {
		$ignore = array('.','..');		// --- We don't want to list everything.
		$pbdir = opendir($this->wdir);	// --- The directory is opened for reading.

		while ($file = readdir($pbdir)) {	// --- Looks for files in the directory.
			if (in_array($file,$ignore) == false) {			// --- Ignores the files specified above.
				$filemod = filectime($this->wdir.$file);	// --- Checks the current file for time of modification.
				$files[$filemod] = $file;	// --- Writes the filename and modification time to an array.
			}
		}

		closedir($this->wdir);		// --- When we're done with all files, the directory is closed.
		asort($files);				// --- The array is sorted, keeping the key associations.
		return json_encode($files);	// --- Then the array is converted into json format and sent.
	}



	// --- Checks for changes to the library folder.
	private function changed() {
		$file = (file_exists($this->set['chgfile']) ? file_get_contents($this->set['chgfile']) : '' );	// --- Looks for a file having the same kind of information as getDir() returns.
		if ($this->getDir() === $file) {	// --- Checks to see if the info in the file and the live info differs.
			return false;	// --- If they are the same, the library has not been updated.
		} else {
			return true;	// --- If they differ, the library has been updated.
		}

	}



	// --- Updates the library file. Does not check for updates first.
	private function update() {
		$files = json_decode($this->getDir(),true);		// --- Gets a list of the current files and their timestamps in the directory.
		$library = array('_time' => time() );			// --- Adds a timestamp of modification to the library catalog.

		foreach ($files as $mod => $name) {
			include $this->wdir.$name;
			$iso6393 = $p['pbook_meta']['iso6393'];

			foreach ($p['pbook_meta'] as $key => $value) {
				$library[$iso6393][$key] = $value;
			}
		}

		include_once 'function.prettyjson.php';
		file_put_contents($this->set['libfile'], json_readable_encode($library));
		file_put_contents($this->set['chgfile'], $this->getDir());

	}



	private function getLibrary() {
		if ($this->changed() === true) {
			$this->update();
			$updated = true;
		} else {
			$updated = false;
		}

		$library = json_decode(file_get_contents($this->set['libfile']),true);

		return $library;

	}


}

?>
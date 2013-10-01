<?php

// ====================================================================================
// Author: Staffan Lindsgård
// ------------------------------------------------------------------------------------
// This class checks for changes in the library folder and updates a file with current
// information for quick retrieval later. This enables the language module to get
// information about available languages without having to read through all the
// phrasebooks each time.
// ====================================================================================


class library {


	// --- Sets up some stuff on intilization.
	public function __construct() {
		include 'settings.php';		// --- The settings are included...
		$this->set = $settings;		// --- ... and saved to a local variable.
		$this->wdir = $this->set['pbdir'].'/';	// --- Sets up the phrasebook directory.
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



	public function getLibrary() {
		if ($this->changed() === true) {
			$this->update();
			$updated = true;
		} else {
			$updated = false;
		}

		$library = json_decode(file_get_contents($this->set['libfile']),true);

		return $library;

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

}


?>
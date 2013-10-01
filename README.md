Hol - Helper of language
========================

Hol is an unofficial PHP library that helps you with the handling of multiple languages in your PHP project. It is not yet fully tested or fleshed out, but should contain most of what is needed for simple use.

### Contents:

1. The usual disclaimer
2. Installation, setup & use
3. A longer explanation of the above
4. Functions and stuff
5. Known bugs and limitations
6. Acknowledgments and credits


The usual disclaimer
--------------------

You know, I shouldn't really have to include this. You should be smart enough to figure this out by yourself. Here it is anyway; right at the top of the document. Aren't you happy?

#### By using this software, you agree to the following:
This software is provided "as is" and any expressed or implied warranties, including, but not limited to, the implied warranties of merchantability and fitness for a particular purpose are disclaimed.

In no event shall the regents or contributors be liable for any direct, indirect, incidental, special, exemplary or consequential damages (including, but not limited to, procurement of substitute goods or services; loss of use, data, or profits; or business interruption) however caused and on any theory of liability, whether in contract, strict liability or tort (including negligence or otherwise) arising in any way out of the use of this software, even if advised of the possibility of such damage.


Installation, setup & use
-------------------------

Hol was written to be simple to use. This also includes installing and setting up the system. There are only five simple steps from downloading the system to having it up and running:

1. Copy the files to your server.
2. Edit the settings.
3. Add phrasebooks.
4. Include the file "class.language.php".
5. Initiate a new instance of the class "language".
6. Call a phrase using the function "phrase".

There you go, all set!


A longer explanation of the above
---------------------------------

If you find the list above to be too brief for your liking (or you simply enjoy reading this document) you can find a more detailed guide below.

#### 1. Copy the files to your server
Upload the folder (along with with all its content) to the root of your project. You should now have a folder in your root called *lang* having all important content inside of it.

#### 2. Edit the settings
Open the file named "settings.php" and edit the settings if needed. You should normally only need to modify the setting for `default`, and maybe `nophrase`. The other settings shouldn't really need to be modified, but if you have to change them they're there.

#### 3. Add phrasebooks
Create a phrasebook file having the name "xxx.php" (where "xxx" is the ISO 639-3 language code of the default language of the project) and put it in your library folder. For a reference of how the contents of the file should be formated, please see the included example files.

To subsequently add a language to your system, all you have to do is to upload a new (correctly written) language file to the phrasebook folder. This makes it very simple to support additional languages.

#### 4. Include the file "class.language.php"
You will need two lines of extra code in your project to set up the system for use. The first is to include the script in the file you want to use it in. It should look something akin to this:

```php
include_once 'lang/class.language.php';
```

Naturally, you have to make sure that the path to "class.language.php" reflects the actual setup on your server.

#### 5. Initiate a new instance of the class "language"
The second line of code you need to add initiates the magic itself. Just add the following:

```php
$lang = new language();
```

Naturally, you can name the object whatever you want. I like `$lang` personally, but you could, for instance, use `$l` for someting shorter.

#### 6. Call a phrase using the function "phrase"
Now that the system is set up we can start using it. Assuming everything is in order, the following command will return and echo a specified string:

```php
$lang->phrase('string')
```

This command will look for a corresponding entry in the appropriate phrasebook and return it. In this particualar case, it looks for the keyword "string" and returns whatever value is assigned to that keyword.

You should now be up and running. Congratulations.


Functions and stuff
-------------------

These functions are available to you after setting up the system.

The following descriptions and examples assumes a variable name of `$lang` for the class and that all settings are at their default.

### `$lang->phrase('foo')`
Echoes the phrase corresponding to the keyword "foo".

If you need to, you can tell the function to return the string instead of echoing it by setting a second argument to `false`, like so: `$lang->phrase('foo',false)`

##### Order of logic
1. Checks `$_GET` to see if there is a specified language. If `$_GET` isn't set, the default language is used.
2. Looks up the keyword.
	* If the keyword can't be found in the phrasebook for the specified language, the phrasebook for the default language is used.
	* If the keyword can't be found in the phrasebook for the default language, the `nophrase` error string in the settings is used.
3. Echoes or return the value.

### `$lang->langlist()`
Echoes a list of currently installed languages.

You can add images to the image directory and have the system fetch them as well. Each image should be in PNG-format and have the same filename as the ISO639-3 code of the corresponding language. So if you, for example, want a swedish flag to be displayed in the list you add a file named "swe.png" to the directory named "images" and call the function using the argument `true`, like so: `$lang->langlist(true)`

For the sake of accessibility you cannot return a list without text. If you only want to display the images you should instead hide the text using CSS.

### `$lang->langcode()`
Echoes the ISO639 language code for the currently used language.

By default, the ISO639-1 code is echoed. This is done because HTML uses that code and therefore it is the version you will most often need. You can specify that you want to return the code instead of echoing it by setting the first argument to `false` and that you want the ISO639-3 code instead of ISO639-1 by setting the second argument to `3`. Like so: `$lang->langlist(false,3)`


Known bugs and limitations
--------------------------

### Phrasebook uploading
After uploading multiple phrasebooks you may find that the system doesn't find them all. The solution is to upload them one by one and refresh the library between each upload. I'm not sure why this is happening, but I'm looking into it.

### Dropped `<` in list
I've observed a dropped `<` character in the language list. It only seems to happen after I've uploaded a phrasebook and after refreshing a couple of times the character is back again. Not a priority at the moment.


Acknowledgments and credits
---------------------------

### People

##### My girlfriend
Well, she hasn't contributed to or tested the code and she isn't really interested in hearing me talk about it, but at least she pretends to listen. Possibly because she knows I do the same when she talks about... Well, I can't remember what it is she talks about exactly. But at least I pretend to listen.

### External resources

##### Icons
This project uses the Flag Icon set by Mark James.

Website: http://www.famfamfam.com/lab/icons/flags/

##### json prettifyer function
This project uses a function by BohwaZ that formats json code to be more readable.

Website: http://bohwaz.net/

### Websites I've visited a lot
* php.net
* stackoverflow.com
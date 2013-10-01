Hol - Helper of language
========================

Hol is an unofficial PHP library that helps you with the handling of multiple languages in your PHP project. It is not yet fully tested or fleshed out, but should contain most of what is needed for simple use.


Disclaimer
----------

This software is provided "as is" and any expressed or implied warranties, including, but not limited to, the implied warranties of merchantability and fitness for a particular purpose are disclaimed. In no event shall the regents or contributors be liable for any direct, indirect, incidental, special, exemplary, or consequential damages (including, but not limited to, procurement of substitute goods or services; loss of use, data, or profits; or business interruption) however caused and on any theory of liability, whether in contract, strict liability, or tort (including negligence or otherwise) arising in any way out of the use of this software, even if advised of the possibility of such damage.


Installation, setup & use
-------------------------------

Hol was written to be simple to use. This also includes installing and setting up the system. There are only five simple steps from downloading the system to having it up and running:

1. Copy the files to your server.
2. Edit the settings.
3. Add phrasebooks.
4. Include the file "class.language.php".
5. Initiate a new instance of the class "language".
6. Call a phrase using the function "phrase".

There you go, all set!


### A longer explanation of the above

#### 1. Copy the files to your server
Upload the folder (along with with all its content) to the root of your project. You should now have a folder in your root called *lang* having all important content inside of it.

#### 2. Edit the settings
Open the file named "settings.php" and edit the settings if needed. You should normally only need to modify the setting for `default`, and maybe `nophrase`. The other settings shouldn't really need to be modified, but if you have to change them they're there.

#### 3. Add phrasebooks
Create a phrasebook file having the name "xxx.php" (where "xxx" is the ISO 639-3 language code of the default language of the project) and put it in your library folder. For a reference of how the contents of the file should be formated, please see the included example files.

To subsequently add a language to your system, all you have to do is to upload a new (correctly written) language file to the phrasebook folder. This makes it very simple to support additional languages.

#### 4. Include the file "class.language.php"
You will need two lines of extra code in your project to set up the system for use. The first is to include the script in the file you want it in. Supposing that the file is in the root of your project and that you've copied the language library to a subfolder named "lang" you would use the following PHP to include it:

```php
include_once 'lang/class.language.php';
```

Remember that you have to alter the path to "class.language.php" to reflect the setup on your server.

#### Initiate a new instance of the class "language"
The second line of code initiates the magic. Just add the following:

```php
$lang = new language();
```

Naturally, you can name the object whatever you want. I like "$lang" personally, but you can use "$l" instead if you want someting shorter.

#### Call a phrase using the function "phrase"
Now that everything is set up we can start using it.

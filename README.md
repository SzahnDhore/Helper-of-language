Hol - Helper of language
========================


So, what is this anyway?
------------------------

Hol is an unofficial PHP library that helps you with the handling of multiple languages in your PHP project. It is not yet fully tested or fleshed out, but should have most of what is needed for simple use of multiple languages.


Quick installation, setup & use
-------------------------------

1. Copy the files to your server.
2. Edit the phrasebooks.
3. Include the file "class.language.php".
4. Initiate a new instance of the class "language".
5. Call a phrase using the function "phrase".


A longer explanation of the above
---------------------------------

### Copy the files to your server
Upload the folder with all contents to the root of your project. The phrasebooks should be in a subfolder of the library folder. The default setting is a subfolder named "phrasebooks".

### Edit the phrasebooks
Create a file in your phrasebook folder with the name "xxx.php" where "xxx" is the ISO 639-3 language code of whatever language you want to add. Make sure there is a file for the default language and that all mandatory information is filled in. To subsequently add a language, all you have to do is to upload a new language file to the phrasebook folder.

### Include the file "class.language.php" in your file
You will need two lines of extra code in your project to set up the language. The first is to include the script in the file you want it in. Supposing that the file is in the root of your project and that you've copied the language library to a subfolder named "lang" you would use the following PHP to include it:

```php
   include_once 'lang/class.language.php';
```

Remember that you have to alter the path to "class.language.php" to reflect the setup on your server.

### Initiate a new instance of the class "language"
The second line of code initiates the magic. Just add the following:

```php
   $lang = new language();
```

Naturally, you can name the object whatever you want. I like "$lang" personally, but you can use "$l" instead if you want someting shorter.

### Call a phrase using the function "phrase"
Now that everything is set up we can start using it.

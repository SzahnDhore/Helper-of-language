Changelog
=========

Version numbering follows the pattern: *[major].[minor].[miniscule]*. Numbers begin at 1 and are reset whenever a preceding number is changed.

* **Major** updates have new or significantly altered features.
* **Minor** updates have slightly altered features and/or a more efficient code.
* **Miniscule** updates contain small edits and bugfixes.


Current version
---------------

### v0.5.2 // 2014-01-14

##### Removed
* Since I couldn't get Travis-CI to work I removed support for it. Might be added back again later when I know more about how to write tests for Travis.


Older versions
--------------

### v0.5.1 // 2013-10-29

##### Added
+ Added working Travis-CI support.

##### Changed
* Filestructure changed to better work with testing.


### v0.4.1 // 2013-10-24

##### Added
+ langlist() now takes two additional arguments; number of tabbed indentations and custom class name.

##### Changed
* langlist() now outputs HTML with new lines and indentations in it.
* Fleshed out 'demo.php' with some comments.


### v0.3.2 // 2013-10-24

##### Changed
* Fixed bug where all languages were not shown in HTML list.


### v0.3.1 // 2013-10-24

##### Added
+ Added function `getinfo()` which returns any specified meta information about a language.

##### Changed
* Changed many variables to become more descriptive.
* Updated demo page with to work with new code and to have some basic CSS.
* Minor updates and optimizations to the code.
* Minor updates to the comments.

##### Removed
- Removed function `langcode()` which returns the specified language code. This feature is instead covered by the `getinfo()` function.


### v0.2.1 // 2013-10-22

##### Added
+ This changelog.

##### Changed
* The `phrase()` function from echoing phrases by default to only returning them.
* Updated the README to reflect other changes.


### v0.0.1 // 2013-10-01
First public release.
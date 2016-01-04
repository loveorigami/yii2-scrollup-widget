ScrollUp widget for Yii 2
==============================

Wrapper around "Scroll Up", a "*lightweight jQuery plugin to create a customisable "Scroll to top" feature that will work with any website, with ease*. 

Check out the  [ScrollUp Demo page](http://markgoodyear.com/labs/scrollup/) for demo of the Plugin and don't forget to have a look
to the [scrollUp jQuery plugin Home page](http://markgoodyear.com/2013/01/scrollup-jquery-plugin/).


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). 

To install, either run

```
$ php composer.phar require loveorigami/yii2-scrollup-widget "*"
```
or add

```
"loveorigami/yii2-scrollup-widget": "*"
```

to the ```require``` section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by :

```php
<?php 
	 		
use lo\widgets\ScrollUp;
 
ScrollUp::widget([
	'theme' => ScrollUp::THEME_IMAGE, // or 'image.css' - theme file css
	'themeDir' => '@vendor/loveorigami/yii2-scrollup-widget/themes/default', // dir with theme file css.
	'options' => [
		'scrollText' => "To top", // Text for element
		'scrollName'=> 'scrollUp', // Element ID
		'topDistance'=> 400, // Distance from top before showing element (px)
		'topSpeed'=> 3000, // Speed back to top (ms)
		'animation' => ScrollUp::ANIMATION_SLIDE, // Fade, slide, none
		'animationInSpeed' => 200, // Animation in speed (ms)
		'animationOutSpeed'=> 200, // Animation out speed (ms)
		'activeOverlay' => false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	]
]);

?>
```
If you wish to use your own styling for the scroll-up, just remove the 'theme' option and provide the required CSS style.

For more information on the plugin options and usage, please refer to [scrollUp jQuery plugin Home page](http://markgoodyear.com/2013/01/scrollup-jquery-plugin/).



## License

**loveorigami/yii2-scrollup-widget** is released under the MIT License. See the bundled `LICENSE.md` for details.
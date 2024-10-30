=== Click to Copy Grab Box ===
Contributors: blogjunkie
Donate link: http://clickwp.com/make-a-payment/
Tags: grab box, click to copy, copy, clipboard, widget
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 0.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays a grab box with a click to copy button

== Description ==

Click to Copy Grab Box makes it easy to generate code for your blog button. The plugin adds a widget to WordPress that will display a textarea with code for your readers to copy and paste into their blogs. The widget will even automatically generate the correct code for you. Simply fill out the fields in the widget and click Save.

**Features**

* No coding knowledge required! Just fill in the fields and your blog button code will automatically be generated.
* Minimally styled so you can easily customize the widget to fit your theme. 
* Choose to display an optional message for instructions or a description of your blog button.

To get help for this plugin please post in the WordPress support forum.


== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the `Plugins` menu in WordPress
1. Go to `Appearance → Widgets` and drag the Grab Box widget into your sidebar.

== Frequently Asked Questions ==

= How can I style the widget to look better =

Many themes allow you to add custom CSS. You can use this feature to customize the look of the widget.

If your theme doesn't offer custom CSS, you can try these plugins:

* [My Custom CSS](http://wordpress.org/extend/plugins/my-custom-css/)
* [Jetpack](http://jetpack.me) comes with a [custom CSS module](http://jetpack.me/support/custom-css/)


= What is my image URL? =

Your image must first be uploaded to your blog or a picture hosting service like [Photobucket](http://photobucket.com). Find the direct link to the image (you will see a `.jpg`, `.gif` or `.png` at the end of the URL).

= My image is sticking out past my sidebar =

Add the following CSS to your theme.

	.click-grab-box-button img {
		max-width: 100%;
		height: auto;
	} 

= How can I center the image =

Add the following CSS to your theme.

	.click-grab-box-button {
		text-align: center;
	}


== Screenshots ==

1. The plugin adds a widget that makes it easy to display a grab box in your sidebar.

2. Visitors can click the Copy Code button to copy the content of the textarea easily.

3. The widget is lightly styled so you can customize it to your liking.



== Changelog ==

= 0.1 =
* Initial release on Github

= 0.1.1 =
* Minor corrections, added help text
* Added screenshots
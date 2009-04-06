=== Link Shortcut ===
Contributors: husani
Tags: permalink, link, links, redirect, shortcut, seo, tinyurl
Donate link: http://www.husani.com/ventures/wordpress-plugins/linkshortcut/#donate
Requires at least: 2.7
Tested up to: 2.7.1
Stable tag: 1.1
Version: 1.1

Create and manage TinyURL-like URLs (yourblog.com/33ks8s) that redirect to pages both inside and outside your blog.  Can also create human-readable aliases (yourblog.com/facebook)

== Description ==

Ever want your own shortcuts without mucking about with permalink structures?  The Link Shortcut plugin allows you to create short (random numbers and letters, or short words) URLs under your blog's domain that redirect a user to other pages, either in your site or on another site.

In other words, instead of sending this url to the author's plugin page:
http://www.husani.com/ventures/wordpress-plugins/linkshortcut/

This shortcut could be created simply by installing this plugin and adding a link, via the same traditional WordPress UI we all know and love:
http://www.husani.com/link123

**IMPORTANT: YOU MUST USE NON-UGLY PERMALINKS FOR THIS PLUGIN TO WORK.**  Your permalink structure cannot be yourblog.com?p=84, it must be date-based, name-based, etc.

Link Shortcut is released to the Wordpress community under the GPL.  Please feel free to modify as you see fit, and if you find this plugin useful, donate to the author.  All feedback is welcome at wordpressplugins@husani.com, and you can visit the author's websites at http://www.husani.com.

**UPDATE FOR VERSION 1.2** Fixed another bug -- couldn't find proper item in query array.

**UPDATE FOR VERSION 1.1** Fixed directory name bug.  Sorry about that.


== Installation ==

1.  Upload the Link Shortcut plugin to your blog (YOURBLOG/wp-content/plugins) and activate it using the Wordpress plugin admin screen.
2.  Click "Link Shortcuts" in the left-hand menu and manage your links.

== Frequently Asked Questions ==

= How does Link Shortcut work? =

The Link Shortcut plugin attaches itself to various core Wordpress methods and waits for a request to be made for a shortcut URL saved to the database.  When one is, it simply does a 302 redirect to the saved URL.

= I installed the plugin but it doesn't work. =

You must have non-ugly permalink settings.  If there are variables in your URLs, you'll have to use Wordpress admin to change that.

= Does Link Shortcut use the Wordpress database? =

Yes.  Upon activation, Link Shortcut creates a table and stores all links in that table, so your existing structure does not change.  If you decide to deactivate the plugin, it removes this table.  No more cluttered databases!  Consider this a plea to all Wordpress plugin developers -- remove your tables when I deactivate your plugin!

== Screenshots ==

1. List of links
2. Add new link
3. Edit link


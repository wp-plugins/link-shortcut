<?
/*
Plugin Name: Link Shortcut
Plugin URI: http://www.husani.com/ventures/wordpress-plugins/linkshortcut
Description: Create and manage TinyURL-like URLs that redirect to pages both inside and outside your blog.  Must have non-default permalink structure set (i.e., other than yoursite.com?p=87) or this plugin will not work.  By <a href="http://www.husani.com" target="_blank">Husani Oakley</a>.
Version: 1.0
*/

/*  Copyright 2009  Husani Oakley  (email : wordpressplugins@husani.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/** SETTINGS AND REQUIRED FILES */
define("LINKSHORTCUT_NAME", "/link-shortcut");
define("LINKSHORTCUT_UI_LOC", ABSPATH . PLUGINDIR . LINKSHORTCUT_NAME . "/admin");
require_once(ABSPATH . PLUGINDIR . LINKSHORTCUT_NAME . "/lib/Linkshortcut.php");
require_once(ABSPATH . PLUGINDIR . LINKSHORTCUT_NAME . "/lib/LinkshortcutInstaller.php");
require_once(ABSPATH . PLUGINDIR . LINKSHORTCUT_NAME . "/lib/LinkshortcutAdmin.php");
require_once(ABSPATH . PLUGINDIR . LINKSHORTCUT_NAME . "/lib/LinkshortcutDataManager.php");

//grab control of the flow during template_redirect.
add_action('template_redirect', 'linkshortcut');

/** 
 * MAIN WORK FUNCTION.  At this point, we know if WP has found the content.  if we're a
 * 404, we'll check to see if it's a linkshortcut.  if it is, redirect; otherwise, do nothing
 * and let WP continue with the error process.
 */
function linkshortcut(){
  global $wp_query;
  //are we a 404?
  if(is_404()){
    //yes.  send to linkshortcut, which will determine if we redirect or not.
    $LinkshortcutManager = new LinkshortcutManager;
    $LinkshortcutManager->go();
  }
}

/********* HOOKS AND ACTIONS REGISTRATION FOR INSTALL/UNINSTALL AND ADMIN PANELS ***********/
/** create options page and menu structure/pages */
add_action('admin_menu', 'linkshortcutAdminMenuCreation');
function linkshortcutAdminMenuCreation() {
  $LinkshortcutAdmin = new LinkshortcutAdmin();
  add_menu_page("Link Shortcuts", "Link Shortcuts", 8, 'linkshortcut_list', array($LinkshortcutAdmin, 'displayMain')); 
  add_submenu_page('linkshortcut_list', "addnew", "Add New", 8, 'linkshortcut_addnew', array($LinkshortcutAdmin, 'displayAddNewForm'));
  if(is_admin()){
    //include javascript
    add_action('wp_print_scripts', array($LinkshortcutAdmin,'displayJS'));
  }
}

/** set up ajax for admin custom ident check */
$LinkshortcutAdmin = new LinkshortcutAdmin();
add_action('wp_ajax_linkshortcut_check_ident', array($LinkshortcutAdmin, 'checkIdentWithAjax'));

/** register activation/deactivation hooks.  since i can't seem to get a class's method used as a callback, doing it ghetto style. */
$LinkshortcutInstaller = new LinkshortcutInstaller;
register_activation_hook(__FILE__,array($LinkshortcutInstaller,'doInstall'));
register_deactivation_hook(__FILE__,array($LinkshortcutInstaller,'doUninstall'));

?>
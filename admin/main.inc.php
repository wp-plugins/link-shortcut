<?
/** so that we can have separate files for list/edit/delete/etc, the admin hook points to THIS file.  depending on the query string, we include the proper UI file.*/

$LinkshortcutAdmin = new LinkshortcutAdmin();
switch($_REQUEST['action']){
 case "edit":
   $LinkshortcutAdmin->displayEditForm();
   break;
 case "delete":
   $LinkshortcutAdmin->displayDelete($_REQUEST['linkshortcut_id']);
   break;
 default:
   $LinkshortcutAdmin->displayList();
   break;
 }

?>
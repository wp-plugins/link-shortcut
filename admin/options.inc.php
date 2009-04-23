<?
if($_POST['action'] == "update"){
  update_option('linkshortcut_length', $_POST['linkshortcut_length']);
  update_option('linkshortcut_subdir', $_POST['linkshortcut_subdir']);
  update_option('linkshortcut_redirecttype', $_POST['linkshortcut_redirecttype']);
}
?>

<div class="wrap">
  <h2><?=$page_title?></h2>

   <form method="post" action="options.php">
     <?php wp_nonce_field('update-options'); ?>
     <h3>URL Options</h3>
     <table class="form-table">
       <tr>
	 <th scope="row" valign="top">
	   Character Length<br/>
	 </th>
	 <td><input type="text" name="linkshortcut_length" value="<?php echo get_option('linkshortcut_length'); ?>" /></td>
       </tr>
       <tr>
	 <td colspan="2"><span class="setting-description">Set the maximum length of plugin-generated URLs.  This does <strong>not</strong> include your domain, nor does it include the subdirectory (if you set that option below).  The default length is 8.</span>
	 </td>
       </tr>
       <tr>
	 <th scope="row" valign="top">
	   Subdirectory<br/>
	 </th>
	 <td><input type="text" name="linkshortcut_subdir" value="<?php echo get_option('linkshortcut_subdir'); ?>" /></td>
       </tr>
       <tr>
	 <td colspan="2"><span class="setting-description">Optionally set a subdirectory that all URLs will be created under (i.e., http://yourblog.com/go/ -- enter /go in the field above, no trailing slash).</span>
	 </td>
       </tr>
       <tr>
	 <th scope="row" valign="top">
	   Redirect Type<br/>
	 </th>
	 <td><input type="text" name="linkshortcut_redirecttype" value="<?php echo get_option('linkshortcut_redirecttype'); ?>" /></td>
       </tr>
       <tr>
	 <td colspan="2"><span class="setting-description">Set the type of redirect (301 or 302) that Link Shortcut uses.</span>
	 </td>
       </tr>
     </table>
     <input type="hidden" name="action" value="update" />
     <input type="hidden" name="page_options" value="linkshortcut_length,linkshortcut_subdir,linkshortcut_redirecttype" />
     <p class="submit">
       <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
     </p>
   </form>
   <? include LINKSHORTCUT_UI_LOC . "/footer.inc.php" ?>

</div>

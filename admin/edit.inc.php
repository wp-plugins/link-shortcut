<?
//are we updating?
$LinkshortcutDataManager = new LinkshortcutDataManager;

if(($_POST['action']) && ($_POST['action'] == "edit")){
   check_admin_referer('linkshortcut_edit');

   //edit link shortcut
   if($LinkshortcutDataManager->editLink($_POST['linkshortcut_id'], $_POST['url'], $_POST['name'])){
     $updated_msg = '<div class="updated"><p><strong>Link shortcut edited.</strong></p></div>';
   } else {
     $updated_msg = '<div class="error"><p><strong>ERROR: </strong>' . $LinkshortcutDataManager->error_msg . '</p></div>';
   }
   
 }

$link_array = $LinkshortcutDataManager->getLinkById($_REQUEST['linkshortcut_id']);

?>

<style type="text/css">
p.ident_msg{
  padding-left: 20px;
  display: none;
}
span#ident_custom_input_status_msg{
  font-weight: bold;
  padding-left: 5px;
}


</style>

<div class="wrap">
  <h2><?=$page_title?></h2>

  <?=$updated_msg?>

  <div id="error_container"></div>

  <form id="linkshortcut_form" class="linkshortcut_edit" method="post" action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>">
    <?
       if ( function_exists('wp_nonce_field') )
       wp_nonce_field('linkshortcut_edit');
    ?>

    <input type="hidden" name="action" value="edit" />
    <input type="hidden" name="linkshortcut_id" value="<?=$link_array['linkshortcut_id']?>" />


    <!-- sidebar and save button -->
    <div id="poststuff" class="metabox-holder">
      <div id="side-info-column" class="inner-sidebar">
	  <div id="linksubmitdiv" class="postbox " >
	    <h3><span>Save</span></h3>
	    <div class="submitbox" id="submitlink">
	      <div id="major-publishing-actions">
		<div id="publishing-action">
		  <input name="save" type="submit" class="button-primary" id="publish" tabindex="4" accesskey="p" value="Save Changes" />
		</div>
		<div class="clear"></div>
	      </div>
	    </div>
	  </div>
      </div>
      <!-- /sidebar and save button -->
      
      <!-- main body -->
      <div id="post-body" class="has-sidebar">
	<div id="post-body-content" class="has-sidebar-content">
	  
	  <div id="shortcuturldiv" class="stuffbox">
	    <h3>Shortcut URL</h3>
	    <div class="inside">
	      
	      <p><strong><a href="<?=trim(get_bloginfo('siteurl'), '\/')?>/<?=trim($link_array['ident'], '/')?>" target="_blank"><?=trim(get_bloginfo('siteurl'), '\/')?>/<?=trim($link_array['ident'], '/')?></a></strong></p>

	    </div>
	  </div>

	  <div id="addressdiv" class="stuffbox">
	    <h3><label for="url">Web Address to Shortcut</label></h3>
	    <div class="inside">
	      <input type="text" name="url" size="30" tabindex="1" value="<?=$link_array['url']?>" id="linkshortcut_url" />
	      <p>Example: <code>http://www.husani.com/</code> &#8212; don&#8217;t forget the <code>http://</code></p>
	    </div>
	  </div>

	  <div id="namediv" class="stuffbox">
	    <h3><label for="name">Shortcut Name</label></h3>
	    <div class="inside">
	      <input type="text" name="name" size="30" tabindex="1" value="<?=$link_array['name']?>" id="linkshortcut_name" />
	      <p>The shorcut name will only appear inside the administration panel.</p>
	    </div>
	  </div>
	  

	  	  
	</div>
      </div>
      <!-- /main body -->

    </div>
    
  </form>

  <br/><br/>
  <? include LINKSHORTCUT_UI_LOC . "/footer.inc.php" ?>

</div>

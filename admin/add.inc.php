<?
//are we inserting?
if(($_POST['action']) && ($_POST['action'] == "add")){
   check_admin_referer('linkshortcut_add');

   //add new link shortcut
   $LinkshortcutDataManager = new LinkshortcutDataManager;
   if($_POST['ident_type'] == "random"){
     $ident = false;
   } elseif($_POST['ident_type'] == "custom"){
     $ident = $_POST['ident_custom_input'];
   }
   if($LinkshortcutDataManager->addLink($_POST['url'], $_POST['name'], $ident)){
     $updated_msg = '<div class="updated"><p><strong>Link shortcut added.</strong></p></div>';
   } else {
     $updated_msg = '<div class="error"><p><strong>ERROR: </strong>' . $LinkshortcutDataManager->error_msg . '</p></div>';
   }
}

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

  <form id="linkshortcut_form" class="linkshortcut_add" method="post" action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>">
    <?
       if ( function_exists('wp_nonce_field') )
       wp_nonce_field('linkshortcut_add');
    ?>

    <input type="hidden" name="action" value="add" />


    <!-- sidebar and save button -->
    <div id="poststuff" class="metabox-holder">
      <div id="side-info-column" class="inner-sidebar">
	  <div id="linksubmitdiv" class="postbox " >
	    <h3><span>Save</span></h3>
	    <div class="submitbox" id="submitlink">
	      <div id="major-publishing-actions">
		<div id="publishing-action">
		  <input name="save" type="submit" class="button-primary" id="publish" tabindex="4" accesskey="p" value="Add Link Shortcut" />
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
	      
	      <fieldset id="shortcut_url">
		<p>
		  <label for="ident_random" class="selectit">
		    <input id="ident_random" type="radio" name="ident_type" value="random"  /> Generate a random shortcut URL.
		  </label>
		</p>
		<p class="ident_msg" id="ident_random_msg">
		  A short URL will be created for you by the system.
		</p>
		<p>
		  <label for="ident_custom" class="selectit">
		    <input id="ident_custom" type="radio" name="ident_type" value="custom"  /> Create your own shortcut URL.
		  </label>
		</p>
		<p class="ident_msg" id="ident_custom_msg">
		  <strong><?=get_bloginfo('siteurl')?>/</strong><input type="text" id="ident_custom_input" name="ident_custom_input" /><input type="hidden" id="ident_custom_input_status" name="ident_custom_input_status" value="0" /><span id="ident_custom_input_status_msg"></span>
		</p>

	      </fieldset>

	    </div>
	  </div>

	  <div id="addressdiv" class="stuffbox">
	    <h3><label for="url">Web Address to Shortcut</label></h3>
	    <div class="inside">
	      <input type="text" name="url" size="30" tabindex="1" value="" id="linkshortcut_url" />
	      <p>Example: <code>http://www.husani.com/</code> &#8212; don&#8217;t forget the <code>http://</code></p>
	    </div>
	  </div>

	  <div id="namediv" class="stuffbox">
	    <h3><label for="name">Shortcut Name</label></h3>
	    <div class="inside">
	      <input type="text" name="name" size="30" tabindex="1" value="" id="linkshortcut_name" />
	      <p>The shorcut name will only appear inside the administration panel.</p>
	    </div>
	  </div>
	  

	  	  
	</div>
      </div>
      <!-- /main body -->

    </div>
    
  </form>

</div>

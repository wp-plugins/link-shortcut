<?
/**
 * Manages administration screens
 */
class LinkshortcutAdmin{

  var $LinkshortcutDataManager;
  var $xhtml_path;
  var $xhtml_array = array(
			   "main" => array(
					   "page_title" => "Link Shortcut - Links",
					   "xhtml_file" =>  "/admin/main.inc.php"
					   ),
			   "list" => array(
					   "page_title" => "Link Shortcut - Links",
					   "xhtml_file" =>  "/admin/list.inc.php"
					   ),
			   "add" => array(
					   "page_title" => "Link Shortcut - Add New Link Shortcut",
					   "xhtml_file" =>  "/admin/add.inc.php"
					  ),
			   "edit" => array(
					   "page_title" => "Link Shortcut - Edit Link Shortcut",
					   "xhtml_file" =>  "/admin/edit.inc.php"
					   )
			   );
  
  /**
   * constructor
   */
  function LinkshortcutAdmin(){
    $this->LinkshortcutDataManager = new LinkshortcutDataManager;
    $this->xhtml_path = ABSPATH . PLUGINDIR . LINKSHORTCUT_NAME;
    $this->xhtml_url =  WP_CONTENT_URL . "/plugins" . LINKSHORTCUT_NAME;
  }

  /**
   * display list of all db records
   */
  function displayMain(){
    //include xhtml.  display logic (i.e., array iteration and such) is handled in that file.
    extract($this->xhtml_array['main']);
    include_once($this->xhtml_path . $xhtml_file);
  }

  /**
   * display list of all db records
   */
  function displayList(){
    //get array
    $links_array = $this->LinkshortcutDataManager->getAllLinks();
    //include xhtml.  display logic (i.e., array iteration and such) is handled in that file.
    extract($this->xhtml_array['list']);
    include_once($this->xhtml_path . $xhtml_file);
  }

  /**
   * display ADD form
   */
  function displayAddNewForm(){
    //include xhtml.  display logic (i.e., array iteration and such) is handled in that file.
    extract($this->xhtml_array['add']);
    include_once($this->xhtml_path . $xhtml_file);
  }

  /**
   * display EDIT form 
   */
  function displayEditForm(){
    //include xhtml.  display logic (i.e., array iteration and such) is handled in that file.
    extract($this->xhtml_array['edit']);
    include_once($this->xhtml_path . $xhtml_file);
  }

  /** 
   * "display" delete -- actually delete record and display the list.
   */
  function displayDelete($linkshortcut_id){
    //delete record
    $this->LinkshortcutDataManager->deleteLink($linkshortcut_id);
    //show list
    $this->displayList();
  }


  function displayOptionsPanel(){
    echo "OPTIONS!!!!";
  }

  /**
   * ensure that jquery and plugin-specific javascript play nice
   */
  function displayJS(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('linkshortcut', $this->xhtml_url . "/admin/js/functions.js");
  }

  /**
   * called via admin-ajax, this method checks to see if a user-defined ident string exists
   */
  function checkIdentWithAjax(){
    if($this->LinkshortcutDataManager->_checkIdent($_REQUEST['linkshortcut_ident'])){
      echo "true";
    } else {
      echo "false";
    }
    exit;
  }

}

?>
<?
/**
 * Main linkshortcut logic
 */
class LinkshortcutManager{

  var $wp_query;
  var $LinkshortcutDataManager;

  /**
   * constructor
   */
  function LinkshortcutManager(){
    global $wp_query;
    $this->wp_query = $wp_query;
    $this->LinkshortcutDataManager = new LinkshortcutDataManager;
  }

  /**
   * Get final destination based on query and redirect user.
   */
  function go(){
    //determine final destination
    $final_destination = $this->getFinalDest();
    //redirect user
    wp_redirect($final_destination, get_option('linkshortcut_redirecttype'));
  }
  
  /**
   * parse query string, get URL from db
   */
  function getFinalDest(){    
    $ident = $_SERVER['REQUEST_URI'];
    //if ident only has one slash, it's not using a subdir, so account for this.  otherwise the db lookup will return false.
    if(substr_count($ident, "/") == 1){
      $ident = trim($ident, "/");
    }
    $link_array = $this->LinkshortcutDataManager->getLinkByIdent($ident);
    return $link_array['url'];
  }

}

?>
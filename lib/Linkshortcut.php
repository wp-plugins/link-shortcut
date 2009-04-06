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
    wp_redirect($final_destination);
  }
  
  /**
   * parse query string, get URL from db
   */
  function getFinalDest(){
    $ident = $this->wp_query->query_vars['pagename'];
    //2.7 and 2.7.1 consistency
    if($ident == ""){
      $ident = $this->wp_query->query['name'];
    }
    $link_array = $this->LinkshortcutDataManager->getLinkByIdent($ident);
    return $link_array['url'];
  }

}

?>
<?
/**
 * Manages database CRUD (assumes table was setup properly in LinkshortcutInstaller.
 */
class LinkshortcutDataManager{

  var $db;
  var $ident_length = 6;

  function LinkshortcutDataManager(){
    //set up db connectivity and other class-wide variables
    global $wpdb;
    $this->db = $wpdb;
    $this->table_name = $wpdb->prefix . "linkshortcut";
  }

  /**
   * get all records from db, return as array
   */
  function getAllLinks(){
    $sql = "SELECT * FROM $this->table_name ORDER BY name";
    return $this->db->get_results($sql, ARRAY_A);
  }

  /**
   * get one record from db, by id, return as array
   */
  function getLinkById($linkshortcut_id){
    $sql = "SELECT * FROM $this->table_name WHERE linkshortcut_id = '$linkshortcut_id'";
    return $this->db->get_row($sql, ARRAY_A);
  }

  /**
   * get one record from db, by ident, return as array
   */
  function getLinkByIdent($ident){
    $sql = "SELECT * FROM $this->table_name WHERE ident = '$ident'";
    return $this->db->get_row($sql, ARRAY_A);
  }

  /**
   * add link to db with optional non-random ident.
   */
  function addLink($url, $name, $ident=false){
    //if we're not overriding ident, generate one.  if we are, make sure it's unique.
    if(!$ident){
      $ident = $this->_generateIdent($this->ident_length);
    } else {
      if($this->_checkIdent($ident)){	
	$this->error_msg = "A link with that identifier already exists, please choose another.";
	return false;
      }
    }
    $sql = "INSERT INTO " . $this->table_name . "
	   (ident, name, url) VALUES ('" . $ident . "', '" . $name . "', '". $url ."')";

    $this->db->query($sql);
    return true;
  }

  /**
   * update existing db record by id.  DOES NOT HAVE ABILITY TO EDIT IDENT!
   */
  function editLink($linkshortcut_id, $url, $name){
    $sql = "UPDATE $this->table_name SET url='$url', name='$name' WHERE linkshortcut_id='$linkshortcut_id'";
    $this->db->query($sql);
    return true;
  }
  
  /**
   * permanently delete a link from the db.
   */
  function deleteLink($linkshortcut_id){
    $sql = "DELETE FROM $this->table_name WHERE linkshortcut_id = $linkshortcut_id";
    $this->db->query($sql);
    return true;
  }

  /**
   * generate and return random alphanumeric string to act as a DB and user-facing URL identifier.
   * checks if ident is already being used and loops until a unique string is generated.
   */
  function _generateIdent($length){
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    $ident = "";
    for ($p = 0; $p < $length; $p++) {
        $ident .= $characters[mt_rand(0, strlen($characters))];
    }
    if($this->_checkIdent($ident)){
      //already exists, create another
      $this->_generateIdent($length);
    } else {
      //does not exist, we're done
      return $ident;
    }
  }

  /**
   * query database to see if ident exists, return false if doesn't exist
   */
  function _checkIdent($ident){
    $sql = "SELECT linkshortcut_id FROM $this->table_name WHERE ident = '$ident'";
    $id = $this->db->get_var($sql);
    if($id == ""){
      return false;
    } else {
      return true;
    }
  }

}

?>
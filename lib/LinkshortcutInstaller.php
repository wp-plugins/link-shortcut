<?
/**
 * Installation and removal of Linkshortcut-specific DB tables and options.  Uses LinkshortcutDataManager for inserts as required.
 */
class LinkshortcutInstaller{

  var $db;

  /**
   * constructor
   */
  function LinkshortcutInstaller(){
    //set up db connectivity and other class-wide variables
    global $wpdb;
    $this->db = $wpdb;
    $this->table_name = $wpdb->prefix . "linkshortcut";
  }

  /**
   * create table, records, and settings necessary for plugin to work
   */
  function doInstall(){
    //if table doesn't exist, build it and create default records
    if($this->db->get_var("SHOW TABLES LIKE '".$this->table_name."'") != $this->table_name){
      $this->_createTable();
      $this->_createDefaultRecords();
    }
  }

  /**
   * remove linkshortcut's table, records, and settings
   */
  function doUninstall(){
    if($this->db->get_var("SHOW TABLES LIKE '".$this->table_name."'") == $this->table_name){
      $this->_removeTable();
      $this->_removeSettings();
    }
  }

  /**
   * create linkshortcut table.  for now, we're just assuming no SQL errors.  will revise in future versions.
   */
  function _createTable(){
    $sql = "CREATE TABLE " . $this->table_name . " (
	   linkshortcut_id  INT UNSIGNED NOT NULL auto_increment,
	   ident  CHAR(8) NOT NULL,
	   url  TEXT NOT NULL,
	   name  VARCHAR(128) NOT NULL,
	   PRIMARY KEY (linkshortcut_id)
	   )";
    $this->db->query($sql);
  }

  /**
   * insert default example record into db
   */
  function _createDefaultRecords(){
    $LinkshortcutDataManager = new LinkshortcutDataManager;
    $LinkshortcutDataManager->addLink('http://www.husani.com', 'Example of a link shortcut.');
  }

  /**
   * remove linkshortcut table.  assumes check for table already occured and returned successfully.
   */
  function _removeTable(){
    $sql = "DROP TABLE " . $this->table_name;
    $this->db->query($sql);
  }

  /**
   * remove settings
   */
  function _removeSettings(){
    
  }


}

?>
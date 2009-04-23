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
      $this->_createDefaultSettings();
      $this->_createDefaultRecords();
    }
  }

  /**
   * remove linkshortcut's table, records, and settings after backing up to another table
   */
  function doUninstall(){
    if($this->db->get_var("SHOW TABLES LIKE '".$this->table_name."'") == $this->table_name){
      //create backup table and copy records to it
      $this->_createBackup();
      //remove production table and settings
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
	   ident  VARCHAR(255) NOT NULL,
	   url  TEXT NOT NULL,
	   name  VARCHAR(128) NOT NULL,
	   PRIMARY KEY (linkshortcut_id)
	   )";
    $this->db->query($sql);
  }

  /**
   * create default settings for plugin
   */
  function _createDefaultSettings(){
    add_option('linkshortcut_length', '8');
    add_option('linkshortcut_subdir', '');
    add_option('linkshortcut_redirecttype', '301');
  }

  /**
   * insert default example record into db and restore from backup if necessary
   */
  function _createDefaultRecords(){
    //if we're restoring from backup, do so.  if not, insert default test record.
    if($this->db->get_var("SHOW TABLES LIKE '".$this->table_name."_backup'") == $this->table_name . "_backup"){
      $sql = "INSERT INTO " . $this->table_name . " SELECT * FROM $this->table_name" . "_backup";
      $this->db->query($sql);
      $sql = "DROP TABLE " . $this->table_name . "_backup";
      $this->db->query($sql);
    } else {
      $LinkshortcutDataManager = new LinkshortcutDataManager;
      $LinkshortcutDataManager->addLink('http://www.husani.com', 'Example of a link shortcut.');
    }
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
    delete_option('linkshortcut_length');
    delete_option('linkshortcut_subdir');
    delete_option('linkshortcut_redirecttype');
  }

  /**
   * create linkshortcut BACKUP table.
   */
  function _createBackup(){
    $sql = "CREATE TABLE " . $this->table_name . "_backup LIKE $this->table_name";
    $this->db->query($sql);
    $sql = "INSERT INTO " . $this->table_name . "_backup SELECT * FROM $this->table_name";
    $this->db->query($sql);
  }


}

?>
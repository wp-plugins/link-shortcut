<?
/** so that we can have separate files for list/edit/delete/etc, the admin hook points to THIS file.  if we
are editing, we'll depending on the query string, we include the proper UI file.*/

?>

<div class="wrap">
  <h2><?=$page_title?></h2>
  <table class="widefat fixed" cellspacing="0">
    <thead>
      <tr>
	<th scope="col" id="title" class="column-cb" style="width:10em"></th>
	<th scope="col" id="title" class="manage-column" style="">Name</th>
	<th scope="col" id="categories" class="manage-column" style="">Link</th>
	<th scope="col" id="author" class="manage-column" style="">URL</th>
      </tr>
    </thead>

    <tbody>
      <?foreach($links_array as $link_array){?>
         <tr class="<?=$alt?>" valign="top">
	   <td><a href="<?=$_SERVER['PHP_SELF']?>?page=linkshortcut_list&action=edit&linkshortcut_id=<?=$link_array['linkshortcut_id']?>"><strong>edit</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=$_SERVER['PHP_SELF']?>?page=linkshortcut_list&action=delete&linkshortcut_id=<?=$link_array['linkshortcut_id']?>" onclick="if ( confirm('You are about to delete this link \'<?=$link_array['name']?>\'\n \'Cancel\' to stop, \'OK\' to delete.') ) { return true;}return false;"><strong>delete</strong></a></td>
	   <td><strong><?=$link_array['name']?></strong></td>
	   <td><a href="<?=get_bloginfo('siteurl')?>/<?=$link_array['ident']?>" target="_blank"><strong><?=get_bloginfo('siteurl')?>/<?=$link_array['ident']?></strong></a></td>
	   <td><a href="<?=$link_array['url']?>" target="_blank"><strong><?=$link_array['url']?></strong></a></td>
	 </tr>
      <?}?>
    </tbody>

    <tfoot>
      <tr>
	<th scope="col" id="title" class="column-cb" style="width:8em"></th>
	<th scope="col" id="title" class="manage-column" style="">Name</th>
	<th scope="col" id="categories" class="manage-column" style="">Link</th>
	<th scope="col" id="author" class="manage-column" style="">URL</th>
      </tr>
    </tfoot>
  </table>
</div>

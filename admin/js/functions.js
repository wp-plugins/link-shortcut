/**
 * jQuery goodness for admin panel UI
 */
jQuery(document).ready( function($) {
	
	$('input#ident_random').click(
				      function(){
					  if($('p#ident_random_msg').css('display') == "none"){
					      //show random
					      $('p#ident_random_msg').css('display', 'block');
					      //hide custom
					      $('p#ident_custom_msg').css('display', 'none');
					  }
				      }
				      );

	$('input#ident_custom').click(
				      function(){
					  if($('p#ident_custom_msg').css('display') == "none"){
					      //show custom
					      $('p#ident_custom_msg').css('display', 'block');
					      //hide random
					      $('p#ident_random_msg').css('display', 'none');
					  }
				      }
				      );

	$('input#ident_custom_input').blur(
					   function(){
					       $.get(
						     "/wp-admin/admin-ajax.php",
						     {action:"linkshortcut_check_ident",linkshortcut_ident:$('input#ident_custom_input').val()},
						     function(str)
						     {
							 //display ident status
							 if(str == "true"){
							     $('input#ident_custom_input_status').val('0');
							     $('span#ident_custom_input_status_msg').text('Not available or invalid!  Try again.').css('color','red');
							     //set border color since we've having validation/ajax timing issues
							     $('input#ident_custom_input').css('border-color', 'red');
							 } else {
							     $('input#ident_custom_input_status').val('1');
							     $('span#ident_custom_input_status_msg').text('Available!').css('color','green');
							     //reset border color since we've having validation/ajax timing issues
							     $('input#ident_custom_input').css('border-color', '#dfdfdf');
							 }
						     });
					   }
					   );
	
	$('form#linkshortcut_form').submit(
					  function(){
					      var err_count = 0;
					      var errors = new Array;
					      
					      if($(this).attr("class") == "linkshortcut_add"){ //radio buttons for ident in ADD only
					      
						  if(parseFloat(jQuery.fn.jquery) > parseFloat(1.3)){
						      //no @
						      var var_name = $("input[name='ident_type']:checked").val();
						  } else {
						      //use @
						      var var_name = $("input[@name='ident_type']:checked").val();
						  }
						  if(var_name){
						      //one is checked.  if it's custom, make sure the custom field is filled out AND verified by ajax
						      if(var_name == "custom"){
							  if($('input#ident_custom_input_status').val() == "0"){
							      //not filled out OR not valid
							      $('input#ident_custom_input').css('border-color', 'red');
							      errors[errors.length] = "Custom Shortcut URL";
							      err_count++;
							  } else {
							      //filled out and valid
							      $('input#ident_custom_input').css('border-color', '#dfdfdf');
							  }
						      }
						      $('fieldset#shortcut_url').css('border', '0');
						  } else {
						      //neither is checked.
						      $('fieldset#shortcut_url').css('border', '1px solid red');
						      errors[errors.length] = "Shortcut URL";
						      err_count++;
						  }
						  
					      } //endif ADD

					      if($('input#linkshortcut_url').val() == ""){
						  $('input#linkshortcut_url').css('border-color', 'red');
						  errors[errors.length] = "Web Address to Shortcut";
						  err_count++;
					      } else {
						  $('input#linkshortcut_url').css('border-color', '#dfdfdf');
					      }
					      if($('input#linkshortcut_name').val() == ""){
						  $('input#linkshortcut_name').css('border-color', 'red');
						  errors[errors.length] = "Shortcut Name";
						  err_count++;
					      } else {
						  $('input#linkshortcut_name').css('border-color', '#dfdfdf');
					      }
					      if(err_count >= 1){
						  //iterate through error messages and display each.
						  var div = document.createElement('div');
						  div.className = "error";
						  div.innerHTML = "<p><b>Sorry, the following fields have no values:</b></p>";
						  var ul = document.createElement('ul');
						  ul.setAttribute('style', 'list-style-type: disc');
						  ul.setAttribute('style', 'margin: 5px');
						  ul.setAttribute('style', 'padding: 5px');
						  $.each(
							 errors,
							 function(index, value){
							     var li = document.createElement('li');
							     li.innerHTML = value;
							     ul.appendChild(li);
							 }
							 );
						  div.appendChild(ul);
						  document.getElementById("error_container").appendChild(div);
						  return false;
					      } else {
						  return true;
					      }
					  }
					  );

});
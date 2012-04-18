<?php 

	echo form_open('user', array('id' => 'login_form'));
	
	// an array of the fields in the student table
	$field_array = array('username' => 'Username','password' => 'Password');
	foreach($field_array as $field => $label) {
		echo '<p>';
		echo form_label($label, $field);
		if (substr($label,0,8) == 'Password') {
			echo form_password(array('name' => $field, 'id' => $field ));
		} else {
			echo form_input(array('name' => $field, 'id' => $field, 'value' => set_value($field) ));
		}
		echo '</p>';
	}
	
	// not setting the value attribute omits the submit from the $_POST array
	echo form_submit('', 'Login'); 
	
	echo form_close();

/* End of file user_login.php */
/* Location: ./system/application/views/user_login.php */
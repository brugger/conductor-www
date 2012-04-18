<?php 

	echo form_open('analysis/update');
	
	// an array of the fields in the student table
       $field_array = array('descr' => 'Description','pipeline' => 'Pipeline', 'reference' => 'Reference', 'min_reads' => 'Minimum reads');
	
	echo form_hidden('aid', $row[0]->aid);
	
	foreach($field_array as $field => $label) {
	  echo '<p>';
	  echo form_label($label, $field);
	  	  echo form_input(array('name' => $field, 'value' => $row[0]->$field));
	  echo '</p>';
	}
	
	// not setting the value attribute omits the submit from the $_POST array
	echo form_submit('', 'Update'); 
	
	echo form_close();

/* End of file student_edit.php */
/* Location: ./system/application/views/student_edit.php */
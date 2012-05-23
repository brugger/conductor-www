<?php 

	echo form_open('analysis/create');
	
	// an array of the fields in the student table
       $field_array = array('descr' => 'Description','pipeline' => 'Pipeline', 'min_reads' => 'Minimum reads');
	
	foreach($field_array as $field => $label) {
	  echo '<p>';
	  echo form_label($label, $field);
	  echo form_input(array('name' => $field, 'value' => set_value($field)));
	  echo '</p>';
	}
	
	// not setting the value attribute omits the submit from the $_POST array
	echo form_submit('', 'Add'); 
	
	echo form_close();

/* End of file student_add.php */
/* Location: ./system/application/views/student_add.php */
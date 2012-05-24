<?php 


	echo form_open('project/create');
	
	// an array of the fields in the student table
	$field_array = array('name' => 'Project Name','notes' => 'Notes');

	
	foreach($field_array as $field => $label) {
	  echo '<p>';
	  echo form_label($label, $field);
	  echo form_input(array('name' => $field, 'value' => set_value($field)));
	  echo '</p>';
	}



//      $analysis_array;// = array();
      foreach ($analyses->result() as $analysis) {
	$analysis_array[ $analysis->aid ] = $analysis->descr ."( $analysis->pipeline, $analysis->min_reads reads)";
       }

      echo form_dropdown('aid', $analysis_array);
      echo "<br>";

	// not setting the value attribute omits the submit from the $_POST array
	echo form_submit('', 'Add'); 
	
	echo form_close();

/* End of file student_add.php */
/* Location: ./system/application/views/student_add.php */
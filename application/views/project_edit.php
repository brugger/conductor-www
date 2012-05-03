<?php 

	echo form_open('project/update');
	
	// an array of the fields in the student table
	$field_array = array('name' => 'Project Name','notes' => 'Notes');
	
	echo form_hidden('pid', $row[0]->pid);
	
	foreach($field_array as $field => $label) {
	  echo '<p>';
	  echo form_label($label, $field);
	  	  echo form_input(array('name' => $field, 'value' => $row[0]->$field));
	  echo '</p>';
	}
	
      $analysis_array[ 'NULL' ] = "None";

      foreach ($analyses->result() as $analysis) {
	$analysis_array[ $analysis->aid ] = $analysis->descr ." ($analysis->pipeline, $analysis->reference, $analysis->min_reads reads)";
       }

      echo form_dropdown('aid', $analysis_array, $row[0]->aid);
      echo "<br>";
	// not setting the value attribute omits the submit from the $_POST array
	echo form_submit('', 'Update'); 
	
	echo form_close();

/* End of file student_edit.php */
/* Location: ./system/application/views/student_edit.php */
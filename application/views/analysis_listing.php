<?php
	echo $data_table;

	if (in_array('admin', $groups)) {
		echo '<br />';
		echo anchor('analysis/add', 'Add new analysis');
	}


/* End of file student_listing.php */
/* Location: ./system/application/views/student_listing.php */
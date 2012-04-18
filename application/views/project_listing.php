<?php
	echo $data_table;

	if (!$is_admin) {
		echo '<br />';
		echo anchor('project/add', 'Add new project');
	}


/* End of file student_listing.php */
/* Location: ./system/application/views/student_listing.php */
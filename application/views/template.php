<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="http://localhost/~kb468/CodeIgniter_2.1.0/assets/css/screen.css" rel="stylesheet" type="text/css" />
<!--  the following lines load the jQuery library + plugins and the conductor JavaScript file -->
<script src="http://localhost/~kb468/conductor/assets/js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="http://localhost/~kb468/conductor/assets/js/global.js" type="text/javascript"></script>
<script src="http://localhost/~kb468/conductor/assets/js/jquery.jeditable.js" type="text/javascript" charset="utf-8"></script>
<title><?php echo $title;?></title>
</head>
<body>

	<div class="navigation">
	<?php 
		// nav bar
		// loggend in
		if ($uid) {
		  if (in_array('easih', $groups)) {
			  if ($this->router->class == "project" ) {
			    echo "<b>Projects:</b> ";
			    echo anchor('project/listing', 'List');
			    echo (' | ');
			    echo anchor('project/add', 'Add');
			    echo (' | ');
			  }
			  elseif ($this->router->class == "analysis" ) {
			    echo "<b>Analysis:</b> ";
			    echo anchor('analysis/listing', 'List');
			    echo (' | ');
			    echo anchor('analysis/add', 'Add');
			    echo (' | ');
			  }
			  else {
			    echo anchor('project/listing', 'List All Projects');
			    echo (' | ');
			    echo anchor('analysis/listing', 'List All Analyses');
			    echo (' | ');
			  }			    
			} else {
				echo anchor('project/listing', 'List All Projects');
				echo (' | ');
				echo anchor('activity/user_class_listing', 'List Class Activities');
				echo (' | ');
			}
			echo anchor('project', 'Home');
			echo (' | ');
			echo anchor('user/logout', 'Logout');
		// not logged in
		} else {
			echo anchor('user', 'Login');
			echo (' | ');
			echo anchor('user/register', 'Register');
		}
	?>
	</div>
	
	<h1><?php echo $headline;?></h1>
	<?php if (isset($error_message)) : echo '<div id="error_message">'.$error_message.'</div>'; endif;  ?>
	<?php if (isset($success_message)) : echo '<div id="success_message">'.$success_message.'</div>'; endif;  ?>
	<br />
	<?php $this->load->view($include);?>

</body>
</html>

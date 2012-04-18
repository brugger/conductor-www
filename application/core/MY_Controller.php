<?php


class MY_Controller extends CI_Controller {

 function __construct()  {
   parent::__construct();
  
      if (!$this->session->userdata('uid')) {
	header('Location: user/');
     }
 }

}

/* End of file MY_Controller.php */
/* Location: ./system/application/library/MY_Controller.php */

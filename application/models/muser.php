<?php 

class MUser extends CI_Model {


  $EASIH_users = $this->load->database('EASIH_users', TRUE);
  $customers   = $this->load->database('customers',   TRUE);

	// Authenticate a user login
  public function authenticate_user($username, $password, &$uid, &$is_admin) {
    $this->db->select('id, is_admin');
    $this->db->where('username', $username);
    $this->db->where('password', md5($password));
    $this->db->from('user');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $row = $query->row();
      $uid = $row->id;
      $is_admin = $row->is_admin;
      return TRUE;
    } else {
      return FALSE;
    }
  }

	// Check if username exists
  public function username_exists($username) {
    $this->db->where('username', $username);
    $this->db->from('user');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
	}

	// Create user record in database
  public function add_user($username, $password, &$uid, &$is_admin) {
    $this->db->insert('user', array('username'=>$username, 'password'=>md5($password)));
    
    $this->db->select('id');
    $this->db->where('username', $username);
    $this->db->from('user');
    $query = $this->db->get();
    $row = $query->row();
    $uid = $row->id;
    
    $is_admin = FALSE;
  }

}

/* End of file muser.php */
/* Location: ./system/application/models/muser.php */

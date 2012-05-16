<?php 

class MUser extends CI_Model {


#  $EASIH_users = $this->load->database('EASIH_users', TRUE);
#  $customers   = $this->load->database('customers',   TRUE);

  // Authenticate a user login
  public function authenticate_user($username, $password, &$uid, &$groups) {
    $this->db->select('id');
    $this->db->where('username', $username);
    $this->db->where('password', md5($password));
    $this->db->from('user');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $row = $query->row();
      $uid = $row->id;
      $query = $this->db->query("SELECT groupname FROM user u, groups g, user_group ug WHERE u.username = '$username'  AND u.id=ug.user_id AND ug.group_id=g.id");
      
      foreach ($query->result() as $row)
	$groups[] = $row->groupname;

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
  public function add_user($username, $password, &$uid, &$groups) {
    $this->db->insert('user', array('username'=>$username, 'password'=>md5($password)));
    
    $this->db->select('id');
    $this->db->where('username', $username);
    $this->db->from('user');
    $query = $this->db->get();
    $row = $query->row();
    $uid = $row->id;
    
    $groups = FALSE;
  }

}

/* End of file muser.php */
/* Location: ./system/application/models/muser.php */

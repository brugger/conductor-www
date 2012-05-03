<?php 

class MSample extends CI_Model {

	// Create sample record in database
  public function add_sample($data) {
    $this->db->insert('sample', $data);
  }
	
  
  // Retrieve all sample records 
  public function list_all_samples() {
    
    return $this->db->get('sample');
	}
  
  // Retrieve one sample record
  public function get_sample($pid) {
	  return $this->db->get_where('sample', array('sid'=> $sid));
  }
  
  // Update one sample record
  public function update_sample($pid, $data) {
    $this->db->where('pid', $pid);
    $this->db->update('sample', $data); 
  }
  
	// Delete one sample record
  public function delete_sample($id) {
    $this->db->where('id', $id);
    $this->db->delete('sample'); 
  }

  public function get_full_sample( $sid ) {
    $this->db->query( "SELECT * FROM sample, "  );
  }

  
}
/* End of file mstudent.php */
/* Location: ./system/application/models/mstudent.php */
<?php 

class MProject extends CI_Model {

	// Create project record in database
  public function add_project($data) {
    $this->db->insert('project', $data);
  }
	
  
  // Retrieve all project records 
  public function list_all_projects() {
    
    return $this->db->get('project');
  }
  
  // Retrieve one project record
  public function get_project($pid) {
    return $this->db->get_where('project', array('pid'=> $pid));
  }
  
  // Update one project record
  public function update_project($pid, $data) {
    $this->db->where('pid', $pid);
    $this->db->update('project', $data); 
  }
  
	// Delete one project record
  public function delete_project($pid) {
    $this->db->where('pid', $pid);
    $this->db->delete('project'); 
  }

  public function status($pid) {
    $query = $this->db->query('YOUR QUERY HERE');
  }


  

}
/* End of file mstudent.php */
/* Location: ./system/application/models/mstudent.php */
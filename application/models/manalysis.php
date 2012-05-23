<?php 

class MAnalysis extends CI_Model {

	// Create analysis record in database
  public function add_analysis($data) {
    $this->db->insert('analysis', $data);
  }
	
  
  // Retrieve all analysis records 
  public function list_all_analysis() {
    
    return $this->db->get('analysis');
  }
  
  // Retrieve one analysis record
  public function get_analysis($aid) {
    return $this->db->get_where('analysis', array('aid'=> $aid));
  }
  
  // Update one analysis record
  public function update_analysis($aid, $data) {
    $this->db->where('aid', $aid);
    $this->db->update('analysis', $data); 
  }
  
	// Delete one analysis record
  public function delete_analysis($id) {
    $this->db->where('id', $id);
    $this->db->delete('analysis'); 
  }
  
}
/* End of file mstudent.php */
/* Location: ./system/application/models/mstudent.php */
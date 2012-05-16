<?php 

class MProject extends CI_Model {

  // Create project record in database
  public function add_project($data) {
    $this->db->insert('project', $data);
  }
	
  
  // Retrieve all project records 
  public function list_all_projects() {
    $this->db->order_by('name');
    return $this->db->get('project');
    
  }
  
  // Retrieve one project record
  public function get_project($pid) {
    return $this->db->get_where('project', array('pid'=> $pid));
  }
  
  // Update one project record
  public function update_project($pid, $data) {
    if ( $data['status']) {
      $this->update_status($pid, $data['status']);
      unset($data['status']);
    }

    $this->db->where('pid', $pid);
    $this->db->update('project', $data); 
#    echo $this->db->last_query(); 
  }


  public function update_status($pid, $new_status) {
    $last_status = $this->last_status($pid)->status;
    // The status has not changed since last time
    if ( $last_status == $new_status) 
      return;
    $data['pid']    = $pid;
    $data['status'] = $new_status;
    $data['stamp'] = time()*100000;
    $this->db->insert('project_status', $data);
#    echo $this->db->last_query(); 
  }
  
	// Delete one project record
  public function delete_project($pid) {
    $this->db->where('pid', $pid);
    $this->db->delete('project'); 
  }

  public function statuses($pid) {
    $query = $this->db->query("select * from project_status where pid = '$pid' order by stamp desc");
    $statuses = null;
    foreach ($query->result() as $row)
      $statuses[] = $row;

    if ( !$statuses ) {
      $statuses[0]->pid = $pid;
      $statuses[0]->status = "Unknown";
      $statuses[0]->stamp = 0;
    }


    return $statuses;
  }

  public function last_status($pid) {
    $statuses = $this->statuses( $pid );
    return $statuses[0];
  }

  public function status_list() {
    $query = $this->db->query("select distinct(status) from project_status");
    $statuses = null;
    foreach ($query->result() as $row)
      $statuses[] = $row;

    return $statuses;
  }

}
/* End of file mstudent.php */
/* Location: ./system/application/models/mstudent.php */
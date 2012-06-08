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

  public function in_project( $pid ) {
    return $this->db->get_where('sample', array('pid'=> $pid));
  }


  public function project_samples_last_status( $pid ) {
    $sids_qry = $this->in_project( $pid );
    
#    print var_dump( $sids_qry );

    foreach ( $sids_qry->result() as $sid) {
      
#      print var_dump( $sid ) . "<BR>";

      $status = $this->db->query("select * from sample_status where sid=" . $sid->sid . " order by stamp DESC limit 1;");
      $status = $status->result();
      print var_dump( $status ) . "<BR>";
      $res[ $sid->sid]  = $status->status;
    }

    print var_dump( $res );

  }

  public function samples( $pid ) {
    $this->db->where('pid', $pid);
    

  }

  
  
}
/* End of file mstudent.php */
/* Location: ./system/application/models/mstudent.php */
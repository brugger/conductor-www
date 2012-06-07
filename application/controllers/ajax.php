<?php

class Ajax extends MY_Controller {

  public function Project() {
    parent::__construct();
  }


  public function save_project() {
    
    $this->load->model('MProject','',TRUE);

    list($field, $pid) = explode('_', $_POST['id']);
    $new_value    = $_POST['value'];
    $data[$field] = $new_value;
    
    $this->MProject->update_project($pid, $data);
    
    if ( $field == "aid") {
      $this->load->model('MAnalysis','',TRUE);
      $analysis = $this->MAnalysis->get_analysis($new_value)->result();
      $new_value = $analysis[0]->descr;
    }

    print "$new_value";
  }



  public function project_statuses() {

     $this->load->model('MProject','',TRUE);
     list($field, $pid) = explode('_', $_GET['id']);
     $last_status = $this->MProject->last_status( $pid );
     $statuses = $this->MProject->status_list();
     foreach ($statuses as $status) 
       $array[$status->status] = $status->status;
     $array['selected'] =  $last_status->status;
     
     print json_encode( $array );
  }

  public function analyses() {
    
    $this->load->model('MAnalysis','',TRUE);
    $analyses = $this->MAnalysis->list_all_analysis()->result();

    foreach ($analyses as $analysis) 
      $array[$analysis->aid] = $analysis->descr;
    
    print json_encode($array);
  }



  public function save_analysis() {
    
    $this->load->model('MAnalysis','',TRUE);

    $_POST['id'] = strrev($_POST['id']);
    list($aid, $field) = explode('_', $_POST['id'], 2);
    $field = strrev( $field );
    $aid   = strrev( $aid   );

    $data[$field] = $_POST['value'];
    $this->MAnalysis->update_analysis($aid, $data);
    
    print $_POST['value'];
  }


}

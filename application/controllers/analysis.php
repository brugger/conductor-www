<?php

class Analysis extends CI_Controller {

  public function Analysis() {
	  
    parent::__construct();
  }


  public function index()  {
    // redirect to the listing page
    $this->listing();
  }
	
  public function add()  {
    $this->load->helper('form');
		
    // display information for the view
    $data['title'] = "Classroom: Add Analysis";
    $data['headline'] = "Add a New Analysis";
    $data['include'] = 'analysis_add';
    $data['uid'] = $this->session->userdata('uid');
    $data['is_admin'] = $this->session->userdata('is_admin');
    
    $this->load->view('template', $data);
  }
	
  public function create() {
    $this->load->helper('url');
    
    $this->load->model('MAnalysis','',TRUE);
    $this->MAnalysis->add_analysis($_POST);
    redirect('analysis/listing','refresh');
  }
	
  public function listing() {
    $this->load->library('table');
	  
    $this->load->model('MAnalysis','',TRUE);
    $analysis_qry = $this->MAnalysis->list_all_analysis();

    // generate HTML table from query results
    $tmpl = array (
		   'table_open' => '<table>',
		   'heading_row_start' => '<tr class="analysis_header">',
		   'row_start' => '<tr class="odd_row">' 
		   );
    $this->table->set_template($tmpl); 
    
    $this->table->set_empty("&nbsp;"); 
		
    $this->table->set_heading('', 'Description', 'Pipeline', 'Reference', 'Min. reads' );
    
    $table_row = array();
    foreach ($analysis_qry->result() as $analysis) {
      
      $table_row = NULL;
      $table_row[] = '<span style="white-space: nowrap">' . 
		anchor('analysis/edit/' . $analysis->aid, 'edit') . ' | ' .
	anchor('analysis/delete/' . $analysis->aid, 'delete',
	       "onclick=\" return confirm('Are you sure you want to '
				+ 'delete the record for ".addslashes($analysis->descr)."?')\"") .
	'</span>';
      
      $table_row[] = htmlspecialchars($analysis->descr);
      $table_row[] = htmlspecialchars($analysis->pipeline);
      $table_row[] = htmlspecialchars($analysis->reference);
      $table_row[] = htmlspecialchars($analysis->min_reads);

      $this->table->add_row($table_row);
    }    
    
    $analysis_table = $this->table->generate();
		
    // display information for the view
    $data['title']    = "Conductor: Analysis Listing";
    $data['headline'] = "Analysis Listing";
    $data['include']  = 'analysis_listing';
    $data['uid']      = $this->session->userdata('uid');
    $data['is_admin'] = $this->session->userdata('is_admin');
		
    $data['data_table'] = $analysis_table;
    
    $this->load->view('template', $data);
  }
		
  public function edit() {
    $this->load->helper('form');
    
    $id = $this->uri->segment(3);
    $this->load->model('MAnalysis','',TRUE);
    $data['row'] = $this->MAnalysis->get_analysis($id)->result();
		
    // display information for the view
    $data['title'] = "Conductor: Edit Analysis";
    $data['headline'] = "Edit Analysis Information";
    $data['include'] = 'analysis_edit';
    $data['uid'] = $this->session->userdata('uid');
    $data['is_admin'] = $this->session->userdata('is_admin');
    
    $this->load->view('template', $data);
  }
	
  public function update() {
    $this->load->model('MAnalysis','',TRUE);
    $this->MAnalysis->update_analysis($_POST['aid'], $_POST);
    redirect('analysis/listing','refresh');
  }
  
  public function delete() {
    $id = $this->uri->segment(3);
    
    $this->load->model('Manalysis','',TRUE);
    $this->MAnalysis->delete_analysis();
    redirect('analysis/listing','refresh');
    }
  
}


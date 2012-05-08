<?php

class Project extends CI_Controller {

  public function Project() {
	  
    parent::__construct();
  }


  public function index()  {
    // redirect to the listing page
    $this->listing();
  }
	
  public function add()  {
    $this->load->helper('form');

    $this->load->model('MAnalysis','',TRUE);
    $data['analyses'] = $this->MAnalysis->list_all_analysis();
		
    // display information for the view
    $data['title'] = "Classroom: Add Project";
    $data['headline'] = "Add a New Project";
    $data['include'] = 'project_add';
    $data['uid'] = $this->session->userdata('uid');
    $data['is_admin'] = $this->session->userdata('is_admin');
    
    $this->load->view('template', $data);
  }
	
  public function create() {
    $this->load->helper('url');
    
    $this->load->model('MProject','',TRUE);
    $this->MProject->add_project($_POST);
    redirect('project/listing','refresh');
  }
	
  public function listing() {
    $this->load->library('table');
	  
    $this->load->model('MAnalysis','',TRUE);
    $this->load->model('MProject','',TRUE);
    $projects_qry = $this->MProject->list_all_projects();

    // generate HTML table from query results
    $tmpl = array (
		   'table_open' => '<table>',
		   'heading_row_start' => '<tr class="project_header">',
		   'row_start' => '<tr class="odd_row">' 
		   );
    $this->table->set_template($tmpl); 
    
    $this->table->set_empty("&nbsp;"); 
		
    $this->table->set_heading('', 'ID', 'Notes', 'Analysis');
    
    $table_row = array();
    foreach ($projects_qry->result() as $project) {
      
      $table_row = NULL;
      $table_row[] = '<span style="white-space: nowrap">' . 
		anchor('project/edit/' . $project->pid, 'edit') . ' | ' .
	anchor('project/delete/' . $project->pid, 'delete',
	       "onclick=\" return confirm('Are you sure you want to '
				+ 'delete the record for ".addslashes($project->name)."?')\"") .
	'</span>';
      
      $table_row[] = htmlspecialchars($project->name);
      $table_row[] = '<div class="edit" id="notes">'.htmlspecialchars($project->notes).'</div>';
      $table_row[] = '<div class="edit" id="organism">'.htmlspecialchars($project->organism).'</div>';
      $table_row[] = '<div class="edit" id="contacts">'.htmlspecialchars($project->contacts).'</div>';

      $analysis = 'None';
      if ( $project->aid ) {
        $analyses = $this->MAnalysis->get_analysis($project->aid)->result();
	$analysis = $analyses[0]->descr;
      }
      $table_row[] = htmlspecialchars($analysis);

      $this->table->add_row($table_row);
    }    
    
    $projects_table = $this->table->generate();
		
    // display information for the view
    $data['title']    = "Classroom: Project Listing";
    $data['headline'] = "project Listing";
    $data['include']  = 'project_listing';
    $data['uid']      = $this->session->userdata('uid');
    $data['is_admin'] = $this->session->userdata('is_admin');
		
    $data['data_table'] = $projects_table;
    
    $this->load->view('template', $data);
  }
		
  public function edit() {
    $this->load->helper('form');

    $this->load->model('MAnalysis','',TRUE);
    
    $id = $this->uri->segment(3);
    $this->load->model('MProject','',TRUE);
    $data['row'] = $this->MProject->get_project($id)->result();
		
    // display information for the view
    $data['title'] = "Conductor: Edit Project";
    $data['headline'] = "Edit Project Information";
    $data['include'] = 'project_edit';
    $data['analyses'] = $this->MAnalysis->list_all_analysis();
    $data['uid'] = $this->session->userdata('uid');
    $data['is_admin'] = $this->session->userdata('is_admin');
    
    $this->load->view('template', $data);
  }
	
  public function update() {
    $this->load->model('MProject','',TRUE);
    $this->MProject->update_project($_POST['pid'], $_POST);
    redirect('project/listing','refresh');
  }
  
  public function delete() {
    $id = $this->uri->segment(3);
    
    $this->load->model('Mproject','',TRUE);
    $this->MProject->delete_project();
    redirect('project/listing','refresh');
    }


  public function status($pid) {
    $this->load->library('table');
	  
    $this->load->model('MAnalysis','',TRUE);
    $this->load->model('MProject','',TRUE);
    $this->load->model('MSample','',TRUE);


    $id = $this->uri->segment(3);
    $this->load->model('MProject','',TRUE);
    $data['row'] = $this->MProject->get_project($id)->result();


    $projects_qry = $this->MProject->list_all_projects();

    // generate HTML table from query results
    $tmpl = array (
		   'table_open' => '<table>',
		   'heading_row_start' => '<tr class="project_header">',
		   'row_start' => '<tr class="odd_row">' 
		   );
    $this->table->set_template($tmpl); 
    
    $this->table->set_empty("&nbsp;"); 
		
    $this->table->set_heading('', 'Project ID', 'Notes', 'Analysis');
    
    $table_row = array();
    foreach ($projects_qry->result() as $project) {
      
      $table_row = NULL;
      $table_row[] = '<span style="white-space: nowrap">' . 
		anchor('project/edit/' . $project->pid, 'edit') . ' | ' .
	anchor('project/delete/' . $project->pid, 'delete',
	       "onclick=\" return confirm('Are you sure you want to '
				+ 'delete the record for ".addslashes($project->name)."?')\"") .
	'</span>';
      
      $table_row[] = htmlspecialchars($project->name);
      $table_row[] = '<div class="edit" id="notes">'.htmlspecialchars($project->notes).'</div>';
      $table_row[] = '<div class="edit" id="organism">'.htmlspecialchars($project->organism).'</div>';
      $table_row[] = '<div class="edit" id="contacts">'.htmlspecialchars($project->contacts).'</div>';

      $analysis = 'None';
      if ( $project->aid ) {
        $analyses = $this->MAnalysis->get_analysis($project->aid)->result();
	$analysis = $analyses[0]->descr;
      }
      $table_row[] = htmlspecialchars($analysis);

      $this->table->add_row($table_row);
    }    
    
    $projects_table = $this->table->generate();
		
    // display information for the view
    $data['title']    = "Classroom: Project Listing";
    $data['headline'] = "project Listing";
    $data['include']  = 'project_listing';
    $data['uid']      = $this->session->userdata('uid');
    $data['is_admin'] = $this->session->userdata('is_admin');
		
    $data['data_table'] = $projects_table;
    
    $this->load->view('template', $data);
  }
 
}


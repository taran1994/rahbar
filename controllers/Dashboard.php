<?php
require APPPATH . 'libraries/REST_Controller.php';

class Dashboard  extends CI_Controller {
  function __construct(){
    parent::__construct();
	$this->load->database();
    $this->load->model("UsersModel", "users");
	$this->load->model("UserTypesModel", "userTypes");
    if(!$this->session->userdata('uid'))
    	redirect('/');
  }
  public function index(){
		$user_type=$this->session->userdata('userType');
		if($user_type=='Students'){
			$this->studentDashboardPanel();
		}else if($user_type=='Sponsors'){
			$this->sponsorDashboardPanel();
		}else if($user_type=='Admins'){
			$this->adminDashboardPanel();
		}else if($user_type=='Coordinators'){
			$this->coordinatorDashboardPanel();
		}else if($user_type=='Selectors'){
			$this->selectorDashboardPanel();
		}
		
  }


  private function adminDashboardPanel(){
	$data['dashboard_header'] = "Welcome to Admin Dashboard";
	$data['page_title'] = "Rahbar - Admin Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/admin_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}
private function sponsorDashboardPanel(){
	$data['dashboard_header'] = "Welcome to Sponsor Dashboard";
	$data['page_title'] = "Rahbar - Sponsor Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/sponsor_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}

private function studentDashboardPanel(){
	$data['dashboard_header'] = "Welcome to Student Dashboard";
	$data['page_title'] = "Rahbar - Student Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/student_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}

private function coordinatorDashboardPanel(){
	$data['dashboard_header'] = "Welcome to Coordinator Dashboard";
	$data['page_title'] = "Rahbar - Coordinator Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/coordinator_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}

private function selectorDashboardPanel(){
	$data['dashboard_header'] = "Welcome to Selector Dashboard";
	$data['page_title'] = "Rahbar - Selector Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/selector_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}
	
}
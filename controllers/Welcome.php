<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	 public function __construct() {
		parent::__construct();	
	}

	public function index(){
		if(!$this->session->userdata('uid')){
			$data['page_title'] = "RAHBAR - Login Page";
			$this->load->view('_Layout/login/header.php', $data); // Header File
			$this->load->view('auth/login'); // Main File (Body)
			$this->load->view('_Layout/login/footer.php'); 
			}else{
			redirect('dashboard');// Footer File // Footer File
			}
	}
}
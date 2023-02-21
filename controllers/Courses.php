<?php
require APPPATH . 'libraries/REST_Controller.php';

class Courses extends CI_Controller { 

	 public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        if(!$this->session->userdata('uid'))
        redirect('/');
        $this->load->database();
        $this->load->helper('url');
        //$this->load->model("SponsorProfileModel", "sponsor_profile");
        $this->load->model("CoursesModel", "courses");
        $this->load->model("EnrollmentModel", "enr");
        $ci = get_instance();
    }

    public function availableCourses() {
        $data['page_title'] = "Rahbar - Available Courses";
        $data['available_courses'] = $this->courses->getAvailableCourses();
        $data['available_enr'] = $this->enr->getAvailableEnrollments();
        $this->load->view('_Layout/dashboard/header.php', $data); // Header File
        $this->load->view('_Layout/dashboard/student_sidebar.php');
        //$user_type=$this->session->userdata('userType');
		// if($user_type=='Students'){
		// 	$this->load->view('_Layout/dashboard/student_sidebar.php'); // side File
		// }else if($user_type=='Sponsors'){
		// 	$this->load->view('_Layout/dashboard/sponsor_sidebar.php'); // side File
		// }else if($user_type=='Admins'){
		// 	$this->load->view('_Layout/dashboard/admin_sidebar.php'); // side File
		// }
        $this->load->view('student/available_courses'); // Main File (Body)
        $this->load->view('sponsor/sponsor_model'); 
        $this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
    }
}
?>
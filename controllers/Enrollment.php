<?php
require APPPATH . 'libraries/REST_Controller.php';

class Enrollment extends CI_Controller { 

	 public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        if(!$this->session->userdata('uid'))
        redirect('/');
        $this->load->database();
        $this->load->helper('url');
        //$this->load->model("SponsorProfileModel", "sponsor_profile");
        $this->load->model("EnrollmentModel", "enrollment");
        $ci = get_instance(); // CI_Loader instance
    }

    public function index() {
        $data['page_title'] = "Rahbar - Enrollment";
        $data['available_enrollments'] = $this->enrollment->getAvailableEnrollments();
        $this->load->view('_Layout/dashboard/header.php', $data); // Header File
        $this->load->view('_Layout/dashboard/sponsor_sidebar.php');
        $this->load->view('sponsor/available_enrollment'); // Main File (Body)
        $this->load->view('student/student_model'); 
        $this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
    }
}
?>
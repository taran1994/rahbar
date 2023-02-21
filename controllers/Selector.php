<?php
require APPPATH . 'libraries/REST_Controller.php';

class Selector extends CI_Controller { 

	 public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        if(!$this->session->userdata('uid'))
        redirect('/');
        $this->load->database();
        $this->load->helper('url');
        $this->load->model("CityModel", "city");
        $this->load->model("StateModel", "state");
        $this->load->model("CountryModel", "country");
        $this->load->model("SelectorProfileModel", "selector_profile");
        $this->load->model("StudentProfileModel", "student");
        $ci = get_instance(); // CI_Loader instance
        
    }

    public function myprofile() {
        $data['page_title'] = "Rahbar - Selector - My Profile";
        $data['cities'] = $this->city->getCities();
        $data['states'] = $this->state->getStates();
        $data['countries'] = $this->country->getCountries();
        $data['selector_profile'] = $this->selector_profile->getById($this->session->userdata('uid'));
        $this->load->view('_Layout/dashboard/header.php', $data); // Header File
        $this->load->view('_Layout/dashboard/selector_sidebar.php'); // side File
        $this->load->view('selector/myprofile'); // Main File (Body)
        $this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
    }

     public function relation() {

        $data['page_title'] = "Rahbar - Selector - Student Relation";  
        $data['students'] = $this->student->getAll();  
        $data['selectors'] = $this->selector_profile->getAll();  
        $this->load->view('_Layout/dashboard/header.php', $data); // Header File
        $this->load->view('_Layout/dashboard/selector_sidebar.php'); // side File
        $this->load->view('selector/relation'); // Main File (Body)
        $this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
    }
}
?>
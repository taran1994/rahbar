<?php
require APPPATH . 'libraries/REST_Controller.php';

class Admin extends CI_Controller { 

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
        $this->load->model("AdminProfileModel", "admin_profile");
        $ci = get_instance(); // CI_Loader instance
        
    }

    public function myprofile() {
        $data['page_title'] = "Rahbar - Admin - My Profile";
        $data['cities'] = $this->city->getCities();
        $data['states'] = $this->state->getStates();
        $data['countries'] = $this->country->getCountries();
        $data['admin_profile'] = $this->admin_profile->getById($this->session->userdata('uid'));
        $this->load->view('_Layout/dashboard/header.php', $data); // Header File
        $this->load->view('_Layout/dashboard/admin_sidebar.php'); // side File
        $this->load->view('admin/myprofile'); // Main File (Body)
        $this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
    }
}
?>
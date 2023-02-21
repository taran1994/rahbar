<?php
require APPPATH . 'libraries/REST_Controller.php';

class Email extends CI_Controller { 

    public function __construct() {
       header('Access-Control-Allow-Origin: *');
       header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
       parent::__construct();
       if(!$this->session->userdata('uid'))
       redirect('/');
       $this->load->database();
       $this->load->helper('url');
       $this->load->model("StateModel", "state");
       $ci = get_instance(); // CI_Loader instance
       
   }

   public function confirmation() {
    $data['page_title'] = "Rahbar - Confirmation";
    $this->load->view('_Layout/confirmation/header.php', $data); // Header File
    $this->load->view('dashboard/confirmation'); // Main File (Body)
    $this->load->view('_Layout/confirmation/footer.php'); // Footer File // Footer File
}

}
?>
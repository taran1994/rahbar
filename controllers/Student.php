<?php
require APPPATH . 'libraries/REST_Controller.php';

class Student extends CI_Controller { 

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
        $this->load->model("StudentProfileModel", "student_profile");
        $this->load->model("EnrollmentModel", "student_enrollment");
        $this->load->model("SponsorProfileModel", "sponser_model");
        $ci = get_instance(); // CI_Loader instance
    }

    public function myprofile() {
        $data['page_title'] = "Rahbar - Student - My Profile";
        $data['cities'] = $this->city->getCities();
        $data['states'] = $this->state->getStates();
        $data['countries'] = $this->country->getCountries();
        $data['student_profile'] = $this->student_profile->getById($this->session->userdata('uid'));
        $this->load->view('_Layout/dashboard/header.php', $data); // Header File
        $this->load->view('_Layout/dashboard/student_sidebar.php'); // side File
        $this->load->view('student/myprofile'); // Main File (Body)
        $this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
    }

      public function getSponser() {
        $courseId =  $_POST['courseId'];
         $sid = $this->session->userdata('uid');
         $Enrollment = $this->student_enrollment->getSponser($courseId,$sid);
         $sponser = $this->sponser_model->getById($Enrollment->created_by);
         $sponser = $sponser[0];
         

         ?>
         <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>First Name:</td>
                    <td><?php echo $sponser->first_name; ?></td>
                  </tr>
                  <tr>
                    <td>Last Name:</td>
                    <td><?php echo $sponser->last_name; ?></td>
                  </tr>
                  <tr>
                      <td>Country</td>
                      <td><?php echo $sponser->country; ?></td>
                    </tr>
                 
                    <tr>
                      <td>State</td>
                      <td><?php echo $sponser->state; ?></td>
                    </tr>
                    <tr>
                      <td>City</td>
                      <td><?php echo $sponser->city; ?></td>
                    </tr>
                     <tr>
                      <td>Address</td>
                      <td><?php echo $sponser->address; ?></td>
                    </tr>
                                     
                
                </tbody>
              </table>
              <?php
         
    }
}
?>
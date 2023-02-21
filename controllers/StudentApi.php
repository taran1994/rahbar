<?php
require APPPATH . 'libraries/REST_Controller.php';

class StudentApi extends REST_Controller {

    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        if(!$this->session->userdata('uid'))
        redirect('/');
        $this->load->database();
        $this->load->model("StudentProfileModel", "student_profile");
        $this->load->helper('url');
    }

    public function save_post(){
        $this->response($this->student_profile->save($this->input->post()) , 200);
    }

    public function update_put(){
        $this->response($this->student_profile->update($this->put()) , 200);
    }

    public function list_get(){
        $this->response($this->student_profile->lists() , 200);
    }

    public function byId_get(){
        $this->response($this->student_profile->getById($this->input->get('id'))[0] , 200);
    }
    
    public function detailById_get(){
        $this->response($this->student_profile->getDetailById($this->input->get('id'))[0] , 200);
    }

    public function del_delete(){
        $this->response($this->student_profile->delete($this->input->get('id')) , 200);
    }
}
?>

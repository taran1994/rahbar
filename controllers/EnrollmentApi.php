<?php
require APPPATH . 'libraries/REST_Controller.php';

class EnrollmentApi extends REST_Controller {

    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        if(!$this->session->userdata('uid'))
        redirect('/');
        $this->load->database();
        $this->load->model("EnrollmentModel", "enrollment");
        $this->load->model("CoursesModel", "courses");
        $this->load->helper('url');
    }

    public function save_post(){
        $this->response($this->enrollment->save($this->input->post()) , 200);
    }

    public function update_put(){
        $this->response($this->enrollment->update($this->put()) , 200);
    }

    public function list_get(){
        $this->response($this->enrollment->lists() , 200);
    }

    public function byId_get(){
        $this->response($this->enrollment->getById($this->input->get('id')) , 200);
    }

    public function del_delete(){
        $this->response($this->enrollment->delete($this->input->get('id')) , 200);
    }
}
?>

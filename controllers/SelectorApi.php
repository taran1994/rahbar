<?php
require APPPATH . 'libraries/REST_Controller.php';

class SelectorApi extends REST_Controller {

    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        if(!$this->session->userdata('uid'))
        redirect('/');
        $this->load->database();
        $this->load->model("SelectorProfileModel", "selector_profile");
        $this->load->helper('url');
    }

    public function save_post(){
        $this->response($this->selector_profile->save($this->input->post()) , 200);
    }

    public function update_put(){
        $this->response($this->selector_profile->update($this->put()) , 200);
    }

    public function list_get(){
        $this->response($this->selector_profile->lists() , 200);
    }

    public function byId_get(){
        $this->response($this->selector_profile->getById($this->input->get('id')) , 200);
    }

    public function del_delete(){
        $this->response($this->selector_profile->delete($this->input->get('id')) , 200);
    }

     public function relationadd_post(){
        $this->response($this->selector_profile->relationsave($this->input->post()) , 200);
    }
}
?>

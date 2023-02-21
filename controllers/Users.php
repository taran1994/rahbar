<?php
require APPPATH . 'libraries/REST_Controller.php';

class Users extends REST_Controller {

  public function __construct() {

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    parent::__construct();
    if(!$this->session->userdata('uid'))
        redirect('/');
    $this->load->database();
    $this->load->model("UsersModel", "users");
    $this->load->model("UserWithUserTypeModel", "userWithUserType");
  }

  public function save_post() {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $userId = $this ->users->save($data);
    for($i = 0;$i < count($data->userTypes);$i++){
      $userWithUserTypeData=json_decode(json_encode(array('userId' => $userId, 'userTypeId'=> $data->userTypes[$i],'status'=>1)));
      $this->userWithUserType->save($userWithUserTypeData);
    }
    $this->response( $userId, 200);
  }

  public function active_get() {
    $this->response($this->users->activeUsers() , 200);
  }
  
  public function inactive_get() {
    $this->response($this->users->inActiveUsers() , 200);
  }
  
  public function all_get() {
    $this->response($this->users->allUsers() , 200);
  }

  public function byId_get() {
    $this->response($this->users->getById($this->input->get('userId'),false) , 200);
  }
	
	public function activate_get() {
    $this->response($this->users->updateActiveStatus($this->input->get('userId'), "A") , 200);
  }
	
	public function inactivate_get() {
    $this->response($this->users->updateActiveStatus($this->input->get('userId'),"I") , 200);
  }

  public function del_delete() {
    $this->response($this->users->delete($this->input->get('userId')) , 200);
  }
  
  
  public function login_post(){    
     $loginData = $this->response($this->users->check_login() , 200);
  }
}

?>

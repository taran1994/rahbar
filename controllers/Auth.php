<?php
require APPPATH . 'libraries/REST_Controller.php';

class Auth extends CI_Controller { 

	 public function __construct() {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    parent::__construct();
    $this->load->database();
    $this->load->model("UsersModel", "users");
	$this->load->model("LoginHistoryModel", "loginHistory");
	$this->load->model("UserTypesModel", "userTypes");
	$this->load->model("CoordinatorProfileModel", "coordinator_profile");
	$ci = get_instance(); // CI_Loader instance
	$ci->load->config('EmailConfig');
		//$this->config->load('EmailConfig',TRUE);
  }

  /**
 * User Logout
 */
public function logout() {
	$this->loginHistory->save($this->session->userdata('uid'),"OUT");
	$remove_sessions = array('uid', 'fullName');
	$this->session->unset_userdata($remove_sessions);
	redirect('/');
}
	
public function registration() {
	if (count($_POST) == 0){
		$this->registrationPanel();
	}else{
		$this->form_validation->set_rules('userTypes', 'User Type', 'callback_validate_dropdown');
		$this->form_validation->set_rules('fullName','Full Name','required');
		$this->form_validation->set_rules('gender','Gender','required');
		$this->form_validation->set_rules('emailId','EmailId','valid_email');
		$this->form_validation->set_rules('phoneNumber','Phone','required');
		$this->form_validation->set_rules('password','Password','required|min_length[8]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','required|min_length[8]|matches[password]');
		$this->form_validation->set_message('is_unique', 'This email is already exists.');
		if($this->form_validation->run()){
			$data=json_decode(json_encode(array(
				'fullName' => $this->input->post('fullName'),
				'gender' => $this->input->post('gender'),
				'emailId' => $this->input->post('emailId'),
				'phoneNumber' => $this->input->post('phoneNumber'),
				'dateOfBirth' => $this->input->post('dateOfBirth'),
				'password' => $this->input->post('password'), 
				'confirmpassword' => $this->input->post('confirmpassword'))
			));

			$userId = $this->users->save($data);
			$user=$this->users->getById($userId, false);
			$this->session->set_flashdata('success','Registration successfull, Once admin approve the registration, you will be abel to login.');
			$this->sendEmailToAdmin($data);
			$this->sendEmailToUser($data);
			$this->welcomePanel();
		}else{
			$this->session->set_flashdata('error','Something went wrong. Please try again.');	
			$this->registrationPanel();
		}
	}
}
	
	
		
public function login(){
	if (count($_POST) == 0){
		$this->loginPanel();
	}else{
		$this->form_validation->set_rules('userId','User Id','required');
		$this->form_validation->set_rules('password','Password','required|min_length[8]');
		if($this->form_validation->run()){
			$userId=$this->input->post('userId');
			$userFound=$this->users->getByIdOrEmailId($userId,true);
			if ($userFound!=null) {
				$password = $userFound->password;
				$hashpwd=hash_hmac('sha512', 'salt' . $this->input->post('password'), "cmsba");
				if ($hashpwd==$password) {
					$this->loginHistory->save($userFound->id,"IN");
					$this->session->set_userdata('uid',$userFound->id);
					$this->session->set_userdata('isActive',$userFound->is_active);
					$this->session->set_userdata('fullName',$userFound->full_name);
					$userType=$this->userTypes->getById($userFound->user_type);
					$this->session->set_userdata('userType',$userType->type);
					if($userType->type=='Students'){
						$this->studentDashboardPanel();
					}else if($userType->type=='Sponsors'){
						$this->sponsorDashboardPanel();
					}else if($userType->type=='Admins'){
						$this->adminDashboardPanel();
					}else if($userType->type=='Coordinators'){
						$this->coordinatorDashboardPanel($userFound->id);
					}else if($userType->type=='Selectors'){
						$this->selectorDashboardPanel();
					}
				}else{
					$this->session->set_flashdata('error','Invalid User/Password. Please try again.');	
					$this->loginPanel();
				}	
			}else{
				$this->session->set_flashdata('error','Invalid User. Please try again.');	
				$this->loginPanel();
			}
		}else{
			$this->session->set_flashdata('error','Something went wrong. Please try again.');	
			$this->registrationPanel();
		}
	}
}
// 													}
													
private function sendEmailToUser($user){
	$from_email = $this->config->item('admin_email_id'); 
	$to_email = $user->emailId;  
	$this->email->from($from_email, $this->config->item('register_user_email_sender_name')); 
	$this->email->to($to_email);
	$this->email->subject($this->config->item('register_user_email_subject')); 
	$this->email->message($this->config->item('register_user_email_msg')); 
	$this->email->send();
}
private function sendEmailToAdmin($user){
	$from_email = $user->emailId; 
	$to_email = $this->config->item('admin_email_id');
	$this->email->from($from_email, $user->fullName); 
	$this->email->to($to_email);
	$this->email->subject($this->config->item('register_admin_email_subject'));  
	$message=$this->config->item('register_admin_email_msg') ;
	$messages = array();
	foreach($user as $key){
			$messages[] = $key;
	}
	$this->email->message($message); 
	$this->email->send();
}

private function registrationPanel(){
	$data['page_title'] = "Registration Page";
	$data['userTypes']=$this->userTypes->allUserTypeNames();
	$this->load->view('_Layout/login/header.php', $data); // Header File
	$this->load->view('auth/registration'); // Main File (Body)
	$this->load->view('_Layout/login/footer.php'); // Footer File // Footer File
}
private function welcomePanel(){
	$data['page_title'] = "Registration Page";
	$this->load->view('_Layout/login/header.php', $data); // Header File
	$this->load->view('auth/panel'); // Main File (Body)
	$this->load->view('_Layout/login/footer.php'); // Footer File // Footer File
}
private function loginPanel(){
	$data['page_title'] = "Login Page";
	$this->load->view('_Layout/home/header.php', $data); // Header File
	$this->load->view('auth/login'); // Main File (Body)
	$this->load->view('_Layout/home/footer.php'); // Footer File // Footer File
}

private function adminDashboardPanel(){
	$data['dashboard_header'] = "Welcome to Admin Dashboard";
	$data['page_title'] = "Rahbar - Admin Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/admin_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}
private function sponsorDashboardPanel(){
	$data['dashboard_header'] = "Welcome to Sponsor Dashboard";
	$data['page_title'] = "Rahbar - Sponsor Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/sponsor_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}

private function studentDashboardPanel(){
	$data['dashboard_header'] = "Welcome to Student Dashboard";
	$data['page_title'] = "Rahbar - Student Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/student_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}

private function coordinatorDashboardPanel($userId){
	$coordinatorFound=$this->coordinator_profile->getById($userId);
	$this->session->set_userdata('cc_id',$coordinatorFound[0]->coaching_center);
	$data['dashboard_header'] = "Welcome to Coordinator Dashboard";
	$data['page_title'] = "Rahbar - Coordinator Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/coordinator_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}

private function selectorDashboardPanel(){
	//$coordinatorFound=$this->coordinator_profile->getById($userId);
	//$this->session->set_userdata('cc_id',$coordinatorFound[0]->coaching_center);
	$data['dashboard_header'] = "Welcome to Selector Dashboard";
	$data['page_title'] = "Rahbar - Selector Dashboard";
	$this->load->view('_Layout/dashboard/header.php', $data); // Header File
	$this->load->view('_Layout/dashboard/selector_sidebar.php'); // side File
	$this->load->view('dashboard/dashboard'); // Main File (Body)
	$this->load->view('_Layout/dashboard/footer.php'); // Footer File // Footer File
}

	
function validate_dropdown($str){
	if ($str == '-CHOOSE-'){
		$this->form_validation->set_message('validate_dropdown', 'Please choose a valid %s');
		return FALSE;
	}else{
		return TRUE;    
	}
}


}
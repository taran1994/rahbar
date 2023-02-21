<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('uid'))
        redirect('/');
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null){
		$sidebar="admin";
		$title="Rahbar - Administration";
		if($this->session->userdata('userType')=='Coordinators'){
			$title="Rahbar - Coordinator Administration";
			$sidebar="coordinator";
		} else if ($this->session->userdata('userType')=='Selectors'){
			$title="Rahbar - Selector Administration";
			$sidebar="selector";
		}
		$data['page_title'] = $title;
		$this->load->view('_Layout/dashboard/header.php', $data);
		$this->load->view('_Layout/dashboard/'.$sidebar.'_sidebar.php'); 
		$this->load->view('dashboard/crud',(array)$output);
		$this->load->view('_Layout/dashboard/footer_data.php'); // Footer File	
		
	}

	public function index(){
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	
	public function user_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_users');
		$crud->set_subject('User');
		$crud->required_fields('full_name', 'phone_number');
		$crud->columns('id', 'full_name', 'gender', 'phone_number', 'email_id', 'date_of_birth','user_type','is_active');
		$crud->fields('id', 'full_name', 'gender', 'phone_number', 'email_id', 'date_of_birth','user_type','is_active');
		$crud->field_type('is_active', 'dropdown', array(
			'1' => 'Active',
			'0' => 'Not Active'
		));
		$crud->field_type('gender', 'dropdown', array(
			'M' => 'Male',
			'F' => 'Female'
		));
		$crud->set_relation('user_type', 'rah_user_types', 'type');

		$this->common_output($crud);
	}
	
	
	public function userTypes_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_user_types');
		$crud->set_subject('User Type');
		$crud->required_fields('type');
		$crud->columns('id', 'type', 'description', 'status','created_by');
		$crud->fields('type', 'description', 'status','creation_date_time','mod_date_time','created_by');

		$crud->display_as('id', 'Type ID');
		$this->common_output($crud);
	}
	
	
	

	public function city_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_cities');
		$crud->set_subject('City');
		$crud->required_fields('city', 'state_id','status');
		$crud->columns('city', 'state_id','status','created_by');
		$crud->fields('city', 'state_id','status','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('state_id', 'rah_states', 'name');
		$this->common_output($crud);
	}

	public function state_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_states');
		$crud->set_subject('State');
		$crud->required_fields('name', 'country_id','status');
		$crud->columns('name', 'country_id','status','created_by');
		$crud->fields('name', 'country_id','status','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('country_id', 'rah_countries', 'name');
		$this->common_output($crud);
	}

	public function country_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_countries');
		$crud->set_subject('Country');
		$crud->required_fields('name', 'country_code','status');
		$crud->columns('name', 'country_code','status','created_by');
		$crud->fields('name', 'country_code','status','creation_date_time','mod_date_time','created_by');
		$this->common_output($crud);
	}
	
	public function sponsors_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_sponsors');
		$crud->set_subject('Sponsor');
		$crud->required_fields('sponsor_id', 'student_id', 'status');
		$crud->columns('sponsor_id', 'student_id', 'status','created_by');
		$crud->fields('sponsor_id', 'student_id', 'status');
		$crud->set_relation('sponsor_id', 'rah_sponsor_profile', '{first_name} {last_name}');
		$crud->set_relation('student_id', 'rah_student_profile', '{first_name} {last_name}', array('sponsored' => 0));
		$crud->display_as('sponsor_id', 'Sponsor Name');
		$crud->display_as('student_id', 'Student Name');

		$this->common_output($crud);
	}

	public function student_profile_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_student_profile');
		$crud->set_subject('Student Profile');
		$crud->required_fields('session_year','first_name', 'last_name','address','city','state','coaching_center','recommended_by','course','course_faculty','college','form','status');
		$crud->columns('session_year','first_name', 'last_name','address','city','state','reviewer_1','reviewer_1_comment','reviewer_2','reviewer_2_comment','review_status','sponsor','status');
		$crud->fields('session_year','first_name', 'last_name','address','city','state','country','father_name','mother_name','email_address','student_cell_phone','mobile_1','mobile_2','guardian_profession','bank_detail','coaching_center','recommended_by','course','course_faculty','college','paid_for_admission','percentage_in_tenth_grade','roll_number_in_tenth_grade','form','status','reviewer_1','reviewer_1_comment','reviewer_2','reviewer_2_comment','review_status','sponsor','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('city', 'rah_cities', 'city',array('status' => 1));
		$crud->set_relation('state', 'rah_states', 'name',array('status' => 1));
		$crud->set_relation('country', 'rah_countries', 'name',array('status' => 1));
		$crud->set_relation('session_year', 'rah_session_year', 'year');
		$crud->set_relation('course', 'rah_courses', 'name',array('status' => 1));
		$crud->set_relation('course_faculty', 'rah_courses_faculty', 'name',array('status' => 1));
		$crud->set_relation('coaching_center', 'rah_coaching_centers', 'name',array('status' => 1));
		$crud->set_relation('college', 'rah_colleges', 'name',array('status' => 1));
		$crud->set_relation('sponsor', 'rah_sponsor_profile', '{first_name} {last_name}',array('status' => 1));
		$crud->set_relation('reviewer_1', 'rah_coordinator_profile', '{first_name} {last_name}',array('status' => 1));
		$crud->set_relation('reviewer_2', 'rah_coordinator_profile', '{first_name} {last_name}',array('status' => 1));
		$crud->field_type('sponsored', 'dropdown', array(
			'1' => 'Yes',
			'0' => 'No'
		));
		$crud->field_type('paid_for_admission', 'dropdown', array(
			'1' => 'Yes',
			'0' => 'No'
		));
		$crud->field_type('review_status', 'dropdown', array(
			'Approved' => 'Approved',
			'Not Approved' => 'Not Approved'
		));
		$crud->set_field_upload('form','assets/uploads/student_forms');
		$crud->where(['rah_student_profile.status' => '1']);
		if($this->session->userdata('userType')=='Coordinators'){
			$crud->where(['rah_student_profile.coaching_center' => $this->session->userdata('cc_id')]);
			$crud->unset_delete();
			$crud->field_type('sponsor','readonly');
			$crud->field_type('reviewer_1','readonly');
			$crud->field_type('reviewer_1_comment','readonly');
			$crud->field_type('reviewer_2','readonly');
			$crud->field_type('reviewer_2_comment','readonly');
			$crud->field_type('review_status','readonly');
		}else if($this->session->userdata('userType')=='Selectors'){
			$crud->unset_delete();
		}
		$crud->add_action('Email', '', '','fa-envelope',array($this,'send_email'));
		$this->common_output($crud);
	}

	function send_email($primary_key , $row){
		return site_url('Email/confirmation');
	}


	public function admin_profile_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_admin_profile');
		$crud->set_subject('Admin Profile');
		$crud->required_fields('id','first_name', 'last_name','address','country','status');
		$crud->columns('id','first_name', 'last_name','address','city','state','country','status','created_by');
		$crud->fields('id','first_name', 'last_name','address','city','state','country','status','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('id', 'rah_users', 'full_name',array('is_active' => 1));
		$crud->set_relation('city', 'rah_cities', 'city',array('status' => 1));
		$crud->set_relation('state', 'rah_states', 'name',array('status' => 1));
		$crud->set_relation('country', 'rah_countries', 'name',array('status' => 1));

		$this->common_output($crud);
	}

	

	public function sponsor_profile_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_sponsor_profile');
		$crud->set_subject('Sponsor Profile');
		$crud->required_fields('id','first_name', 'last_name','address','country','status');
		$crud->columns('id','first_name', 'last_name','address','city','state','country','status','created_by');
		$crud->fields('id','first_name', 'last_name','address','city','state','country','status','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('id', 'rah_users', 'full_name',array('is_active' => 1));
		$crud->set_relation('city', 'rah_cities', 'city',array('status' => 1));
		$crud->set_relation('state', 'rah_states', 'name',array('status' => 1));
		$crud->set_relation('country', 'rah_countries', 'name',array('status' => 1));

		$this->common_output($crud);
	}

	public function selectors_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_selector_profile');
		$crud->set_subject('Selector Profile');
		$crud->required_fields('id','first_name', 'last_name','address','country','status');
		$crud->columns('id','first_name', 'last_name','address','city','state','country','status','created_by');
		$crud->fields('id','first_name', 'last_name','address','city','state','country','status','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('id', 'rah_users', 'full_name',array('is_active' => 1));
		$crud->set_relation('city', 'rah_cities', 'city',array('status' => 1));
		$crud->set_relation('state', 'rah_states', 'name',array('status' => 1));
		$crud->set_relation('country', 'rah_countries', 'name',array('status' => 1));

		$this->common_output($crud);
	}

	public function coordinators_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_coordinator_profile');
		$crud->set_subject('Coordinator Profile');
		$crud->required_fields('id','first_name', 'last_name','address','country','status');
		$crud->columns('id','first_name', 'last_name','address','city','state','country','status','created_by');
		$crud->fields('id','first_name', 'last_name','address','city','state','country','status','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('id', 'rah_users', 'full_name',array('is_active' => 1));
		$crud->set_relation('city', 'rah_cities', 'city',array('status' => 1));
		$crud->set_relation('state', 'rah_states', 'name',array('status' => 1));
		$crud->set_relation('country', 'rah_countries', 'name',array('status' => 1));

		$this->common_output($crud);
	}

	public function college_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_colleges');
		$crud->set_subject('College');
		$crud->required_fields('name','address','country','status');
		$crud->columns('name','address','city','state','country','status','phone_number','email_address','created_by');
		$crud->fields('name','address','city','state','country','status','phone_number','email_address','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('city', 'rah_cities', 'city',array('status' => 1));
		$crud->set_relation('state', 'rah_states', 'name',array('status' => 1));
		$crud->set_relation('country', 'rah_countries', 'name',array('status' => 1));

		$this->common_output($crud);
	}

	public function courses_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_courses');
		$crud->set_subject('Course');
		$crud->required_fields('name','status');
		$crud->columns('name', 'description', 'status','created_by');
		$crud->fields('name', 'description', 'status','creation_date_time','mod_date_time','created_by');

		$this->common_output($crud);
	}

	public function course_faculty_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_courses_faculty');
		$crud->set_subject('Course Faculty');
		$crud->required_fields('course','name','status');
		$crud->columns('course','name', 'description', 'status','created_by');
		$crud->fields('course','name', 'description', 'status','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('course', 'rah_courses', 'name',array('status' => 1));

		$this->common_output($crud);
	}


	

	public function login_history_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_login_history');
		$crud->set_subject('Login History');
		$crud->columns('user_id', 'opt', 'creation_date_time');
		$crud->fields('user_id', 'opt', 'creation_date_time');
		$crud->set_relation('user_id', 'rah_users', 'full_name');

		$this->readOnlyMode($crud);
		$this->common_output($crud);
	}

	public function enrollment_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_enrollments');
		$crud->set_subject('Enrollments');
		$crud->required_fields('user_id', 'course_id');
		$crud->columns('user_id', 'course_id', 'review_status', 'reviewer_comments','review_level');
		$crud->fields('user_id', 'course_id', 'review_status', 'reviewer_comments','review_level','creation_date_time','mod_date_time','created_by');

		$crud->display_as('user_id', 'Student Name');
		$crud->display_as('course_id', 'Course Name');
		$crud->set_relation('user_id', 'rah_users', 'full_name');
		$crud->set_relation('course_id', 'rah_courses', 'name');
		$this->common_output($crud);
	}

	public function chapters_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_chapters');
		$crud->set_subject('Chapters');
		$crud->required_fields('name', 'contact_person_name','contact_person_cell_phone','city','state','country','status');
		$crud->columns('name', 'contact_person_name','contact_person_cell_phone','city','state','country','status','created_by');
		$crud->fields('name', 'contact_person_name','contact_person_cell_phone','city','state','country','status','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('city', 'rah_cities', 'city',array('status' => 1));
		$crud->set_relation('state', 'rah_states', 'name',array('status' => 1));
		$crud->set_relation('country', 'rah_countries', 'name',array('status' => 1));

		$this->common_output($crud);
	}

	public function coaching_centers_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_coaching_centers');
		$crud->set_subject('Coaching Center');
		$crud->required_fields('name','address', 'coordinator','contact_person_cell_phone','city','state','country','status');
		$crud->columns('name', 'address', 'coordinator','city','state','country','status','created_by');
		$crud->fields('name', 'address', 'coordinator','city','state','country','status','creation_date_time','mod_date_time','created_by');
		$crud->set_relation('city', 'rah_cities', 'city',array('status' => 1));
		$crud->set_relation('state', 'rah_states', 'name',array('status' => 1));
		$crud->set_relation('country', 'rah_countries', 'name',array('status' => 1));
		$crud->set_relation('coordinator', 'rah_users', 'full_name',array('status' => 1, 'user_type' => 2));
		

		$this->common_output($crud);
	}

	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function readOnlyMode($crud){
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
	}
	
	
	
	public function qualifications_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_qualifications');
		$crud->set_subject('Qualification');
		$crud->required_fields('user_id', 'collenge_or_university_board_name', 'collenge_or_university_name', 'course', 'month_of_passing', 'year_of_passing','overall_percentage_of_score');
		$crud->columns('id', 'user_id', 'collenge_or_university_board_name', 'collenge_or_university_name', 'course', 'month_of_passing', 'year_of_passing', 'overall_percentage_of_score','created_by');
		$crud->fields('id', 'user_id', 'collenge_or_university_board_name', 'collenge_or_university_name', 'course', 'month_of_passing', 'year_of_passing', 'overall_percentage_of_score');
   		$crud->set_relation('user_id', 'rah_users', 'full_name',array('is_active' => 1));
		$crud->set_relation('course', 'rah_courses', 'name',array('status' => 1));

		$crud->field_type('month_of_passing', 'dropdown', array(
			'January' => 'Jan',
			'February' => 'Feb',
			'March' => 'Mar',
			'April' => 'Apr',
			'May' => 'May',
			'June' => 'Jun',
			'July' => 'Jul',
			'August' => 'Aug',
			'September' => 'Sep',
			'October' => 'Oct',
			'November' => 'Nov',
			'December' => 'Dec'
		));
		$crud->field_type('year_of_passing', 'dropdown', array(
			'2010' => '2010',
			'2011' => '2011',
			'2012' => '2012',
			'2013' => '2013',
			'2014' => '2014',
			'2015' => '2015',
			'2016' => '2016',
			'2017' => '2017',
			'2018' => '2018',
			'2019' => '2019',
			'2020' => '2020',
			'2021' => '2021',
			'2022' => '2022',
			'2023' => '2023'
		));
		$output = $crud->render();
		$this->_example_output($output);
	}
	
	
	
		
	
	
	
	
	
	public function sponsor_type_management(){
		$crud = new grocery_CRUD();
		$crud->set_table('rah_sponsor_types');
		$crud->set_subject('Sponsor Type');
		$crud->required_fields('type');
		//$crud->columns('id', 'type', 'description', 'status');
		$crud->fields('type', 'description', 'status');
		$crud->field_type('status', 'dropdown', array(
			'1' => 'Active',
			'0' => 'Not Active'
		));

		$crud->display_as('id', 'Type ID');
		$output = $crud->render();
		$this->_example_output($output);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	



	function common_output($crud){
		$crud->order_by('creation_date_time', 'desc');
		$crud->unset_columns('id');
		$crud->unset_clone();
		$crud->unset_delete();
		// making invisible
		$crud->field_type('creation_date_time','invisible');
		$crud->field_type('mod_date_time','invisible');
		$crud->field_type('created_by','invisible');
		// Field Type
		$state = $crud->getState();
		if($state == "edit" || $state == "add") {
			//$crud->display_as('added_by', '');
			$crud->field_type('created_by', 'readonly');
		}
		$crud->field_type('status', 'dropdown', array(
			'1' => 'Active',
			'0' => 'Not Active'
		));

		//displays
		$crud->display_as('created_by', 'User');
		$crud->display_as('creation_date_time', 'Timestamp');
		
		
		// default relation
		$crud->set_relation('created_by', 'rah_users', 'full_name',array('is_active' => '1'));

		// events
		$crud->callback_before_insert(array($this,'set_insert_added_by_from_session'));
		$crud->callback_before_update(array($this,'set_update_column'));


		$output = $crud->render();
		$this->_example_output($output);
	}	
	
	function set_insert_added_by_from_session($post_array){
			$post_array['created_by'] = $this->session->userdata('uid');
			return $post_array;
	}

	function set_update_column($post_array){
		echo $post_array;
		$post_array['created_by'] = $this->session->userdata('uid');
		$post_array['mod_date_time'] = date('Y-m-d H:i:s');
		return $post_array;
	}




	

}

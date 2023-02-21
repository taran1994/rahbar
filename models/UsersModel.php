<?php
defined('BASEPATH') or exut('No direct script access allowed');

class UsersModel extends CI_Model {
  
  protected $user_table_name = "rah_users";

  public function __construct() {

    $this
      ->load
      ->database();

  }
  
  public function update($data, $id){
    $this->db->where('id', $id);
    $this->db->update($this->user_table_name, $data);
  }

  public function save($data) {
    $field = array(
      'password' => hash_hmac('sha512', 'salt' . $data->password, "cmsba"),
      'full_name' => $data->fullName,
      'gender' => $data->gender,
      'date_of_birth' => $data->dateOfBirth,
      'phone_number' => $data->phoneNumber,
      'email_id' => $data->emailId,
      'user_type' => '1'

    );

    $isUserIdAvailable = isset($data->userId);
    if ($isUserIdAvailable==false) {
      $this
        ->db
        ->insert($this->user_table_name, $field);

      return $this
        ->db
        ->insert_id();

    } else if($this->getById($data->userId,false) == null){
      $this
        ->db
        ->insert($this->user_table_name, $field);
      return $this
        ->db
        ->insert_id();
    } else {

      $this
        ->db
        ->where("id", $data->userId);

      $field['mod_date_time']=date('Y-m-d H:i:s');
      return $this
        ->db
        ->update($this->user_table_name, $field);

    }

  }
  
  public function updateActiveStatus($userId, $activeStatus) {
      $this->db->where("id", $userId);
      $field['is_active']=$activeStatus=="A"?1:0;
      $field['mod_date_time']=date('Y-m-d H:i:s');
      return $this
        ->db
        ->update($this->user_table_name, $field); 
  }

  public function activeUsers() {
    return $this
      ->getUserQuery(1)
      ->result();
  }
  
  public function getUserQuery($activeStatus){
    $sql="SELECT id, full_name, gender, date_of_birth, phone_number, email_id, is_active FROM ".$this->user_table_name." WHERE is_active=?";
    return $this->db->query($sql, [$activeStatus]);
  }
  
 public function inActiveUsers() {
    return $this
      ->getUserQuery(0)
      ->result();
  }
  
   public function allUsers() {
     return $this->getUserQuery(1)->result();
  }

  public function getById($id, $withPassword) {
    $sql="SELECT id, ".($withPassword?"password,":"")." full_name, gender, date_of_birth, phone_number, email_id FROM ".$this->user_table_name." WHERE is_active=? AND id=?";
    $result=$this->db->query($sql, [1, $id])->result();
    return $result != null ? $result[0] : null;
  }
 public function getByIdOrEmailId($id, $withPassword) {
  $sql="SELECT id, ".($withPassword?"password,":"")." full_name, gender, date_of_birth, phone_number, email_id, user_type, is_active FROM ".$this->user_table_name." WHERE is_active=? AND (email_id=?)";
  $result=$this->db->query($sql, [1,$id])->result();
  return $result != null ? $result[0] : null;
}
  

  public function delete($id) {
    $this
      ->db
      ->where("id", $id);
    $this
      ->db
      ->delete($this->user_table_name);
  }
  
  public function check_login() {

    $json = file_get_contents('php://input');

    $data = json_decode($json);

    /**
     * First Check Email is Exists in Database
     */
    $userFound =  $this->getById($data->userId);
    return $userFound;
    if ($userFound!=null) {
        $password = $userFound->password;
        $hashpwd=hash_hmac('sha512', 'salt' . $data->password, "cmsba");
      //return $password.'\n'.$hashpwd;
        /**
         * Check Password Hash 
         */
        if ($hashpwd==$password) {

          /**
           * Password and Email Address Valid
           */
          $userFound->password='xxx';
          return [
              'status' => TRUE,
              'data' => $userFound,
          ];

        } else {
            return ['status' => FALSE,'data' => "Unauthorized User"];
        }

    } else {
        return ['status' => FALSE,'data' => "User Not Found"];
    }
  }
  
  
  
  public function userProfile($userType, $id) {
    $sql="SELECT `id`, `full_name`, `gender`, `date_of_birth`, `phone_number`, `email_id`, `nationality`, `fathers_name`, `father_mobile_number`, `gross_annual_income`, `is_rahbar_student`, `mothers_name`, `mothers_mobile_number`, `rcc_incharge_mobile`, `rcc_incharge_name`, `rcc_location`, `address_line`, `address_type`, `area`, `city_or_village`, `pincode`, `state`, `contact_type` FROM ".$this->user_table_name." WHERE is_active=? AND id=? AND user_type=?";
    $result=$this->db->query($sql, [1, $id, $userType])->result();
    return $result != null ? $result[0] : null;
  }


}

?>

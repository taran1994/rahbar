<?php
defined('BASEPATH') or exut('No direct script access allowed');

class UserWithUserTypeModel extends CI_Model {
  
  protected $user_with_user_type_table_name = "rah_user_with_user_type";

  public function __construct() {

    $this
      ->load
      ->database();

  }

  public function save($data) {
    //return $data->userId;
    $field = array(
      'user_id' => $data->userId,
      'user_type_id' => $data->userTypeId,
      'status' => $data->status

    );

    $isTypeIdAvailable = isset($data->userTypeId);
    $isUserIdAvailable = isset($data->userId);
    if ($isTypeIdAvailable==true && $isUserIdAvailable==true && $this->getbyUserTypeAndUserId($data->userId, $data->userTypeId)) {
        $this
        ->db
        ->where("user_id", $data->userId)
        ->where("user_type_id", $data->userTypeId);
      $field['mod_date_time']=date('Y-m-d H:i:s');
      return $this
        ->db
        ->update($this->user_with_user_type_table_name, $field);
      
    }else{
      return $this
      ->db
      ->insert($this->user_with_user_type_table_name, $field);
      
    }

  }

   public function allUserTypes() {
    return $this
      ->db
      ->get($this->user_with_user_type_table_name)
      ->result();
  }

  public function getByUserTypeAndUserId($userId, $userTypeId) {
    $this
      ->db
      ->where("user_id", $userId)
      ->where("user_type_id", $userTypeId)
      ->where("status", 1);
    
    $result = $this
      ->db
      ->get($this->user_with_user_type_table_name)->result();
    return $result != null ? $result : null;

  }
  
  public function getByUser($userId) {
    $this
      ->db
      ->where("user_id", $userId)
      ->where("status", 1);
    
    $result = $this
      ->db
      ->get($this->user_with_user_type_table_name)->result();
    return $result != null ? $result : null;

  }
  
   public function getByUserType($userTypeId) {
    $this
      ->db
      ->where("user_type_id", $userTypeId)
      ->where("status", 1);
    
    $result = $this
      ->db
      ->get($this->user_with_user_type_table_name)->result();
    return $result != null ? $result : null;

  }

  public function deleteByUser($id) {
    $this
      ->db
      ->where("user_id", $id);
    return $this
      ->db
      ->delete($this->user_with_user_type_table_name);
  }
  
  public function deleteByUserType($id) {
    $this
      ->db
      ->where("user_type_id", $id);
    return $this
      ->db
      ->delete($this->user_with_user_type_table_name);
  }

}

?>

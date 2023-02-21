<?php
defined('BASEPATH') or exut('No direct script access allowed');

class UserTypesModel extends CI_Model {
  
  protected $user_type_table_name = "rah_user_types";

  public function __construct() {

    $this
      ->load
      ->database();

  }

  public function save($data) {
    $field = array(
      'type' => $data->type,
      'description' => $data->description,
      'status' => $data->status

    );

    $isUserTypeIdAvailable = isset($data->id);
    if ($isUserTypeIdAvailable==false) {
     
      $this
        ->db
        ->insert($this->user_type_table_name, $field);

      return $this
        ->db
        ->insert_id();

    } else if($this->getbyid($data->id) == null){
      $this
        ->db
        ->insert($this->user_type_table_name, $field);
      return $this
        ->db
        ->insert_id();
    } else {

      $this
        ->db
        ->where("type", $data->type);

      $field['mod_date_time']=date('Y-m-d H:i:s');
      return $this
        ->db
        ->update($this->user_type_table_name, $field);

    }

  }

   public function allUserTypes() {
    return $this
      ->db
      ->get($this->user_type_table_name)
      ->result();
  }

  public function allUserTypeNames() {
    $query = $this->db->get($this->user_type_table_name);
    $result = $query->result();
    $type_id = array('-CHOOSE-');
    $type_name = array('-CHOOSE-');
    
    for ($i = 0; $i < count($result); $i++)
    {
        array_push($type_id, $result[$i]->id);
        array_push($type_name, $result[$i]->type);
    }
    return array_combine($type_id, $type_name);

  }

  public function getById($id) {

    $this
      ->db
      ->where("id", $id)
      ->where("status", 1);
    
    $result = $this
      ->db
      ->get($this->user_type_table_name)->result();
    return $result != null ? $result[0] : null;

  }

  public function delete($id) {
    $this
      ->db
      ->where("id", $id);
    $this
      ->db
      ->delete($this->user_type_table_name);
  }

}

?>

<?php
defined('BASEPATH') or exut('No direct script access allowed');

class CoursesModel extends CI_Model {
  
  protected $table_name = "rah_courses";

  public function __construct() {
    $this->load->database();
  }
  
  public function getById($id){
    $this->db->where("id", $id);
    $data = $this->db->get($this->table_name);
    $result = $data->result();
    return $result != null ? $result : null;
  }

  public function getAvailableCourses(){
    $sql="SELECT rc.id as course_id, rc.name as course_name, rc.description, rc.number_of_seats as seat_left FROM ".$this->table_name." rc  WHERE rc.number_of_seats>0 AND rc.status=1";
    $result=$this->db->query($sql)->result();
    return $result != null ? $result : null;
  }

  public function update($data){
    $this->db->where('id', $data['id']);
    return $this->db->update($this->table_name, $data);
  }

  public function save($data) {
    $field = array(
      'first_name' => $data->first_name,
      'last_name' => $data->last_name,
      'address' => $data->address,
      'city' => $data->city,
      'state' => $data->state,
      'country' => $data->country,
      'user_type' => '1'

    );

    $isUserIdAvailable = isset($data->id);
    if ($isUserIdAvailable==false) {
      $this->db->insert($this->table_name, $field);
      return $this->db->insert_id();
    } else if($this->getById($data->id) == null){
      $this->db->insert($this->table_name, $field);
      return $this->db->insert_id();
    } else {
      $this->db->where("id", $data->userId);
      $field['mod_date_time']=date('Y-m-d H:i:s');
      return $this->db->update($this->table_name, $field);
    }
  }
  


  


}

?>

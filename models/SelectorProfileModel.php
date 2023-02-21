<?php
defined('BASEPATH') or exut('No direct script access allowed');

class SelectorProfileModel extends CI_Model {
  
  protected $table_name = "rah_selector_profile";
   protected $raltion_table_name = "rah_student_selector_relation";

  public function __construct() {
    $this->load->database();
  }
  
  public function getById($id){
    $this->db->where("id", $id);
    $data = $this->db->get($this->table_name);
    $result = $data->result();
    return $result != null ? $result : null;
  }

  public function update($data){
    $this->db->where('id', $data['id']);
    return $this->db->update($this->table_name, $data);
  }

  public function save($data) {
    $field = array(
      'id' => $data['id'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      //'address' => $data['address'],
      'city' => $data['city'],
      'state' => $data['state'],
      'country' => $data['country']
    );

    $isUserIdAvailable = isset($data['id']);
    if ($isUserIdAvailable==false) {
      $this->db->insert($this->table_name, $field);
      return $this->db->insert_id();
    } else if($this->getById($data['id']) == null){
      $this->db->insert($this->table_name, $field);
      return $this->db->insert_id();
    } else {
      $this->db->where("id", $data['id']);
      $field['mod_date_time']=date('Y-m-d H:i:s');
      return $this->db->update($this->table_name, $field);
    }
  }

    public function getAll(){
    $data = $this->db->get($this->table_name);
    $result = $data->result();
    return $result != null ? $result : null;
  }

  public function relationsave($data) {
    $field = array(
      'student_id' => $data['student_id'],
      'selector_id' => $data['selector_id'],
      'addition_text' => $data['addition_text'],
      'created_at' => date('Y-m-d H:i:s'),
    );
   
    
      $this->db->insert($this->raltion_table_name, $field);
      return $this->db->insert_id();
    
  }
  

}

?>

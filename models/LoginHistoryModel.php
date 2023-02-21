<?php
defined('BASEPATH') or exut('No direct script access allowed');

class LoginHistoryModel extends CI_Model {
  
  protected $table_name = "rah_login_history";

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

  public function save($user_id,$option) {
      $login_history_data=json_decode(json_encode(array(
        'user_id' => $user_id,
        'opt' => $option)
      ));
      $this->db->insert($this->table_name, $login_history_data);
      return $this->db->insert_id();
  }
}

?>

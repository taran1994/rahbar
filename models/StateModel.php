<?php
defined('BASEPATH') or exut('No direct script access allowed');

class StateModel extends CI_Model {
  
  protected $table_name = "rah_states";

  public function __construct() {
    $this->load->database();
  }

  public function getStates(){
    $data = $this->db->get($this->table_name);
    $result = $data->result();
    return $result != null ? $result : null;
  }

}
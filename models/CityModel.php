<?php
defined('BASEPATH') or exut('No direct script access allowed');

class CityModel extends CI_Model {
  
  protected $table_name = "rah_cities";

  public function __construct() {
    $this->load->database();
  }

  public function getCities(){
    $data = $this->db->get($this->table_name);
    $result = $data->result();
    return $result != null ? $result : null;
  }

}
<?php
defined('BASEPATH') or exut('No direct script access allowed');

class CountryModel extends CI_Model {
  
  protected $user_table_name = "rah_countries";

  public function __construct() {
    $this->load->database();
  }

  public function getCountries(){
    //$sql="SELECT id, name FROM ".$this->user_table_name." WHERE status=1";
    //return $this->db->query($sql);
    $data = $this->db->get($this->user_table_name);
    $result = $data->result();
    return $result != null ? $result : null;
  }

}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EnrollmentModel extends CI_Model {
  
  protected $table_name = "rah_enrollments";

  public function __construct() {
    $this->load->database();
  }

  public function getAvailableEnrollments(){
    $sql="SELECT rc.id as course_id, rc.name as course_name, ru.id as user_id, ru.full_name  as user_name, re.review_status FROM rah_courses rc, rah_enrollments re, rah_users ru WHERE rc.id=re.course_id AND ru.id=re.user_id  AND  rc.number_of_seats>0 AND rc.status=1 ";
    $result=$this->db->query($sql)->result();
    return $result != null ? $result : null;
  }

  public function save($data) {
    $field = array(
      'user_id' => $data['userId'],
      'course_id' => $data['courseId'],
      'created_by' => $this->session->userdata('uid')
    );
    $this->db->insert($this->table_name, $field);
    return $this->db->insert_id();
  }

  public function update($data) {
    $field = array(
      'review_status' => 'Approved',
      'created_by' => $this->session->userdata('uid')
    );
    $this->db->where('user_id', $data['userId']);
    $this->db->where('course_id', $data['courseId']);
    $this->db->update($this->table_name, $field);
    return $this->db->insert_id();
  }

   

  public function getById($id) {
    $this->db->where("id", $id)->where("status", 1);
    $result = $this->db->get($this->user_type_table_name)->result();
    return $result != null ? $result[0] : null;
  }

  public function delete($id) {
    $this->db->where("id", $id);
    $this->db->delete($this->user_type_table_name);
  }

  
  public function getSponser($cid,$sid) {
    $this->db->where("course_id", $cid)->where("user_id", $sid);
    $result = $this->db->get($this->table_name)->result();
    return $result != null ? $result[0] : null;
  }

}

?>

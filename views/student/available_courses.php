<?php
function verifyEnrolment($available_enr, $user_id, $course_id){
   if(isset($available_enr)==1){
    foreach ($available_enr as $enr) {
      if($user_id==$enr->user_id && $course_id==$enr->course_id){
        if($enr->review_status=='Approved'){
          return 2;
        }
        return 1;
      }
    }
  }
  return 0;
}
?>
<main>
  <div class="site-section">
    <div class="container">
      <div class="row justify-content-center">
        <h1>Available Courses</h1>
        <br><br><br>
        <div class="col-md-9 table-responsive" id="myprofile">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Available Seats</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if(isset($available_courses)){
                $i=0;
                foreach ($available_courses as $course) {
                    $i++;
                ?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=$course->course_name;?></td>
                        <td><?=$course->seat_left;?></td>
                        <td><?=$course->description;?></td>
                        <td>
                          <?php 
                          $verifyCode=verifyEnrolment($available_enr,$this->session->userdata('uid'),$course->course_id);
                          if($verifyCode==0){
                            ?>
                            <button type="button" id="enrol_student_btn" user-id="<?=$this->session->userdata('uid');?>" value="<?=$course->course_id;?>" class="enrol_student_btn btn btn-outline-warning">Enroll</button> 
                          <?php } else if($verifyCode==2) {
                            ?>
                         <button type="button" value="<?=$course->course_id;?>" class=" btn btn-outline-success showSponser" >Congratulation!</button> 
                          <?php } else { ?>
                            <button type="button" value="<?=$course->course_id;?>" class=" btn btn-outline-danger">Already Enrolled</button> 
                          <?php } ?>
                        </td>
                    </tr>
                <?php }} else {?>
                  <tr><th colspan="6" scope="row">No Record Found</th></td>
                  <?php } ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</main>


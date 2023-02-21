<main>
  <div class="site-section">
    <div class="container">
      <div class="row justify-content-center">
        <h1>Available Enrollments</h1>
        <br><br><br>
        <div class="col-md-9 table-responsive" id="myprofile">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if(isset($available_enrollments)){
                $i=0;
                foreach ($available_enrollments as $enr) {
                    $i++;?>
                    <tr>
                        <th scope="row"><?=$i;?></th>
                        <td><?=$enr->course_name;?></td>
                        <td><?=$enr->user_name;?></td>
                        <td> 
                          <?php if($enr->review_status!='Approved' && $enr->review_status!='Rejected'){?>
                            <button type="button" id="sponsor_student_btn" value="<?=$enr->course_id;?>" user-id="<?=$enr->user_id;?>" class="sponsor_student_btn btn btn-outline-success">Pick This</button>
                          <?php } else {?>
                            <button type="button" class=" btn-show-modal btn btn-outline-danger" modal-type="student_info" user-id="<?=$enr->user_id;?>">You picked already</button>
                          <?php }?>
                        </td>
                    </tr>
                <?php } } else {?>
                  <tr><th colspan="6" scope="row">No Record Found</th></td>
                  <?php } ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</main>

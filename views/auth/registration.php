<?php 
$genderOption = array(
  'M' => 'MALE',
  'F' => 'FEMALE'
);
?>
<main>
  <div class="site-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <h2>Register</h2>
          <p class="hint-text">Create your account. It's free and only takes a minute.</p>

              <!-- Include Flash Data File -->
              <?php   $this->load->view('_FlashAlert/flash_alert'); ?>
              
              <?php echo form_open('Auth/registration',['name'=>'userregistration','autocomplete'=>'off']);?>
                  <div class="form-group">
                      <label for="userTypes">User Type</label>
                      <?php 
                      $attributes = 'class="form-control" id="userTypes"';
                      echo form_dropdown('userTypes', $userTypes, set_value('userTypes'), $attributes); 
                      ?>
                      <span class="text-danger"><?php echo form_error('userTypes',"<div style='color:red'>","</div>"); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <?php echo form_input(['name'=>'fullName','class'=>'form-control','value'=>set_value('fullName'),'placeholder'=>'Enter Full Name']);?>
                    <?php echo form_error('fullName',"<div style='color:red'>","</div>");?>  
                  </div>
                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <?php echo form_dropdown('gender', $genderOption, 'SELECT', 'class="form-control"');?>
                    </div>  
                  <div class="form-group">
                      <label for="emailId">Email address</label>
                      <?php echo form_input(['name'=>'emailId','class'=>'form-control','value'=>set_value('emailId'),'placeholder'=>'Enter Valid Email']);?>
                      <?php echo form_error('emailId',"<div style='color:red'>","</div>");?>            
                  </div>
                  <div class="form-group">
                      <label for="phoneNumber">Phone Number</label>
                      <?php echo form_input(['name'=>'phoneNumber','class'=>'form-control','value'=>set_value('phoneNumber'),'placeholder'=>'Enter Valid Phone']);?>
                      <?php echo form_error('phoneNumber',"<div style='color:red'>","</div>");?>          
                  </div>
                    <div class="form-group">
                      <label for="dateOfBirth">Date of birth</label>
                      <?php echo form_input(['name'=>'dateOfBirth','class'=>'form-control datepicker','value'=>set_value('dateOfBirth'),'placeholder'=>'Enter Valid Date of birth']);?>
                      <?php echo form_error('dateOfBirth',"<div style='color:red'>","</div>");?>           
                  </div>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <?php echo form_password(['name'=>'password','class'=>'form-control','value'=>set_value('password'),'placeholder'=>'Enter Valid Password']);?>
                      <?php echo form_error('password',"<div style='color:red'>","</div>");?>  
                  </div>
                  <div class="form-group">
                      <label for="confirmpassword">Password Confirmation</label>
                      <?php echo form_password(['name'=>'confirmpassword','class'=>'form-control','value'=>set_value('confirmpassword'),'placeholder'=>'Enter Valid Password']);?>
                      <?php echo form_error('confirmpassword',"<div style='color:red'>","</div>");?>  
                  </div>
          <?php echo form_submit(['name'=>'insert','value'=>'Register','class'=>'btn btn-success btn-block']);?>
          <a class="btn btn-primary btn-block" href="<?= base_url('/welcome') ?>" class="nav-link">Login</a>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>  
</main>




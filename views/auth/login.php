<main>
  <div class="site-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <?php echo form_open('Auth/login',['name'=>'userregistration','autocomplete'=>'off']);?>
          
                  <div class="account-wall">
                    <div class="form-group">
                        <!--error message -->
                        <?php if($this->session->flashdata('error')){?>
                        <p style="color:red"><?php  echo $this->session->flashdata('error');?></p>	
                        <?php } ?>
                    </div>
                    <img class="profile-img" src="http://biharanjuman.org/includes/images/logo_ba1.png" alt="">
                    <div class="form-group">
                      <?php echo form_input(['name'=>'userId','class'=>'form-control','value'=>set_value('userId'),'placeholder'=>'Enter your Valid User id']);?>
                      <?php echo form_error('userId',"<div style='color:red'>","</div>");?>   
                    </div>
                    <div class="form-group">
                      <?php echo form_password(['name'=>'password','class'=>'form-control','value'=>set_value('password'),'placeholder'=>'Password']);?>
                      <?php echo form_error('password',"<div style='color:red'>","</div>");?>  
                    </div>
                    <div class="form-group">
                      <!-- <a class="btn btn-primary btn-block" href="<?= base_url('Auth/registration') ?>" class="nav-link">Register</a> -->
                      <?php echo form_submit(['name'=>'login','value'=>'Submit','class'=>'btn btn-success btn-block']);?>
                      
                    </div>
                </div>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>  
</main>






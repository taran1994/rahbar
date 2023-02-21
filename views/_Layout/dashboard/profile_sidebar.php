<div class="profile">
    <a href="/Dashboard" title="">
        <img src="<?php echo base_url('assets/img/user.png'); ?>" alt="Image" class="img-fluid">
    </a>
    <h3 class="name"><?=$this->session->userdata('fullName');?></h3>
    <span class="country"><?=$this->session->userdata('userType');?></span><br>
    <span ><a href="/Auth/logout"><span class="icon-sign-out mr-3"></span>Log Out</a></span>
</div>
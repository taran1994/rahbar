<main>
  <div class="site-section">
    <div class="container">
      <div class="row justify-content-center">
        <h1>Student's Profile</h1>
        <br><br><br>
        <div class="col-md-9" id="myprofile">
       
        
          <?php 
          if(isset($student_profile)){
            ?>
            <form class="needs-validation" action="/StudentApi/update" method="put" nonvalidate>

          <?php foreach ($student_profile as $profile)
          {?>
            <div class="form-group row">
              <input name="id" id="id" type="hidden"  value="<?php echo $profile->id;?>" />
              <label for="first_name" class="col-sm-2 col-form-label">First Name : </label>
              <div class="col-sm-4">
                <input name="first_name" id="first_name" type="text" value="<?php echo $profile->first_name;?>"  class="form-control" required/>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please provide a valid first name.</div>
              </div>
              <label for="last_name" class="col-sm-2 col-form-label">Last Name : </label>
              <div class="col-sm-4">
                <input name="last_name" id="last_name" type="text" value="<?php echo $profile->last_name;?>"  class="form-control" required/>
              </div>
            </div>
      
            <div class="form-group row">
              <label for="city" class="col-sm-2 col-form-label">City : </label>
              <div class="col-sm-4">
                <select name="city" id="city"  class="custom-select" >
                  <option selected>Choose...</option>
                  <?php 
                  foreach ($cities as $city)
                  { ?>
                  <option <?=$city->id==$profile->city ? "selected" : ""?> value="<?=$city->id?>"><?=$city->city?></option>
                  <?php } ?>
                </select>
              </div>
              <label for="state" class="col-sm-2 col-form-label">State : </label>
              <div class="col-sm-4">
                <select name="state" id="state"  class="custom-select" >
                  <option selected>Choose...</option>
                  <?php 
                  foreach ($states as $state)
                  { ?>
                  <option <?=$state->id==$profile->state ? "selected" : ""?> value="<?=$state->id?>"><?=$state->name?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="country" class="col-sm-2 col-form-label">Country : </label>
              <div class="col-sm-4">
                <select name="country" id="country"  class="custom-select" >
                  <option selected>Choose...</option>
                  <?php 
                  foreach ($countries as $country)
                  { ?>
                  <option <?=$country->id==$profile->country ? "selected" : ""?> value="<?=$country->id?>"><?=$country->name?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label"> </label>
              <div class="col-sm-4">  
              <button class="btn btn-outline-success crud-submit-edit" type="button">Update</button>  
              </div>
            </div>
          </form>
          <?php }} else {?>
            <form class="needs-validation" action="/StudentApi/save" method="put" nonvalidate>
            <div class="form-group row">
            <input name="id" id="id" type="hidden"  value="<?=$this->session->userdata('uid')?>" />
              <label for="first_name" class="col-sm-2 col-form-label">First Name : </label>
              <div class="col-sm-4">
                <input name="first_name" id="first_name" type="text" class="form-control" required/>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please provide a valid first name.</div>
              </div>
              <label for="last_name" class="col-sm-2 col-form-label">Last Name : </label>
              <div class="col-sm-4">
                <input name="last_name" id="last_name" type="text" class="form-control" required/>
              </div>
            </div>
      
            <div class="form-group row">
              <label for="city" class="col-sm-2 col-form-label">City : </label>
              <div class="col-sm-4">
                <select name="city" id="city"  class="custom-select" >
                  <option selected>Choose...</option>
                  <?php 
                  foreach ($cities as $city)
                  { ?>
                  <option  value="<?=$city->id?>"><?=$city->city?></option>
                  <?php } ?>
                </select>
              </div>
              <label for="state" class="col-sm-2 col-form-label">State : </label>
              <div class="col-sm-4">
                <select name="state" id="state"  class="custom-select" >
                  <option selected>Choose...</option>
                  <?php 
                  foreach ($states as $state)
                  { ?>
                  <option  value="<?=$state->id?>"><?=$state->name?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="country" class="col-sm-2 col-form-label">Country : </label>
              <div class="col-sm-4">
                <select name="country" id="country"  class="custom-select" >
                  <option selected>Choose...</option>
                  <?php 
                  foreach ($countries as $country)
                  { ?>
                  <option  value="<?=$country->id?>"><?=$country->name?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label"> </label>
              <div class="col-sm-4">  
              <button class="btn btn-outline-success crud-submit-add" type="button">Update</button>  
              </div>
            </div>
            </form>

          <?php } ?>
          
        </div>
      </div>
    </div>
  </div>
</main>

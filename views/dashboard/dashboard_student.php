<div class="wrapper d-flex align-items-stretch">
  <?php include_once('nav-side.php');?>
  <div id="content" class=" p-4 p-md-12">
    <?php include_once('nav-top.php');?>
    <h2 class=" text-center mb-12">Welcome! to Rahbar Dashbord</h2>
    <?php if(isset($student_profile)){?>
    <div class="row">
      <div class="col-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Student Information</div>
          <div class="panel-body">
            <form data-toggle="validator" role="form" method=post action="/dashboard/student_profile">
              <table id="userTable" class="table table-hover">
                <tbody>
                  <tr><td><label for="id" class="control-label">User ID</label></td><td><input readonly  class="form-control" name='id' id='id'  value='<?=$student_profile->id?>'></td></tr>
                  <tr><td><label for="full_name" class="control-label">Full Name</label></td><td><input  class="form-control" name='full_name' id='full_name'  value='<?=$student_profile->full_name?>'></td></tr>
                  <tr><td><label for="gender" class="control-label">Gender</label></td><td><input  class="form-control" name='gender' id='gender'  value='<?=$student_profile->gender?>'></td></tr>
                  <tr><td><label for="date_of_birth" class="control-label">Date of Birth</label></td><td><input  class="form-control" name='date_of_birth' id='date_of_birth'  value='<?=$student_profile->date_of_birth?>'></td></tr>
                  <tr><td><label for="phone_number" class="control-label">Phone Number</label></td><td><input  class="form-control" name='phone_number' id='phone_number'  value='<?=$student_profile->phone_number?>'></td></tr>
                  <tr><td><label for="email_id" class="control-label">Email ID</label></td><td><input  class="form-control" name='email_id' id='email_id'  value='<?=$student_profile->email_id?>'></td></tr>
                  <tr>
                    <td><label for="nationality" class="control-label">Nationality</label></td>
                    <td>
                      <select id="nationality" name="nationality" class="form-control">
                         <?php foreach($nationality as $row): ?>
                            <option <?php if($student_profile->nationality==$row->country_code){ ?> selected <?php }?> value='<?=$row->country_code?>'><?=$row->country_enName?></option>
                        <?php endforeach; ?>
                      </select> 
                    </td>
                  </tr>
                  <tr><td><label for="fathers_name" class="control-label">Father Name</label></td><td><input  class="form-control" name='fathers_name' id='fathers_name'  value='<?=$student_profile->fathers_name?>'></td></tr>
                  <tr><td><label for="father_mobile_number" class="control-label">Father Mobile Number</label></td><td><input  class="form-control" name='father_mobile_number' id='father_mobile_number'  value='<?=$student_profile->father_mobile_number?>'></td></tr>
                  <tr><td><label for="gross_annual_income" class="control-label">Gross Annual Income</label></td><td><input  class="form-control" name='gross_annual_income' id='gross_annual_income'  value='<?=$student_profile->gross_annual_income?>'></td></tr>
                  <tr>
                    <td><label for="is_rahbar_student" class="control-label">Is Rahbar Student?</label></td>
                    <td>
                      <select id="is_rahbar_student" name="is_rahbar_student" class="form-control">
                        <option <?php if($student_profile->is_rahbar_student=='1'){ ?> selected <?php }?> value="1">Yes</option>
                        <option <?php if($student_profile->is_rahbar_student=='0'){ ?> selected <?php }?> value="0">No</option>
                      </select> 
                    </td>
                  </tr>
                  <tr><td><label for="mothers_name" class="control-label">Mother Name</label></td><td><input  class="form-control" name='mothers_name' id='mothers_name'  value='<?=$student_profile->mothers_name?>'></td></tr>
                  <tr><td><label for="mothers_mobile_number" class="control-label">Mother Mobile Number</label></td><td><input  class="form-control" name='mothers_mobile_number' id='mothers_mobile_number'  value='<?=$student_profile->mothers_mobile_number?>'></td></tr>
                  <tr><td><label for="rcc_incharge_mobile" class="control-label">RCC Incharge Mobile</label></td><td><input  class="form-control" name='rcc_incharge_mobile' id='rcc_incharge_mobile'  value='<?=$student_profile->rcc_incharge_mobile?>'></td></tr>
                  <tr><td><label for="rcc_incharge_name" class="control-label">RCC Incharge Name</label></td><td><input  class="form-control" name='rcc_incharge_name' id='rcc_incharge_name'  value='<?=$student_profile->rcc_incharge_name?>'></td></tr>
                  <tr><td><label for="rcc_location" class="control-label">RCC Location</label></td><td><input  class="form-control" name='rcc_location' id='rcc_location'  value='<?=$student_profile->rcc_location?>'></td></tr>
                  <tr><td><label for="contact_type" class="control-label">Contact Type</label></td><td><input  class="form-control" name='contact_type' id='contact_type'  value='<?=$student_profile->contact_type?>'></td></tr>
                  <tr><td><label for="address_line" class="control-label">Address Line</label></td><td><input  class="form-control" name='address_line' id='address_line'  value='<?=$student_profile->address_line?>'></td></tr>
                  <tr><td><label for="address_type" class="control-label">Address Type</label></td><td><input  class="form-control" name='address_type' id='address_type'  value='<?=$student_profile->address_type?>'></td></tr>
                  <tr><td><label for="area" class="control-label">Area</label></td><td><input  class="form-control" name='area' id='area'  value='<?=$student_profile->area?>'></td></tr>
                  <tr><td><label for="city_or_village" class="control-label">City or Village</label></td><td><input  class="form-control" name='city_or_village' id='city_or_village'  value='<?=$student_profile->city_or_village?>'></td></tr>
                  <tr><td><label for="state" class="control-label">State</label></td><td><input  class="form-control" name='state' id='state'  value='<?=$student_profile->state?>'></td></tr>
                  <tr><td><label for="pincode" class="control-label">Pin Code</label></td><td><input  class="form-control" name='pincode' id='pincode'  value='<?=$student_profile->pincode?>'></td></tr>
                  <tr>
                    <td colspan=2>
<!--                       <button id="btnUpdate" type="button" class="btn btn-success btn-lg">Update Profile</button> -->
                      <button id="btnSubmit" name="submit" type="submit" class="btn btn-success btn-lg" style="visibility:visible;">Save</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>  



<script>
   var SITEURL = '<?php echo base_url(); ?>';
 
   $(document).ready(function () {
     $('#btnUpdate').click(function () {
       $('#btnUpdate').css({ "visibility": 'hidden'});
       $('table > tbody  > tr > td > input').each(function(index, tr) { 
          $(tr).attr("readonly", false); 
       });
       $('#btnSubmit').css({ "visibility": 'visible'});
     });
     
      $('#btnSubmit').click(function () {
       $('#btnSubmit').css({ "visibility": 'hidden'});
       $.ajax({
          type: "Post",
          url: SITEURL + "product/get_product_by_id",
          data: {
             id: product_id
          },
          dataType: "json",
          success: function (res) {
             if (res.success == true) {
                $('#title-error').hide();
                $('#product_code-error').hide();
                $('#description-error').hide();
                $('#productCrudModal').html("Edit Product");
                $('#btn-save').val("edit-product");
                $('#ajax-product-modal').modal('show');
                $('#product_id').val(res.data.id);
                $('#title').val(res.data.title);
                $('#product_code').val(res.data.product_code);
                $('#description').val(res.data.description);
             }
          },
          error: function (data) {
             console.log('Error:', data);
          }
       });
       
       $('#btnUpdate').css({ "visibility": 'visible'});
     });
   });
     
  
  
</script>  
<main>
  <div class="site-section">
    <div class="container">
      <div class="row justify-content-center">
        <h1>Student Relation</h1>
        <br><br><br>
        <div class="col-md-9" id="myprofile">
       
        
          <form class="needs-validation" action="/SelectorApi/relationadd" method="post" nonvalidate>
             <div class="form-group row">
              <label for="country" class="col-sm-2 col-form-label">Student : </label>
              <div class="col-sm-4">
                <select name="student_id"  class="custom-select" >
                  <option selected>Choose...</option>
                  <?php 
                  foreach ($students as $student)
                  { ?>
                  <option  value="<?=$student->id?>"><?php echo $student->first_name.' '.$student->last_name?></option>
                  <?php } ?>
                </select>
              </div>
              <label for="country" class="col-sm-2 col-form-label">Selectors : </label>
              <div class="col-sm-4">
                <select name="selector_id"   class="custom-select" >
                  <option selected>Choose...</option>
                  <?php 
                  foreach ($selectors as $selector)
                  { ?>
                  <option  value="<?=$selector->id?>"><?php echo $selector->first_name.' '.$selector->last_name?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="country" class="col-sm-2 col-form-label">Additional text : </label>
              <div class="col-sm-10">
                <textarea name="addition_text" class="form-control" required></textarea> 
              </div>
            </div>
            
              <div class="form-group row">
              <label class="col-sm-2 col-form-label"> </label>
              <div class="col-sm-4">  
              <button class="btn btn-outline-success crud-submit-add" type="button">Save</button>  
              </div>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</main>

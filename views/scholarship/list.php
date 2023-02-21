<div class="wrapper d-flex align-items-stretch">
  <?php include_once('../dashboard/nav-side.php');?>
  <div id="content" class=" p-4 p-md-12">
    <?php include_once('../dashboard/nav-top.php');?>
    <div class="row">
      <div class="col-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Sponsor A Student
            <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-product">Add New</a>
          </div>
          <div class="panel-body">
            <table class="table table-bordered table-striped" id="product_list">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Student Name</th>
                  <th>Status</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if($sponsors){ ?>
                <?php foreach($sponsors as $sponsor):?>
                <tr id="product_id_<?php echo $sponsor->id;?>">
                  <td>
                    <?php echo $sponsor->id;?>
                  </td>
                  <td>
                    <?php echo $sponsor->student_name;?>
                  </td>
                  <td>
                    <?php echo $sponsor->description;?>
                  </td>
                  <td>
                    <?php echo $sponsor->status;?>
                  </td
                  <td>
                    <a href="javascript:void(0)" data-id="<?php echo $sponsor->id;?>" class="btn btn-info edit-product">Edit</a>
                <!--<a href="javascript:void(0)" data-id="<?php echo $sponsor->id;?>" class="btn btn-danger delete-user delete-product">Delete</a> -->
                  </td>
                </tr>
                <?php endforeach;?>
                <?php }else{ ?>
                <tr>
                  <td colspan="5">
                    No Sponsors Found
                  </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Model for add edit product -->
<div class="modal fade" id="ajax-product-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="productCrudModal"></h4>
      </div>
      <div class="modal-body">
        <form id="productForm" name="productForm" class="form-horizontal">
          <input type="hidden" name="product_id" id="product_id">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter Tilte" value="" maxlength="50" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Product Code</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Product Code" value="" maxlength="50" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" required="">
            </div>
          </div>
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
                     </button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<script>
   var SITEURL = '<?php echo base_url(); ?>';
 
   $(document).ready(function () {
 
      $("#product_list").DataTable();
 
      /*  When user click add user button */
 
      $('#create-new-product').click(function () {
         $('#btn-save').val("create-product");
         $('#product_id').val('');
         $('#productForm').trigger("reset");
         $('#productCrudModal').html("Add New Product");
         $('#ajax-product-modal').modal('show');
      });
 
      /* When click edit user */
 
      $('body').on('click', '.edit-product', function () {
 
         var product_id = $(this).data("id");
 
         console.log(product_id);
 
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
      });
 
      $('body').on('click', '.delete-product', function () {
 
         var product_id = $(this).data("id");
 
         if (confirm("Are You sure want to delete !")) {
            $.ajax({
               type: "Post",
               url: SITEURL + "product/delete",
               data: {
                  product_id: product_id
               },
               dataType: "json",
               success: function (data) {
                  $("#product_id_" + product_id).remove();
               },
               error: function (data) {
                  console.log('Error:', data);
               }
            });
         }
      });
 
   });
 
   if ($("#productForm").length > 0) {
      $("#productForm").validate({
 
         submitHandler: function (form) {
 
            var actionType = $('#btn-save').val();
 
            $('#btn-save').html('Sending..');
 
            $.ajax({
               data: $('#productForm').serialize(),
               url: SITEURL + "product/store",
               type: "POST",
               dataType: 'json',
               success: function (res) {
                  
                 var product = '<tr id="product_id_' + res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.title + '</td><td>' + res.data.product_code + '</td><td>' + res.data.description + '</td>';
 
                    product += '<td><a href="javascript:void(0)" id="" data-id="' + res.data.id + '" class="btn btn-info edit-product">Edit</a><a href="javascript:void(0)" id="" data-id="' + res.data.id + '" class="btn btn-danger delete-user delete-product">Delete</a></td></tr>';
                 
                 if (actionType == "create-product") {
                   
                     $('#product_list').prepend(product);
                 } else {
                     $("#product_id_" + res.data.id).replaceWith(product);
                 }
 
                  $('#productForm').trigger("reset");
                  $('#ajax-product-modal').modal('hide');
                  $('#btn-save').html('Save Changes');
               },
               error: function (data) {
                  console.log('Error:', data);
                  $('#btn-save').html('Save Changes');
               }
            });
         }
      })
   } 
</script>
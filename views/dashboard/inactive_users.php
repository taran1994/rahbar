<style>
.table-responsive {height:200px;}
</style>
<div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <th>ID</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Action</th>
    </thead>
    <tbody id="inativeUserTable">
      <?php foreach($inactive_users as $row): ?>
      <tr>   
          <td><?=$row->id?></td>
          <td><?=$row->full_name?></td>
          <td><?=$row->phone_number?></td>
          <td><a href="/UserCrud/user_management/edit/<?=$row->id?>" class="btn btn-info" role="button">Edit</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
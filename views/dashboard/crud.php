<?php 
foreach($css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<main>
  <div class="site-section">
    <div class="container">
      <!-- <div> -->
      <div class="row justify-content-center">
          <div style="padding: 10px">
              <?php echo $output; ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php foreach($js_files as $file): ?>
<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
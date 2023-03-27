<?php
if (!$this->session->userdata('logged_in')) redirect(site_url('login'));
?>
<div class="container mt-5">
<div class="alert alert-success" role="alert">
  <?php echo $message ?>
</div>
</div>
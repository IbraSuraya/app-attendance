<?php 
session_start();

// Check session status admin account 
if(!isset($_SESSION['success-login'])){
  header("Location: ../../auth/login.php?msg=001");
}else if($_SESSION['role'] != 'admin'){
  header("Location: ../../auth/login.php?msg=002");
}

$preTitle = "Position Data";
$title = "Add Data";
include('../layout/header.php');
include('../../auth/funcEncryp.php');

require_once('../../config.php');

?>
<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
    <div class="card col-md-6">
      <div class="card-body">
        <form action="<?= base_url("admin/dataPosition/addPosition.php")?>" method="POST">
          <div class="mb-3">
            <label for="">Name Position</label>
            <input type="text" class="form-control" name="position">
          </div>

          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('../layout/footer.php');?>

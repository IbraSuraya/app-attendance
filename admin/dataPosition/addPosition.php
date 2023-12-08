<?php 
session_start();
ob_start();

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
if(isset($_POST['submit'])){
  $position = htmlspecialchars($_POST['position']);
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty($position)){
      $msgError = "Your form is empty";
    }

    if(!empty($msgError)){
      $_SESSION['validAddPosition'] = $msgError;
    }else{
      $result = mysqli_query($connection, "INSERT INTO position (position) VALUES('$position')");

      $_SESSION['successAddPosition'] = "Successfully added data";
      header("Location: position.php");
      exit;
    }
  }
}

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

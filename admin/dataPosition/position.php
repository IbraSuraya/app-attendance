<?php 
session_start();

// Check session status admin account 
if(!isset($_SESSION['success-login'])){
  header("Location: ../../auth/login.php?msg=001");
}else if($_SESSION['role'] != 'admin'){
  header("Location: ../../auth/login.php?msg=002");
}

$preTitle = "Master Data";
$title = "Position Data";
include('../layout/header.php');
include('../../auth/funcEncryp.php');

require_once('../../config.php');
$result = mysqli_query($connection, "SELECT * FROM position ORDER BY ID DESC");

?>
<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
    <a href="<?= base_url("admin/dataPosition/addPosition.php")?>" class="btn btn-primary">
      <span class="text">
        <i class="fa-solid fa-circle-plus"></i>
        Add data
      </span>
    </a>
    <div class="row row-deck row-cards mt-1">
      <table class="table table-bordered">
        <tr class="text-center">
          <th>No.</th>
          <th>Position Name</th>
          <th>Action</th>
        </tr>
        <?php if(mysqli_num_rows($result) === 0) : ?>
        <tr>
          <td colspan="3" class="text-center">No data, please add new data</td>
        </tr>
        <?php else : ?>
        <?php 
        $numb = 1;
        while ($position = mysqli_fetch_array($result)) :?>
        <tr>
          <td><?= $numb++?></td>
          <td><?= $position['position']?></td>
          <td class="text-center">
            <a href="<?= base_url("admin/dataPosition/editPosition.php?id=" . encrypt_id($position['id']))?>" class="badge bg-primary p-2">Edit</a>
            <a href="<?= base_url("admin/dataPosition/deletePosition.php?id=" . encrypt_id($position['id']))?>" class="badge bg-danger p-2">Delete</a>
          </td>
        </tr>
        <?php endwhile;?>
        <?php endif;?>
      </table>
    </div>
  </div>
</div>
<?php include('../layout/footer.php');?>

<?php
  require('common/header.php');  
  if(!isset($_SESSION['admin'])){
    echo "<script> location.href='login'; </script>";
    exit;
  }
  
  if(isset($_GET['del'])){
    if(!delete('admins','admin_id',$_GET['del'])){
      echo('<p style="text-align:center;">Can\'t Delete Since Referring Contents Were Found.</p>');
    }
  }
?>

<style>
  .card-category {text-align:center;}
  .card-header{text-align:center;}
  .profile img{border-radius: 50%;max-width:150px;max-height:150px;}
  .chart-area ul{margin:15px;padding:0;display:flex;flex-direction:column;}
  .chart-area li{list-style:none;color:gray;font-size:20px;}
  .chart-area i{margin-right:20px;color:#BD2125;}
  .chart-area .courses{margin-left:50px;}
</style>


<div class="content">
  <div class="addElements">
    <a href="addElements.php?action=admins"><i class="fas fa-plus"></i>Add Admin</a>
  </div><br>
  <div class="row">
<?php
  $getAdmins = $data->prepare('SELECT * FROM admins ORDER BY firstname');
  $getAdmins->execute();

  foreach ($getAdmins as $admins) {
?>
    <div class="col-lg-4">
      <div class="card card-chart">
      <a class="delete" href = "javascript:void(0)" onclick="return confirmDelete('<?php echo 'admins.php?del='.$admins['admin_id']?>')"><i class="fas fa-times-circle"></i></a>
        <div class="card-header">
          <h5 class="card-category"><?php echo $admins['firstname'].' '.$admins['surname'] ?></h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <ul>
              <li><i class="fas fa-user-tag"></i><?php echo $admins['username'] ?></li>
              <li><i class="fas fa-envelope"></i><?php echo $admins['email'] ?></li>
          </div>
        </div>
      </div>
    </div>
<?php } ?>

  </div>
</div>

<?php
  require('common/footer.php');
?>
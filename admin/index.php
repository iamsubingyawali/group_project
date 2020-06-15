<?php
  require('common/header.php');
  if(!isset($_SESSION['admin'])){
    echo "<script> location.href='login'; </script>";
    exit;
	}
?>

<div class="content">
  <div class="row">

    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Total Site Visits</h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <?php
              $record = fopen("../records/record.txt", "r");
              $num = fread($record,filesize("../records/record.txt"));
              fclose($record);

              echo '<p>'.$num.'</p>'
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Admins Associated</h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <?php
              $get = $data->prepare('SELECT COUNT(admin_id) as number FROM admins');
              $get->execute();
              $get = $get->fetch();
            ?>
            <p><?php echo $get['number'] ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Running Programs</h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <?php
              $get = $data->prepare('SELECT COUNT(program_id) as number FROM programs');
              $get->execute();
              $get = $get->fetch();
            ?>
            <p><?php echo $get['number'] ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Students Enrolled</h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <?php
              $get = $data->prepare('SELECT COUNT(std_id) as number FROM students');
              $get->execute();
              $get = $get->fetch();
            ?>
            <p><?php echo $get['number'] ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Staffs Associated</h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <?php
              $get = $data->prepare('SELECT COUNT(stf_id) as number FROM staffs');
              $get->execute();
              $get = $get->fetch();
            ?>
            <p><?php echo $get['number'] ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Current Courses</h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <?php
              $get = $data->prepare('SELECT COUNT(course_id) as number FROM courses');
              $get->execute();
              $get = $get->fetch();
            ?>
            <p><?php echo $get['number'] ?></p>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>


<?php
  require('common/footer.php');
?>
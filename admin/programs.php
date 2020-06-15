<?php
  require('common/header.php');  
  if(!isset($_SESSION['admin'])){
    echo "<script> location.href='login'; </script>";
    exit;
	}
?>

<?php
  if(isset($_POST['add'])){
    unset($_POST['add']);
    $_POST['name'] = htmlspecialchars($_POST['name']);
    $add = $data->prepare("INSERT INTO programs(program_id,name)
    VALUES('',:name)");
    $add->execute($_POST);
  }

  if(isset($_GET['del'])){
    if(!delete('programs','program_id',$_GET['del'])){
      echo('<p style="text-align:center;">Can\'t Delete Since Referring Contents Were Found.</p>');
    }
  }
?>

<style>
  .chart-area h5{font-size:25px;margin-left:10px;}
  .addElements input,select{border-radius:5px;border:none;padding:5px;outline:none;}
  .addElements input[type="submit"]{background-color:#BD2125;color:white;font-size:17px;padding:4px 8px}
  .addElements input[type="submit"]:hover{opacity:0.7;}
  .chart-area h5{font-size:20px;}
  .card-chart .chart-area {height: 200px;}
  .chart-area li{font-size:17px;}
</style>

<div class="content">
  <div class="addElements">
    <form action="" method="POST">
      <input type="text" placeholder="Program Name" name="name">
      <input type="submit" value="Add" name="add">
    </form>
  </div><br>
  <div class="row">
  <?php
  $getPrograms = $data->prepare('SELECT * FROM programs ORDER BY name');
  $getPrograms->execute();

  foreach ($getPrograms as $programs) {?>
    <div class="col-lg-4">
      <div class="card card-chart">
      <a class="delete" href = "javascript:void(0)" onclick="return confirmDelete('<?php echo 'programs.php?del='.$programs['program_id']?>')"><i class="fas fa-times-circle"></i></a>
        <div class="card-header">
          <h5 class="card-category"><?php echo $programs['name']?></h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <h5 class="card-category">Courses Included</h5>
            <ul>
            <?php
              $getProgramCourses = $data->prepare("SELECT DISTINCT(courses.title),program_courses.course_id FROM 
                program_courses JOIN courses ON program_courses.course_id = courses.course_id
                WHERE program_courses.program_id = :program_id");
              $criteria = ['program_id' => $programs['program_id']];
              $getProgramCourses->execute($criteria);

              if($getProgramCourses->rowCount()>0){
              foreach ($getProgramCourses as $programCourses) {?>
              <li><?php echo $programCourses['title'] ?></li>
            <?php } }
            else{
              echo "None";
            }?>
            </ul>
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
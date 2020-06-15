<?php
  require('common/header.php');  
  if(!isset($_SESSION['admin'])){
    echo "<script> location.href='login'; </script>";
    exit;
  }

  if(isset($_GET['del'])){
    if(!delete('courses','course_id',$_GET['del'])){
      echo('<p style="text-align:center;">Can\'t Delete Since Referring Contents Were Found.</p>');
    }
  }
?>

<?php
  if(isset($_POST['add'])){
    unset($_POST['add']);
    $program_id = $_POST['program_id'];
    unset($_POST['program_id']);
    $_POST['title'] = htmlspecialchars($_POST['title']);
    $add = $data->prepare("INSERT INTO courses(course_id,title)
    VALUES('',:title)");

    $getCourse = $data->prepare('SELECT * FROM courses WHERE title = :title');
    $criteria = ['title' => $_POST['title']];
    $getCourse->execute($criteria);

    if($getCourse->rowCount()<1){
      $course_id = $data->lastInsertId();
      $add->execute($_POST);
    }

    else{
      $getCourse = $getCourse->fetch();
      $course_id = $getCourse['course_id'];
    }

    $add = $data->prepare("INSERT INTO program_courses(program_id,course_id)
          VALUES(:program_id,:course_id)");
    $criteria = [
      'program_id' => $program_id,
      'course_id' => $course_id
    ];
    $add->execute($criteria);
  }
?>

<style>
  .chart-area h5{font-size:25px;margin-left:10px;}
  .addElements input,select{border-radius:5px;border:none;padding:5px;outline:none;}
  .addElements input[type="submit"]{background-color:#BD2125;color:white;font-size:17px;padding:4px 8px}
  .addElements input[type="submit"]:hover{opacity:0.7;}
</style>

<div class="content">
  <div class="addElements">
    <form action="" method="POST">
      <input type="text" placeholder="Course Name" name="title">
      <select name="program_id">
        <?php
          $getPrograms = $data->prepare('SELECT * FROM programs ORDER BY name');
          $getPrograms->execute();
          
          foreach ($getPrograms as $programs) {?>
            <option value="<?php echo $programs['program_id'] ?>"><?php echo $programs['name'] ?></option>
          <?php } ?>
      </select>
      <input type="submit" value="Add" name="add">
    </form>
  </div><br>
  <div class="row">
  <?php
  $getCourses = $data->prepare('SELECT * FROM courses ORDER BY title');
  $getCourses->execute();

  foreach ($getCourses as $courses) {?>
    <div class="col-lg-4">
      <div class="card card-chart">
      <a class="delete" href = "javascript:void(0)" onclick="return confirmDelete('<?php echo 'courses.php?del='.$courses['course_id']?>')"><i class="fas fa-times-circle"></i></a>
        <div class="card-header">
        </div>
        <div class="card-body">
          <div class="chart-area">
            <h5 class="card-category"><?php echo $courses['title']?></h5>
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
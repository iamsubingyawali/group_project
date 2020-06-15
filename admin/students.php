<?php
  require('common/header.php');
  if(!isset($_SESSION['admin'])){
    echo "<script> location.href='login'; </script>";
    exit;
	}
?>

<?php
  if(isset($_POST['enroll'])){
    unset($_POST['enroll']);
    $enroll = $data->prepare("INSERT INTO student_courses(std_id,course_id)
    VALUES(:std_id,:course_id)");
    $enroll->execute($_POST);
  }

  if(isset($_GET['del'])){
    if(!delete('students','std_id',$_GET['del'])){
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
  .chart-area .courses li{list-style: circle;}
  .card-chart .chart-area {height: 500px;}
  .enroll input,select{border-radius:5px;padding:5px;outline:none;border:none;}
  .enroll input[type="submit"]{padding:3px 5px;background-color:#BD2125;color:white;}
</style>

<div class="content">
  <div class="addElements">
    <a href="addElements.php?action=students"><i class="fas fa-plus"></i>Add Student</a>
  </div><br>
  <div class="row">
<?php
  $getStudents = $data->prepare('SELECT * FROM students ORDER BY firstname');
  $getStudents->execute();

  foreach ($getStudents as $students) {
?>
    <div class="col-lg-4">
      <div class="card card-chart">
        <a class="delete" href = "javascript:void(0)" onclick="return confirmDelete('<?php echo 'students.php?del='.$students['std_id']?>')"><i class="fas fa-times-circle"></i></a>
        <div class="card-header">
          <div class="profile">
            <img src="../images/profiles/<?php echo $students['profile_img'] ?>" alt="">
          </div>
          <h5 class="card-category"><?php echo $students['firstname'].' '.$students['surname'] ?></h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <ul>
              <li><i class="fas fa-id-card"></i><?php echo $students['std_id'] ?></li>
              <li><i class="fas fa-venus-mars"></i><?php echo $students['gender'] ?></li>
              <li><i class="fas fa-envelope"></i><?php echo $students['email'] ?></li>
              <li><i class="fas fa-phone"></i><?php echo $students['phone'] ?></li>
              <li><i class="fas fa-birthday-cake"></i><?php echo $students['birthdate'] ?></li>
              <li><i class="fas fa-map-marked-alt"></i><?php echo $students['address'] ?></li>
              <li class="enroll"><i class="fab fa-buffer"></i>Courses Enrolled
                <ul class="courses">
                  <?php
                    $getCourses = $data->prepare('SELECT DISTINCT(title),student_courses.* FROM student_courses
                    JOIN courses ON student_courses.course_id = courses.course_id
                    WHERE student_courses.std_id = '.$students['std_id']);
                    $getCourses->execute();

                    foreach ($getCourses as $courses) { ?>
                      <li><?php echo $courses['title'] ?></li>
                    <?php } ?>
                </ul>
                <form action="" method="POST">
                  <input type="hidden" name="std_id" value="<?php echo $students['std_id'] ?>">
                  <?php $getCourse = $data->prepare('SELECT * FROM courses ORDER BY title');
                    $getCourse->execute();
                  ?>
                  <select name="course_id">
                    <?php foreach ($getCourse as $course) {?>
                      <option value="<?php echo $course['course_id'] ?>"><?php echo $course['title'] ?></option>
                    <?php } ?>
                  </select><br><br>
                  <input type="submit" name="enroll" value="Enroll">
                </form>
              </li>
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
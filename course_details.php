<?php
	session_start();
    if(!isset($_SESSION['stf']) && !isset($_SESSION['std'])){
		header('Location:login');
    }
    else{
        if(!isset($_GET['course_id'])){
            header('Location:courses.php');
        }
    }
    require('common/header.php');

    $criteria = [
        'course_id' => $_GET['course_id']
    ];
    $query = $data->prepare('SELECT * FROM courses WHERE course_id = :course_id');
    $query->execute($criteria);
    $course = $query->fetch();
?>

<?php  
    $class1 = $class2 = $class3 = $class4 = $class4 = $class5 = $class6 = $class7 = $class8 = " ";
    $url = basename($_SERVER['REQUEST_URI']);

    list($page,) = explode('?', $url);


    if ($page == "course_details_content.php")$class1 = "focus";
    else if ($page == "course_details_assessments.php") $class2 = "focus";
    else if ($page == "course_details_view.php") $class3 = "focus";
    else if ($page == "course_details_announcements.php") $class4 = "focus";
    else if ($page == "course_details_resources.php") $class5 = "focus";
    else if ($page == "course_details_submit.php") $class6 = "focus";
    else if ($page == "course_details_grades.php") $class7 = "focus";
    else if ($page == "course_details_about.php") $class8 = "focus";
    else if ($page == "course_details_attendance.php") $class9 = "focus";
?>

<style>
    h4{margin:10px 10px -10px 10px;background-color:black;width:fit-content;padding:8px;
    color:white;border-radius:5px;}
    .course-menus{display:flex;flex-wrap:wrap;}
    .course-menus li{list-style:none;padding:2px 8px;margin-right:30px;margin-top:20px;font-size:18px;font-weight:600}
    .course-menus a{color:black;}
    .course-menus li:hover{color:#BD2125}
    .focus{background-color:#BD2125;color:white;border-radius:5px;}
    .course-menus .focus:hover{color:white;}
</style>

<h4><?php echo $course['title'] ?></h4>
<hr style="margin-bottom:-2px;">
<ul class="course-menus">
    <a href="course_details_content.php?course_id=<?php echo $_GET['course_id']?>"><li class="<?php echo $class1 ?>">Content</li></a>
    <a href="course_details_assessments.php?course_id=<?php echo $_GET['course_id']?>"><li class="<?php echo $class2 ?>">Assessments</li></a>

    <?php if(isset($_SESSION['stf'])) {?>
        <a href="course_details_view.php?course_id=<?php echo $_GET['course_id']?>"><li class="<?php echo $class3 ?>">View</li></a>
        <a href="course_details_attendance.php?course_id=<?php echo $_GET['course_id']?>"><li class="<?php echo $class9 ?>">Attendance</li></a>
    <?php } ?>

    <?php if(isset($_SESSION['std'])) {?>
        <a href="course_details_announcements.php?course_id=<?php echo $_GET['course_id']?>"><li class="<?php echo $class4 ?>">Announcements</li></a>
        <a href="course_details_resources.php?course_id=<?php echo $_GET['course_id']?>"><li class="<?php echo $class5 ?>">Resources</li></a>
        <a href="course_details_submit.php?course_id=<?php echo $_GET['course_id']?>"><li class="<?php echo $class6 ?>">Submit</li></a>
        <a href="course_details_grades.php?course_id=<?php echo $_GET['course_id']?>"><li class="<?php echo $class7 ?>">Grades</li></a>
    <?php } ?>

    <a href="course_details_about.php?course_id=<?php echo $_GET['course_id']?>"><li class="<?php echo $class8 ?>">About</li></a>
</ul>
<hr style="height:2px;background-color:gray;" />
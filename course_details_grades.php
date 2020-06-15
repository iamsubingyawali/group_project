<?php
    require('course_details.php');

    $std = false;
    if(isset($_SESSION['std'])){
        $std = true;
    }

    if(isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];
    }

    
?>

<style>
    
    .grades h3{font-weight:550;font-size:18px;}
    .grades li{color:black;list-style:none;font-weight:bold;font-size:17px;}
    .grades{margin:0 20px 20px 40px}
    .fa-graduation-cap{margin-right:10px;cursor:pointer;color:#BD2125;}
    .grades a{color:green;font-size:20px;margin:0 5px;}
</style>

<?php if($std){ ?>

    <div class="grades">
        <h3><i class="fas fa-graduation-cap"></i> Current Grades</h3>
        <?php
            $upCriteria = [
                'std_id' => $_SESSION['std']['std_id'],
                'course_id' => $_GET['course_id']
            ];

            $grade = $data->prepare('SELECT * FROM grades WHERE std_id = :std_id AND course_id = :course_id ORDER BY date DESC');
            $grade->execute($upCriteria);
            $grade = $grade->fetch();

            $marks = $grades = "~";
            if($grade['marks'] != null){
                $marks = $grade['marks'];
                $grades = $grade['grade'];
            }
        ?>
        <ul>
            <li>Marks: <a><?php echo $marks ?></a> out of 100</li>
            <li>Grade: <a><?php  echo $grades ?></a></li>
        </ul>
    </div>

<?php
    }
    require('common/footer.php');
?>
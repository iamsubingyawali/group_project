<?php
    require('course_details.php');

    if(isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];
    }

    $staff = false;
    if(isset($_SESSION['stf'])){
        $staff = true;
    }

    $query = $data->prepare('SELECT * FROM courses WHERE course_id = '.$course_id);
    $query->execute();
    $course = $query->fetch();
?>


<?php
    if(isset($_POST['add'])){
        $date = $_POST['date'];
        $time = $_POST['time'];
        $deadline = date('Y-m-d H:i:s', strtotime("$date $time"));

        $file_name = ' ';
        if(isset($_FILES['file'])){
            $file_name = $_FILES['file']['name'];
            $tempDest = $_FILES['file']['tmp_name'];
            $permDest= 'files/'.$course['title'].'/Assessments'.'/';
            if(!is_dir($permDest)){
                mkdir($permDest);
            }
            $permDest= 'files/'.$course['title'].'/Assessments'.'/'. $file_name;
            if($file_name != ''){
                copy($tempDest, $permDest);
            }
        }

        $criteria = [
            'description' => $_POST['description'],
            'deadline' => $deadline,
            'file' => $file_name,
            'course_id' => $course_id,
            'stf_id' => $_SESSION['stf']['stf_id']
        ];

        $add = $data->prepare("INSERT INTO assessments(assess_id,description,deadline,file,course_id,stf_id)
        VALUES('',:description,:deadline,:file,:course_id,:stf_id)");
        if($add->execute($criteria)){
            unset($criteria);
            $annCriteria = [
                'announcement' => "Assessment Added",
                'course_id' => $_GET['course_id'],
                'stf_id' => $_SESSION['stf']['stf_id']
            ];

            $announce = $data->prepare("INSERT INTO announcements(ann_id,announcement,date,course_id,stf_id)
            VALUES('',:announcement,DEFAULT,:course_id,:stf_id)");
            if($announce->execute($annCriteria)){
                unset($annCriteria);
            }
        }
    }
?>

<?php
    if(isset($_GET['del'])){
        $assess_id = $_GET['del'];
        $delete = $data->prepare('DELETE FROM assessments WHERE assess_id = '.$assess_id);

        $fetch = $data->prepare('SELECT file FROM assessments WHERE assess_id = '.$assess_id);
        $fetch->execute();
        $fetch = $fetch->fetch();

        if($delete->execute()){
            $file = 'files/'.$course['title'].'/'.'Assessments/'.$fetch['file'];
            if(!is_dir($file)){
                unlink($file);
            }
        }

    }
?>


<style>    
    .add-assessments{margin:20px 5px;background-color:#BD2125;
    padding:20px;border-radius:10px;display:none;}
    label{color:white;}
    input,textarea{border-radius:5px;outline:none;border:none;padding:2px 10px;color:black;}
    input[type="submit"]{font-size:18px;background-color:white;
    color:#BD2125;border:none;padding:1px 8px;}
    input[type="submit"]:hover{opacity:0.7}
    .assessments{margin:0 20px 20px 40px}
    .assessments a{font-size:17px}
    .assessments p{color:black;font-weight:bold;font-size:17px}
    .assessments p span{color:red;}
    .assessments h3{font-weight:550;font-size:18px;}
    .fa-minus-square{margin-right:10px;cursor:pointer;color:#BD2125;}
    .fa-minus-square:hover{color:black;}
</style>

<div class="assessments">
    <?php
        $get = $data->prepare('SELECT * FROM assessments WHERE course_id ='.$course_id.' ORDER BY deadline');
        $get->execute();
        foreach ($get as $assessment) { ?>
        <h3><?php if($staff){ ?><a href="course_details_assessments.php?del=<?php echo $assessment['assess_id'] ?>&course_id=<?php echo $course_id ?>"><i class="fas fa-minus-square"></i></a><?php } ?><?php echo $assessment['description'] ?></h3>            
        <ul>
            <a href="files/<?php echo $course['title'].'/Assessments//'.$assessment['file'] ?>"><?php echo $assessment['file'] ?></a>
            <p>Deadline: <?php echo '<span>'.$assessment['deadline'].'</span>' ?></p>
        </ul>
        <hr>
        <?php } ?>
</div>

<div class="add-assessments">
    <form action="" method="POST" enctype="multipart/form-data">

        <label>Input Assessment Description</label><br>
        <textarea name="description" cols="50" rows="5"></textarea><br><br>

        <label>Specify Deadline</label><br>
        <input type="date" name="date">
        <input type="time" name="time" step="1"><br><br>

        <label>
            <label>Add File</label>
            <input type="file" name="file">
        </label><br><br>

        <input type="submit" value="Add" name="add">
    </form>
</div>

<?php if($staff){ ?>
    <div class="add-contents">
        <a href="javascript:void(0)" id="add-button" onclick="return showWindow(event)">Add Assessment</a>
    </div>
<?php } ?>

<?php
    require('common/footer.php');
?>
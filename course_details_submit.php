<?php
    require('course_details.php');

    $std = false;
    if(isset($_SESSION['std'])){
        $std = true;
    }

    if(isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];
    }

    $query = $data->prepare('SELECT * FROM courses WHERE course_id = '.$course_id);
    $query->execute();
    $course = $query->fetch();

    $query0 = $data->prepare("SELECT CONCAT(firstname,' ',surname) as name FROM students
                            WHERE std_id = :std_id");
    $query0->execute($_SESSION['std']);
    $student = $query0->fetch();
?>

<?php
    if(isset($_FILES['file'])){
        $file_name = $_FILES['file']['name'];
        $tempDest = $_FILES['file']['tmp_name'];
        $permDest= 'uploads/'.$course['title'].'/'.$student['name'];
        if(!is_dir($permDest)){
            mkdir($permDest,0777,true);
        }
        $permDest= 'uploads/'.$course['title'].'/'.$student['name'].'/'. $file_name;
        if($file_name != ''){
            copy($tempDest, $permDest);
        }

        $criteria = [
            'std_id' => $_SESSION['std']['std_id'],
            'course_id' => $course_id,
            'file' => $file_name
        ];

        $upload = $data->prepare("INSERT INTO uploads(upd_id,std_id,course_id,file)
                                VALUES('',:std_id,:course_id,:file)");
        $upload->execute($criteria);
    }


    if(isset($_GET['del'])){
        $del = $_GET['del'];
        $getFile = $data->prepare('SELECT file FROM uploads WHERE upd_id = '.$del);
        $getFile->execute();

        if($getFile->rowCount()>0){
            $getFile = $getFile->fetch();
            $delete = $data->prepare('DELETE FROM uploads WHERE upd_id = '.$del);

            if($delete->execute()){

                $file = 'uploads/'.$course['title'].'/'.$student['name'].'/'.$getFile['file'];

                if(!is_dir($file)){
                    unlink($file);
                }
                unset($_GET['del']);
            }
        }
    }
?>


<style>
    .submit{margin:0 20px 20px 40px}
    .submit a{font-size:17px;}
    .submit h3{font-weight:550;font-size:18px;}
    input[type="file"]{display:none;}
    .add-contents a{cursor:pointer;}
    .fa-minus-square{color:#BD2125;margin-left:10px;cursor:pointer;}
    .fa-minus-square:hover{color:black;}
</style>

<?php if($std) { ?>
    <div class="submit">
        <?php
            $get = $data->prepare('SELECT uploads.* FROM uploads JOIN students 
            ON uploads.std_id = students.std_id WHERE uploads.std_id = :std_id');
            $get->execute($_SESSION['std']);

            if($get->rowCount()>0){ ?>
                <h3>Uploaded Files</h3>
            <?php } ?>
        <?php foreach ($get as $uploads) { ?>
                <ul>
                    <li><a href="uploads/<?php echo $course['title'].'/'.$student['name'].'/'.$uploads['file'] ?>"><?php echo $uploads['file'] ?></a><a href="course_details_submit.php?del=<?php echo $uploads['upd_id'] ?>&course_id=<?php echo $course_id ?>"><i class="fas fa-minus-square"></a></i></li>
                </ul>
            <hr>
        <?php } ?>
    </div>

    <?php if($std){ ?>
        <div class="add-contents">
            <form action="" method="POST" name="file" enctype="multipart/form-data">
                <label>
                    <input type="file" name="file" multiple onchange="this.form.submit();">
                    <a id="upload-button">Submit Work</a>
                </label>
            </form>
        </div>
    <?php } ?>
<?php } ?>


<?php
    require('common/footer.php');
?>
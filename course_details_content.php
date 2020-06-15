<?php
    require('course_details.php');
    $staff = false;
    if(isset($_SESSION['stf'])){
        $staff = true;
    }

    if(isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];
    }

    $query = $data->prepare('SELECT * FROM courses WHERE course_id = '.$course_id);
    $query->execute();
    if ($query->rowCount()<1){echo "<script> location.href='courses.php'; </script>";exit;}
    $course = $query->fetch();
?>

<?php
    if(isset($_GET['topic_del'])){
        unset($_GET['course_id']);
        
        $getTopic = $data->prepare('SELECT name FROM course_topics WHERE topic_id = :topic_del');
        $getTopic->execute($_GET);
        $getTopic = $getTopic->fetch();

        $delete = $data->prepare('DELETE FROM course_topics WHERE topic_id = :topic_del');
        if($delete->execute($_GET)){
            $folder = 'files/'.$course['title'].'/'.$getTopic['name'];
            if(is_dir($folder))rmdir($folder);
        }
    }

    if(isset($_GET['file_del'])){
        unset($_GET['course_id']);

        $topic_id = $_GET['topic'];
        unset($_GET['topic']);

        $getTopic = $data->prepare('SELECT name FROM course_topics WHERE topic_id = '.$topic_id);
        $getTopic->execute($_GET);
        $getTopic = $getTopic->fetch();

        $getFile = $data->prepare('SELECT name FROM files WHERE file_id = :file_del');
        $getFile->execute($_GET);
        $getFile = $getFile->fetch();

        $delete = $data->prepare('DELETE FROM files WHERE file_id = :file_del');
        if($delete->execute($_GET)){
            unlink('files/'.$course['title'].'/'.$getTopic['name'].'/'.$getFile['name']);
        }
    }
?>

<?php

    if(isset($_POST['topic_id'])){

        $query0 = $data->prepare('SELECT name FROM course_topics WHERE topic_id = :topic_id');
        $query0->execute($_POST);
        $topicName = $query0->fetch();

        $folder = 'files/'.$course['title'].'/'.$topicName['name'];

        if(!is_dir($folder)){
            mkdir($folder,0777,true);
        }

        for($i=0;$i<count($_FILES['files']['name']);$i++){

            $fileName = $_FILES['files']['name'][$i];
            $tempDest = $_FILES['files']['tmp_name'][$i];

            $permDest= $folder.'/' . $fileName;
            copy($tempDest, $permDest);

            $criteria = [
                'name' => $fileName,
                'stf_id' => $_SESSION['stf']['stf_id'],
                'course_id' => $course_id,
                'topic_id' => $_POST['topic_id']
            ];

            $query1 = $data->prepare("INSERT INTO files(file_id,name,stf_id,course_id,topic_id)
                                VALUES('',:name,:stf_id,:course_id,:topic_id)");

            $check = $data->prepare('SELECT name FROM files WHERE course_id = :course_id
                                    AND name = :name AND topic_id = :topic_id');
            $checkCriteria = [
                'name' => $fileName,
                'course_id' => $course_id,
                'topic_id' => $_POST['topic_id']
            ];

            $check->execute($checkCriteria);

            if($check->rowCount()<1){
                if($query1->execute($criteria)){
                    unset($criteria);

                    $annCriteria = [
                        'announcement' => "Files Uploaded",
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
        }
    }
?>

<style>
    .contents li{font-size:17px;}
    .contents{display:none;}
    .course-contents{margin:0 20px 20px 40px}
    h5:hover{opacity:0.7}
    .course-contents h3{font-size:18px;cursor:pointer;}
    .course-contents i{margin-left:15px;color:#BD2125;}
    .course-contents i:hover{color:black;}
    .show-contents{display:block;}
    input[type="file"]{display:none;}
    form,label,h5{margin:0;padding:0}
    form{margin-top:20px;}
    h5{color:#BD2125;font-weight:bold;cursor:pointer;}
    .fa-minus-square{margin-right:10px;cursor:pointer;}
</style>

<div class="course-contents">

    <?php
        $query1 = $data->prepare('SELECT * FROM course_topics WHERE course_id = '.$course_id.' ORDER BY topic_num');
        $query1->execute();

        $query2 = $data->prepare('SELECT DISTINCT(name),file_id FROM files 
                                WHERE course_id = :course_id AND topic_id = :topic_id ORDER BY name');
        

        foreach ($query1 as $topic) { ?>
            <h3 id="<?php echo 'h3'.$topic['topic_id'] ?>" onclick= "return hide_h3(event)" ><?php if($staff){ ?><a href="course_details_content.php?topic_del=<?php echo $topic['topic_id'] ?>&course_id=<?php echo $course_id ?>"><i class="fas fa-minus-square"></i></a><?php } echo 'Topic '.$topic['topic_num'].' - '.$topic['name'] ?><i class="fas fa-caret-down" onclick= "return hide(event)" id="<?php echo $topic['topic_id'] ?>"></i></h3>
            <ul class="contents">
                <?php 
                $criteria = ['course_id' => $course_id,'topic_id' => $topic['topic_id']];
                $query2->execute($criteria);
                if ($query2->rowCount()<1){echo 'No Content';}
                foreach ($query2 as $file) { ?>
                    <li><?php if($staff){ ?><a href="course_details_content.php?file_del=<?php echo $file['file_id'] ?>&course_id=<?php echo $course_id ?>&topic=<?php echo $topic['topic_id'] ?>"><i class="fas fa-minus-square"></i></a><?php } ?><a href="files/<?php echo $course['title'].'/'.$topic['name'].'/'.$file['name'] ?>"><?php echo $file['name'] ?></a></li>
                <?php } ?>
                <?php
                    if($staff){ ?>
                        <form action="" method="POST" name="upload_file" enctype="multipart/form-data">
                            <label>
                                <input type="hidden" name="topic_id" value="<?php echo $topic['topic_id']?>">
                                <input type="file" name="files[]" multiple onchange="this.form.submit();">
                                <h5>Add Files</h5>
                            </label>
                        </form>
                    <?php } ?>
            </ul>
        <hr>
    <?php } ?>
</div>

<?php if($staff){ ?>
    <div class="add-contents">
        <a href="add_content.php?course_id=<?php echo $course_id ?>">Add Content</a>
    </div>
<?php } ?>


<?php
    require('common/footer.php');
?>
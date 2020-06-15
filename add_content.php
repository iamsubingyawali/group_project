<?php
    require('common/header.php');

    if(!isset($_GET['course_id'])){
        header("Location:courses.php");
    }
?>

<?php
    if(isset($_POST['add'])){
        unset($_POST['add']);

        $criteria = [
            'topic_num' => $_POST['topic_num'],
            'name' => $_POST['name'],
            'course_id' => $_GET['course_id']
        ];

        $query = $data->prepare("INSERT INTO course_topics(topic_id,topic_num,name,course_id)
                            VALUES('',:topic_num,:name,:course_id)");

        if($query->execute($criteria)){
            $topic_id = $data->lastInsertId();
            
            $query = $data->prepare('SELECT * FROM courses WHERE course_id = :course_id');
            $query->execute($_GET);
            $course = $query->fetch();

            if($_FILES['files']['name'][0] != ''){

                $topicName = $_POST['name'];

                for($i=0;$i<count($_FILES['files']['name']);$i++){

                    $fileName = $_FILES['files']['name'][$i];
                    $tempDest = $_FILES['files']['tmp_name'][$i];
                    $folder = 'files/'.$course['title'].'/'.$topicName;

                    if(!is_dir($folder)){
                        mkdir($folder,0777,true);
                    }
                    $permDest= $folder.'/' . $fileName;
                    copy($tempDest, $permDest);

                    $criteria = [
                        'name' => $fileName,
                        'stf_id' => $_SESSION['stf']['stf_id'],
                        'course_id' => $_GET['course_id'],
                        'topic_id' => $topic_id
                    ];

                    $query1 = $data->prepare("INSERT INTO files(file_id,name,stf_id,course_id,topic_id)
                                        VALUES('',:name,:stf_id,:course_id,:topic_id)");

                    $check = $data->prepare('SELECT name FROM files WHERE course_id = :course_id
                                            AND name = :name AND topic_id = :topic_id');
                    $checkCriteria = [
                        'name' => $fileName,
                        'course_id' => $_GET['course_id'],
                        'topic_id' => $topic_id
                    ];

                    $check->execute($checkCriteria);

                    if($check->rowCount()<1){
                        if($query1->execute($criteria)){
                            unset($criteria);

                            $annCriteria = [
                                'announcement' => "Content Added",
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
        }
    }
?>


<style>
    .add-content{display:flex;justify-content:center;margin:20px 5px;background-color:#BD2125;
    padding:20px;border-radius:10px;}
    label{color:white;}
    input,select{border-radius:5px;outline:none;border:none;padding:2px 10px;color:black;}
    input[type="submit"]{font-size:18px;background-color:white;
    color:#BD2125;border:none;padding:1px 8px;}
    input[type="submit"]:hover{opacity:0.7}
</style>

<div class="add-content">
    <form action="" method="POST" enctype="multipart/form-data">

        <label>Input Topic Number</label><br>
        <input type="number" name="topic_num" min="1"><br><br>

        <label>Input Topic Name</label><br>
        <input type="text" name="name"><br><br>

        <label>
            <label>Add Files</label>
            <input type="file" name="files[]" multiple>
        </label><br><br>

        <input type="submit" value="Add" name="add">
    </form>
</div>
<?php
    require('common/footer.php');
?>
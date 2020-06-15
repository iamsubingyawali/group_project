<?php
    require('course_details.php');

    $query = $data->prepare('SELECT DISTINCT(std.firstname),std.surname,std.std_id FROM students std JOIN student_courses std_c
    ON std.std_id = std_c.std_id JOIN staff_courses stf_c
    ON stf_c.course_id = std_c.course_id
    WHERE stf_c.stf_id = :stf_id
    AND stf_c.course_id = :course_id
    ORDER BY std.firstname');

    $criteria = [
        'stf_id' => $_SESSION['stf']['stf_id'],
        'course_id'=>$_GET['course_id']
    ];
?>

<?php
    if(isset($_POST['save'])){
        unset($_POST['save']);

        $fetchAtt = $data->prepare("SELECT * FROM attendance WHERE course_id = :course_id AND date = :date");
        $fetchCriteria = [
            'course_id' => $_GET['course_id'],
            'date' => $_POST['date']
        ];
        $fetchAtt->execute($fetchCriteria);

        if($fetchAtt->rowCount()<1){

            if(isset($_POST['present'])){
                foreach ($_POST['present'] as $key => $value) {
                    $present = $data->prepare("INSERT INTO attendance(attend_id,date,status,course_id,std_id)
                    VALUES('',:date,:status,:course_id,:std_id)");

                    $presentCriteria = [
                        'date' => $_POST['date'],
                        'status' => 'Present',
                        'course_id' => $_GET['course_id'],
                        'std_id' => $key
                    ];
                    $present->execute($presentCriteria);
                }
            }

            if(isset($_POST['absent'])){
                foreach ($_POST['absent'] as $key => $value) {
                    $absent = $data->prepare("INSERT INTO attendance(attend_id,date,status,course_id,std_id)
                    VALUES('',:date,DEFAULT,:course_id,:std_id)");

                    $absentCriteria = [
                        'date' => $_POST['date'],
                        'course_id' => $_GET['course_id'],
                        'std_id' => $key
                    ];
                    $absent->execute($absentCriteria);
                }
            }
        }
        else echo '<h5 style="margin-left:25px;color:red;font-weight:bold;font-size:15px;">Existing Attendance Data Found For Same Date. Please Delete Previous One And Try Again.</h5>';
    }

    if(isset($_GET['delDate'])){
        $delete = $data->prepare("DELETE FROM attendance WHERE course_id = :course_id 
        AND date = :delDate");
        if($delete->execute($_GET)) echo '<h5 style="color:green;margin-left:28px;">Data Deleted Successfully.</h5>';
    }
?>

<link rel="stylesheet" href="table/main.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Martel+Sans&display=swap" rel="stylesheet">

<style>
    .wrap-table100{width:100%;}
    .column{width:auto;padding:0 40px;text-align:center;}
    .columnDate{width:250px;padding:0 60px;}
    .add-contents i{margin-right:10px;}
    input[type="checkbox"]{margin:0 10px;transform:scale(1.5);}  
    .attend{display:none;}
    .attend a{font-size:20px;color:rgb(37, 34, 34);}
    .attend input[type="submit"]{font-size:18px;background-color:green;
    color:white;border:none;padding:1px 8px;border-radius:5px;margin:20px;}
    .attend input[type="submit"]:hover{opacity:0.7}
    .attend h3{font-size:18px;text-decoration:underline;}
    .attend label{color:black;font-size:18px;}
    .attend input[type="date"]{border-radius:5px;border:none;margin-left:10px;
    padding:5px 8px;background-color:black;color:white;text-transform:uppercase;outline:none;
    box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.75);}
    .dateHead{font-size:18px;}
    .focusA{color:red;font-weight:bold;}
    .attend h5{color:red;}
    .fa-minus-circle{margin-right:10px;color:red;}
    .fa-minus-circle:hover{color:black;}
    #mark-all{background-color:#BD2125;color:white;border-radius:5px;padding:5px;}
</style>

<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="add-contents">
                <a onclick = "return addAttendance()" href="javascript:void(0)"><i class="fa fa-plus"></i>Add</a>
            </div>
            <div class="attend">
                <form action="" method="POST">
                <h5>If Attendance Data Previously Exists For Same Date, Data Won't Be Recorded. Please Delete Previous One to Record Anyway.</h5>
                <label>Specify Date For Attendance: </label>
                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required><br><br>
                <h3>Mark All Present Students</h3>
                <a id="mark-all" href="javscript:void(0)" onclick="return markAll()">Mark All</a><br><br>
            <?php                
                $query->execute($criteria);
                foreach ($query as $student) { ?>
                <input type="hidden" class="hiddenElements" id="absent[<?php echo $student['std_id'] ?>]" value="0" name="absent[<?php echo $student['std_id'] ?>]">
                <input type="checkbox" class="present" onclick="return presentCheck(event)" id="present[<?php echo $student['std_id'] ?>]" value="0" name="present[<?php echo $student['std_id'] ?>]"><a><?php echo $student['firstname'].' '.$student['surname'].'<br>'; } ?></a>
                <input type="submit" value="Save" name="save">
                </form>
            </div>
            <div class="table100">
                <table>
                    <thead>
                        <tr class="table100-head">
                        <?php                
                            $query->execute($criteria);
                                echo '<th class="column columnDate">Date</th>';
                            foreach ($query as $student) { ?>
                                <th class="column"><?php echo $student['firstname'].' '.$student['surname'] ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $getDates = $data->prepare('SELECT DISTINCT(date) FROM attendance WHERE course_id = :course_id ORDER BY date');
                            $getDateCriteria = [
                                'course_id' => $_GET['course_id']
                            ];
                            $getDates->execute($getDateCriteria);

                            foreach ($getDates as $date) {
                        ?>
                        <tr>
                            <th class="column dateHead"><a href="course_details_attendance.php?course_id=<?php echo $_GET['course_id']?>&delDate=<?php echo $date['date']?>"><i class="fa fa-minus-circle"></i></a><?php echo $date['date'] ?></th>
                            <?php

                            $query->execute($criteria);
                            foreach ($query as $student){
                                $getAtt = $data->prepare("SELECT * FROM attendance WHERE std_id = :std_id
                                AND date = :date AND course_id = :course_id");
                                
                                $criteriaAtt = [
                                    'std_id' => $student['std_id'],
                                    'date' => $date['date'],
                                    'course_id' => $_GET['course_id']
                                ];

                                $getAtt->execute($criteriaAtt);
                                if($getAtt->rowCount()>0){
                                    foreach ($getAtt as $content) {?>
                                        <td class="column <?php if($content['status'] == 'Absent')echo 'focusA' ?>"><?php echo $content['status'] ?></td>
                                    <?php } 
                                } else echo '<td class="column">-</td>';?>
                            <?php } ?>
                        </tr> 
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php
    require('common/footer.php');
?>
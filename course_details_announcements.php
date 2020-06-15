<?php
    require('course_details.php');

    if(isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];
    }
?>


<style>
    .announcements p{color:black;font-size:17px;padding:0;margin:0;}
    .announcements h3{font-weight:bold;font-size:18px;}
    .announcements{margin:0 20px 20px 40px}
    .announcements li{list-style:none;}
    .announcements a{color:#BD2125;font-weight:bold;}
    .fa-bullhorn{margin-right:10px;color:#BD2125;}
</style>

<div class="announcements">
    <?php
        $announces = $data->prepare("SELECT announcements.*,CONCAT(firstname,' ',surname) as name FROM announcements JOIN staffs
                        ON announcements.stf_id = staffs.stf_id WHERE course_id = :course_id");
        $announces->execute($_GET);

        foreach ($announces as $announce) { ?>
            <h3><i class="fas fa-bullhorn"></i><?php echo $announce['announcement'] ?></h3>
            <ul>  
                <p>By <a><?php echo $announce['name'] ?></a></p>
                <p>On <a><?php echo $announce['date'] ?></a></p>
            </ul>
        <hr>
    <?php } ?>
</div>

<?php
    require('common/footer.php');
?>
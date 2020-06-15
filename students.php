<?php
    session_start();
    if (!isset($_SESSION['stf']['stf_id'])){
        header('Location:index.php');
    }
    require('common/header.php');
?>	

<div id="fh5co-blog">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Students</h2>
					<p>Students You Are Inspiring</p>
				</div>
			</div>
			<div class="row row-padded-mb">
                <?php
                    $query = $data->prepare('SELECT DISTINCT(std.firstname),std.surname,std.email,std.profile_img,std.std_id FROM students std JOIN student_courses std_c
                                            ON std.std_id = std_c.std_id JOIN staff_courses stf_c
                                            ON stf_c.course_id = std_c.course_id
                                            WHERE stf_c.stf_id = :stf_id
                                            ORDER BY std.firstname');
                                            
                    $query->execute($_SESSION['stf']);

                    foreach ($query as $student) { ?>
                    <div class="col-md-4 animate-box">
                        <div class="fh5co-event">
                            <div class="date text-center"><span><img src="images/profiles/<?php echo $student['profile_img']?>" alt="Profile Photo"></span></div>
                            <h3><a href="profile.php?std_id=<?php echo $student['std_id']?>"><?php echo $student['firstname'].' '.$student['surname'];?></a></h3>
                            <p><a href="mailto:<?php echo $student['email'];?>"><?php echo $student['email'];?></a></p>
                        </div>
				    </div>
                <?php } ?>
			</div>
		</div>
	</div>

<?php
	require('common/footer.php');
?>	
<?php
	session_start();
	if(!isset($_SESSION['stf']) && !isset($_SESSION['std'])){
		header('Location:login');
	}
	require('common/header.php');
?>	

<div id="fh5co-course-categories">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2>Courses</h2>
					<p>The Courses You Are Associated With</p>
				</div>
			</div>
			<div class="row">
				<?php
					if(isset($_SESSION['stf'])){
						$query = $data->prepare('SELECT DISTINCT(c.title),c.* FROM courses c JOIN staff_courses stf_c
											ON c.course_id = stf_c.course_id
											WHERE stf_c.stf_id = :stf_id
											ORDER BY c.title');
						$query->execute($_SESSION['stf']);
					}

					if(isset($_SESSION['std'])){
						$query = $data->prepare('SELECT DISTINCT(c.title),c.* FROM courses c JOIN student_courses std_c
											ON c.course_id = std_c.course_id
											WHERE std_c.std_id = :std_id
											ORDER BY c.title');
						$query->execute($_SESSION['std']);
					}

					foreach ($query as $course) { ?>

					<div class="col-md-3 col-sm-6 text-center animate-box">
						<div class="services"><a href="course_details_content.php?course_id=<?php echo $course['course_id']?>">
							<span class="icon">
								<i class="icon-book2"></i>
							</span>
							<div class="desc">
								<h3><?php echo $course['title'] ?></h3>
							</div>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php
	require('common/footer.php'); 	
?>	
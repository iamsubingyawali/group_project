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
    $course = $query->fetch();
?>

<?php
	$query0 = $data->prepare('SELECT DISTINCT(std.firstname),std.surname,std.std_id,c.title,std.email FROM students std JOIN student_courses std_c
							ON std.std_id = std_c.std_id JOIN staff_courses stf_c
							ON stf_c.course_id = std_c.course_id JOIN courses c
							ON std_c.course_id = c.course_id
							WHERE c.course_id = '.$_GET['course_id'].'
							ORDER BY std.firstname');
							
	$query0->execute($_SESSION['stf']);


	$query1 = $data->prepare('SELECT file FROM uploads WHERE std_id = :std_id AND course_id = :course_id');
?>

<?php
	if(isset($_POST['done'])){
		$criteria = [
			'grade' => $_POST['grade'],
			'marks' => $_POST['marks'],
			'std_id' => $_POST['std_id'],
			'course_id' => $_GET['course_id']
		];

		$grading = $data->prepare("INSERT INTO grades(grade_id,grade,marks,date,std_id,course_id)
		VALUES('',:grade,:marks,DEFAULT,:std_id,:course_id)");
		$grading->execute($criteria);
	}
?>


<link rel="stylesheet" type="text/css" href="table/main.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Martel+Sans&display=swap" rel="stylesheet">

<?php if($staff){ ?>
	<div class="evaluate" id="evaluate-form">
		<form action="" method="POST">
			<input id="std_id" type="hidden" name="std_id">

			<label>Marks From Evaluation</label><br>
			<input type="number" placeholder="0" id="marks" name="marks" min="0" max="100" onkeyup = "return calculateGrade()"><br><br>

			<label>Grade</label><br>
			<input type="text" id="grade" name="grade"><br><br>

			<input type="submit" id="done_btn" name="done" value="Done"><br>
		</form>
	</div>

	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">S.N.</th>
								<th class="column2">Student ID</th>
								<th class="column3">Student Name</th>
								<th class="column4">Email Address</th>
								<th class="column5">Submitted Files</th>
								<th class="column6">Current Grade</th> 
								<th class="column7"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$counter = 1; 
							foreach ($query0 as $student ) {?>
								<tr>
									<td class="column1"><?php echo $counter?></td>
									<td class="column2"><?php echo $student['std_id']?></td>
									<td class="column3"><a href="profile.php?std_id=<?php echo $student['std_id'] ?>"><?php echo $student['firstname'].' '.$student['surname'] ?></a></td>
									<td class="column4"><a href="mailto:<?php echo $student['email'] ?>"><?php echo $student['email'] ?></a></td>
									<?php
										$upCriteria = [
											'std_id' => $student['std_id'],
											'course_id' => $_GET['course_id']
										];
										$query1->execute($upCriteria);
									?>
									<td class="column5">
										<?php
										if($query1->rowCount()>0){ 
											foreach ($query1 as $file) { ?>
												<li><a id="file" href="uploads/<?php echo $course['title'].'/'.$student['firstname'].' '.$student['surname'].'/'.$file['file'] ?>"><?php echo $file['file'] ?></a></li>
											<?php } 
										} 
										else
											echo '-';
										?>
									</td>
									<td class="column6">
										<?php 
										$grade = $data->prepare('SELECT * FROM grades WHERE std_id = :std_id AND course_id = :course_id ORDER BY date DESC');
										$grade->execute($upCriteria);
										if($grade->rowCount()>0){
											$grade = $grade->fetch();
											echo $grade['marks'].' / '.$grade['grade'];
										}
										else echo '-'?>
									</td>
									<td>
										<a id="evaluate" href="javascript:void(0)" onclick="return showEvaluation(<?php echo $student['std_id'] ?>)">Evaluate</a>
									</td>
								</tr>
									
							<?php
								$counter=$counter+1;
							} ?>	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<?php
	require('common/footer.php');
?>
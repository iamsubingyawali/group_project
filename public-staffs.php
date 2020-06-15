<?php
    require('common/header.php');
?>	

<div id="fh5co-blog">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Staffs</h2>
					<p>Staffs Asociated With This Organization</p>
				</div>
			</div>
			<div class="row row-padded-mb">
                <?php
                    $query = $data->prepare('SELECT DISTINCT(firstname),surname,email,profile_img FROM staffs');
                                            
                    $query->execute();

                    foreach ($query as $staff) { ?>
                    <div class="col-md-4 animate-box">
                        <div class="fh5co-event">
                            <div class="date text-center"><span><img src="images/profiles/<?php echo $staff['profile_img']?>" alt="Profile Photo"></span></div>
                            <h3>
                                <a href="resume/<?php
                                    $fileHtml = 'resume/'.strtolower($staff['firstname'].'_'.$staff['surname'].'.html');
                                    $filePhp = 'resume/'.strtolower($staff['firstname'].'_'.$staff['surname'].'.php');
                                    if(is_file($fileHtml)){
                                        echo strtolower($staff['firstname'].'_'.$staff['surname'].'.html');
                                    }
                                    else if(is_file($filePhp)){
                                        echo strtolower($staff['firstname'].'_'.$staff['surname'].'.php');
                                    }
                                    else echo 'error.php';
                                ?>">
                                <?php echo $staff['firstname'].' '.$staff['surname'];?></a>
                            </h3>
                            <p><a href="mailto:<?php echo $staff['email'];?>"><?php echo $staff['email'];?></a></p>
                        </div>
				    </div>
                <?php } ?>
			</div>
		</div>
	</div>

<?php
	require('common/footer.php');
?>	
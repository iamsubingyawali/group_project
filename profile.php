<?php
    session_start();
    if(!isset($_SESSION['std']) && !isset($_SESSION['stf'])){
        header('Location:index.php');
    }
    require('common/header.php');
?>

<?php
    $role = "";
    $sessionId = "";

    if(isset($_GET['std_id'])){
        $query = $data->prepare('SELECT * FROM students WHERE std_id = :std_id');
        $query->execute($_GET);
        if($query->rowCount()<1){echo "<script> location.href='index.php'; </script>";exit;}
        $user = $query->fetch();
        $role = 'Student';
        $userId = $user['std_id'];
    }

    if(isset($_GET['stf_id'])){
        $query = $data->prepare('SELECT * FROM staffs WHERE stf_id = :stf_id');
        $query->execute($_GET);
        $user = $query->fetch();
        $role = "Teacher";
        $userId = $user['stf_id'];
    }

    if(!isset($_GET['std_id']) && !isset($_GET['stf_id'])){
        if(isset($_SESSION['std'])){
            $query = $data->prepare('SELECT * FROM students WHERE std_id = :std_id');
            $query->execute($_SESSION['std']);
            $user = $query->fetch();
            $role = 'Student';
            $userId = $user['std_id'];
            $sessionId = $_SESSION['std']['std_id'];

            if(isset($_POST['change'])){
                $query1 = $data->prepare('SELECT password FROM students WHERE std_id = :std_id');
                $query1->execute($_SESSION['std']);
                $pass = $query1->fetchColumn();
            }
        }

        if(isset($_SESSION['stf'])){
            $query = $data->prepare('SELECT * FROM staffs WHERE stf_id = :stf_id');
            $query->execute($_SESSION['stf']);
            $user = $query->fetch();
            $role = "Teacher";
            $userId = $user['stf_id'];
            $sessionId = $_SESSION['stf']['stf_id'];

            if(isset($_POST['change'])){
                $query1 = $data->prepare('SELECT password FROM staffs WHERE stf_id = :stf_id');
                $query1->execute($_SESSION['stf']);
                $pass = $query1->fetchColumn();
            }
        }
    }
?>


<?php
    $error = "";
    if(isset($_POST['change'])){
        unset($_POST['change']);

        if (password_verify($_POST['old'],$pass)){
            if($_POST['password'] == $_POST['confirm']){
                $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
                unset($_POST['old']);
                unset($_POST['confirm']);

                if(isset($_SESSION['stf'])){
                    $update = $data->prepare('UPDATE staffs SET password = :password WHERE stf_id = :id');
                }

                if(isset($_SESSION['std'])){
                    $update = $data->prepare('UPDATE students SET password = :password WHERE std_id = :id');
                }

                if($update->execute($_POST)){
                    header('Location:login');
                }
            }
            else $error = "Passwords didn't Match !";
        }
        else $error = "Old Password Incorrect !";
        echo $error;
    }
?>

<?php

    if(isset($_FILES['profile_img'])){
        $profile_img = $_FILES['profile_img']['name'];
        $tempDest = $_FILES['profile_img']['tmp_name'];
        $imgExt = explode('.',$profile_img);
        $imageExtension = strtolower(end($imgExt));
        $newImageName = uniqid('',true).".".$imageExtension;
        $permDest= 'images/profiles/' . $newImageName;
        copy($tempDest, $permDest);

        $criteria = [
            'user_id' => $sessionId,
            'profile_img' => $newImageName
        ];
        
        if(isset($_SESSION['stf'])){
            $query2 = $data->prepare('UPDATE staffs SET profile_img = :profile_img WHERE stf_id = :user_id');
        }

        if(isset($_SESSION['std'])){
            $query2 = $data->prepare('UPDATE students SET profile_img = :profile_img WHERE std_id = :user_id');
        }

        $old_file = $user['profile_img'];
        $old_file_path = 'images/profiles/'.$old_file;

        if($old_file != 'default.png'){
            unlink($old_file_path);
        }
        
        if($query2->execute($criteria)){
            echo "<script> location.href='profile.php'; </script>";
            exit;
        }
    }
?>


<?php
    if(isset($_POST['user_id'])){

        if(isset($_SESSION['stf'])){
            $query3 = $data->prepare('UPDATE staffs SET profile_img = DEFAULT WHERE stf_id = :user_id');
        }

        if(isset($_SESSION['std'])){
            $query3 = $data->prepare('UPDATE students SET profile_img = DEFAULT WHERE std_id = :user_id');
        }

        $old_file = $user['profile_img'];
        $old_file_path = 'images/profiles/'.$old_file;

        if($old_file != 'default.png'){
            unlink($old_file_path);
        }
        
        if($query3->execute($_POST)){
            echo "<script> location.href='profile.php'; </script>";
            exit;
        }
    }
?>

<?php
    if(isset($_FILES['cv'])){
        $cv_name = $_FILES['cv']['name'];
        $tempDest = $_FILES['cv']['tmp_name'];
        $fileExt = explode('.',$cv_name);
        $fileExtension = strtolower(end($fileExt));
        $newFileName = $user['firstname'].'_'.$user['surname'].'.'.$fileExtension;

        $old_file = $newFileName;
        $old_file_path = strtolower('resume/'.$old_file);
        if(is_file($old_file_path)){
            unlink($old_file_path);
        }

        $permDest= strtolower('resume/' . $newFileName);
        copy($tempDest, $permDest);
    }
?>

<style>
    .image-details img{box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
    margin:20px 0 20px 0;min-width:200px;min-height:200px;max-width:200px;max-height:200px;border-radius:50%;}
    .image-details{text-align:center;position:relative;}
    .image-details label{position:absolute;color:#BD2125;cursor:pointer;margin:10px 0 0 50px;}
    .image-details h4{margin:0;padding:0;}
    .image-details h5{padding:10px 0;color:#BD2125;}
    .user-details,form[name="delete_image"]{display:flex;justify-content:center;}
    .user-details ul{margin:0 0 10px 0;padding:0;display:flex;flex-direction:column;}
    .user-details li{list-style:none;color:gray;font-size:20px;}
    .user-details i{margin-right:20px;color:#BD2125;}
    .user-details button, .user-details input,.user-details a{margin:5px;0;background-color:#BD2125;transition:0.4s;
    border:none;border-radius:10px;color:white;padding:5px;outline:none;font-weight:600;}
    form[name="delete_image"] #delete-btn{padding:5px 80px;}
    form[name="upload_cv"]{margin-top:15px;}
    form[name="upload_cv"] #upload-cv{padding:8px 78px;cursor:pointer;}
    #upload-cv:hover{opacity:0.7;}
    .user-details button:hover{opacity:0.7;transition:0.4s;}
    .change-password input{margin:8px;padding:5px 8px;border-radius:5px;background-color:black;}
    .change-password{width:fit-content;padding:50px;border-radius:8px;
    box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);background-color:#BD2125;
    position:absolute;top:30%;left:50%;transform:translate(-50%,-30%);display:none;}
    input[type="file"]{display:none;}
</style>

    <div class="profile-tab">
        <div class="user">
            <div class="image-details">
            <?php if($sessionId == $userId){ ?>
                <form action="" method="POST" name="upload_image" enctype="multipart/form-data">
                    <label>
                        <input type="file" name="profile_img" accept="image/*" onchange="this.form.submit();">
                        <i class="fas fa-edit"></i>
                    </label>
                </form>
            <?php } ?>
                <img src="images/profiles/<?php echo $user['profile_img'] ?>" alt="Profile Image">
                <h4><?php echo $user['firstname'].' '.$user['surname']?></h4>
                <h5><?php echo $role ?></h5>
            </div>

            <div class="user-details">
                <ul>
                    <li><i class="fas fa-id-card"></i><?php echo $userId ?></li>
                    <li><i class="fas fa-venus-mars"></i><?php echo $user['gender'] ?></li>
                    <li><i class="fas fa-envelope"></i><?php echo $user['email'] ?></li>
                    <li><i class="fas fa-phone"></i><?php echo $user['phone'] ?></li>
                    <li><i class="fas fa-birthday-cake"></i><?php echo $user['birthdate'] ?></li>
                    <li><i class="fas fa-map-marked-alt"></i><?php echo $user['address'] ?></li>
                    <?php if($sessionId == $userId){ ?>

                        <form action="" method="POST" name="delete_image">
                            <label>
                                <input type="hidden" name="user_id" value="<?php echo $userId ?>">
                                <button id="delete-btn" onchange="this.form.submit();">Delete Profile Image</button>
                            </label>
                        </form>

                        <button id="change-btn" onclick="return change()">Change Password</button>
                        <?php if(isset($_SESSION['stf'])) {?>
                            <form action="" method="POST" name="upload_cv" enctype="multipart/form-data">
                                <label>
                                    <input type="file" name="cv" accept=".html,.php" onchange="this.form.submit();">
                                    <a id="upload-cv">Upload Your Resume</a>
                                </label>
                            </form>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="change-password" id = "change-pass">
        <form id = "change-pass" action="" method="POST">
            <input id = "change-pass" type="hidden" name="id" value="<?php echo $sessionId ?>">
            <input id = "change-pass" type="password" name="old" placeholder="Enter Your Old Password"><br>
            <input id = "change-pass" type="password" name="password" placeholder="Enter New Password"><br>
            <input id = "change-pass" type="password" name="confirm" placeholder="Confirm Password"><br>
            <input id = "change-pass" type="submit" value="Change" name="change">
        </form>
    </div>
<?php
    require('common/footer.php');
?>
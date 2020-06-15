<?php
    require('common/header.php');  
    if(!isset($_SESSION['admin'])){
        echo "<script> location.href='login'; </script>";
        exit;
    }

    $students = $staffs = $admins = false;
    if(isset($_GET['action'])){
        $a = $_GET['action'];

        if($a =='students')$students = true;
        else if ($a == 'staffs')$staffs = true;
        else if ($a == 'admins')$admins = true;

    }
?>

<?php
    if(isset($_POST['addStudent'])){
        unset($_POST['addStudent']);
        $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $_POST['firstname'] = htmlspecialchars($_POST['firstname']);
        $_POST['surname'] = htmlspecialchars($_POST['surname']);
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['phone'] = htmlspecialchars($_POST['phone']);
        $_POST['address'] = htmlspecialchars($_POST['address']);

        $add = $data->prepare("INSERT INTO students(std_id,firstname,surname,email,phone,birthdate,gender,address,password,profile_img)
        VALUES('',:firstname,:surname,:email,:phone,:birthdate,:gender,:address,:password,DEFAULT)");
        $add->execute($_POST);
    }

    if(isset($_POST['addStaff'])){
        unset($_POST['addStaff']);
        $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $_POST['firstname'] = htmlspecialchars($_POST['firstname']);
        $_POST['surname'] = htmlspecialchars($_POST['surname']);
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['phone'] = htmlspecialchars($_POST['phone']);
        $_POST['address'] = htmlspecialchars($_POST['address']);

        $add = $data->prepare("INSERT INTO staffs(stf_id,firstname,surname,email,phone,birthdate,gender,address,password,profile_img)
        VALUES('',:firstname,:surname,:email,:phone,:birthdate,:gender,:address,:password,DEFAULT)");
        $add->execute($_POST);
    }

    if(isset($_POST['addAdmin'])){
      unset($_POST['addAdmin']);
      $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $_POST['firstname'] = htmlspecialchars($_POST['firstname']);
        $_POST['surname'] = htmlspecialchars($_POST['surname']);
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['username'] = htmlspecialchars($_POST['username']);

      $add = $data->prepare("INSERT INTO admins(admin_id,firstname,surname,username,email,password)
      VALUES('',:firstname,:surname,:username,:email,:password)");
      $add->execute($_POST);
  }
?>

<style>
    .row input,select{border-radius:5px;border:none;padding:10px;outline:none;width:300px;}
    .chart-area{text-align:center;}
    .row input[type="submit"]{background-color:#BD2125;width:200px;color:white;font-size:17px;}
    .row input[type="submit"]:hover{opacity:0.7;}
    .card-header h5{font-size:20px;}
</style>

<?php if($students) {?>
<div class="content">
  <div class="row">
  <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5>Add Student</h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <form action="" method="POST">
                <input type="text" name="firstname" placeholder="Firstname"><br><br>
                <input type="text" name="surname" placeholder="Surname"><br><br>
                <input type="email" name="email" placeholder="Email"><br><br>
                <input type="number" name="phone" placeholder="Phone"><br><br>
                <input type="date" name="birthdate" placeholder="Birthdate"><br><br>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select><br><br>
                <input type="text" name="address" placeholder="Address"><br><br>
                <input type="text" name="password" placeholder="Password"><br><br>
                <input type="submit" value="Add" name="addStudent">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>


<?php if($staffs) {?>
    <div class="content">
    <div class="row">
    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5>Add Staff</h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <form action="" method="POST">
                <input type="text" name="firstname" placeholder="Firstname"><br><br>
                <input type="text" name="surname" placeholder="Surname"><br><br>
                <input type="email" name="email" placeholder="Email"><br><br>
                <input type="number" name="phone" placeholder="Phone"><br><br>
                <input type="date" name="birthdate" placeholder="Birthdate"><br><br>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select><br><br>
                <input type="text" name="address" placeholder="Address"><br><br>
                <input type="text" name="password" placeholder="Password"><br><br>
                <input type="submit" value="Add" name="addStaff">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php if($admins) {?>
<div class="content">
  <div class="row">
  <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5>Add Admin</h5>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <form action="" method="POST">
                <input type="text" name="firstname" placeholder="Firstname"><br><br>
                <input type="text" name="surname" placeholder="Surname"><br><br>
                <input type="text" name="username" placeholder="username"><br><br>
                <input type="text" name="email" placeholder="Email"><br><br>
                <input type="text" name="password" placeholder="Password"><br><br>
                <input type="submit" value="Add" name="addAdmin">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>


<?php
  require('common/footer.php');
?>
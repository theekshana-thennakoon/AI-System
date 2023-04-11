<?php
session_start();
?>
<?php
include('database.php');
?>
<script src="sweetalert.min.js"></script>
<?php
//User Login
if(isset($_POST['loginAdmin'])){
    $username = $_POST['usernameAdmin'];
    $pwd = $_POST['pwd'];
    $sql = "SELECT * FROM adminlogin where email = '{$username}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $pasword = $row['pwd'];
            $id = $row['id'];
        }
        $verifypwd = password_verify($pwd, $pasword);
		if($verifypwd){
            $_SESSION['remlogin'] = $id;
            header("Location:main");
        }
        else{
            $_SESSION['wrongpwd'] = 100;
			echo "<script>window.history.back()</script>";
        }
    }
    else{
        $_SESSION['wrongemail'] = 100;
		echo "<script>window.history.back()</script>";
    }
    
}

//Create User Account
if(isset($_POST['createAccount'])){
    $username = $_POST['usernameAdmin'];
    $sql = "SELECT * FROM adminlogin where email = '{$username}' and pwd = ''";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
        }
        $password = $_POST['pwd'];
        $repassword = $_POST['repwd'];
        if($password ==  $repassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sqli = "UPDATE adminlogin set pwd = '{$hash}' where id = {$id}";
            if($conn->query($sqli) === TRUE){
                $_SESSION['remlogin'] = $id;
                header("Location:main");
            }
        }
        else{
            $_SESSION['wrongpwd'] = 100;
			echo "<script>window.history.back()</script>";
        }
    }
    else{
        $_SESSION['wrongemail'] = 100;
		echo "<script>window.history.back()</script>";
    }
    
}

//Add Reminder
if(isset($_POST['addrem'])){
	$title = $_POST['title'];
    $type = $_POST['type'];
    $discription = $_POST['discription'];
    $uid = $_SESSION['remlogin'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
	$sqli = "INSERT INTO `register`(userid, title, description,category, sdate, edate) VALUES ($uid,'$title','$discription','$type','$sdate','$edate')";
	if($conn->query($sqli) === TRUE){
		$_SESSION['sussessReg'] = 0;
		echo "<script>window.history.back()</script>";
	}
}

//Set the Reminder is Correct
if(isset($_GET['correctionId'])){
	
    $correctionId = $_GET['correctionId'];
	$sqli = "UPDATE register set status = 'Corrected' where id = {$correctionId}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}

//Reset Correction
if(isset($_GET['recorrectionId'])){
	
    $correctionId = $_GET['recorrectionId'];
	$sqli = "UPDATE register set status = null where id = {$correctionId}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}

//User Logout
if(isset($_GET['logoutId'])){
    session_destroy();
	echo "<script>window.history.back()</script>";
}

//Delete the Reminder
if(isset($_GET['delId'])){
	
    $delId = $_GET['delId'];
	$sqli = "DELETE from register where id = {$delId}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}

//Admin Login
if(isset($_POST['loginAdminpanel'])){
    $username = $_POST['usernameAdmin'];
    $pwd = $_POST['pwd'];
    $sql = "SELECT * FROM adminlist where email = '{$username}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $pasword = $row['pwd'];
            $id = $row['id'];
        }
        $verifypwd = password_verify($pwd, $pasword);
		if($verifypwd){
            $_SESSION['remadminlogin'] = $id;
            header("Location:admin");
        }
        else{
            $_SESSION['wrongpwd'] = 100;
			echo "<script>window.history.back()</script>";
        }
    }
    else{
        $_SESSION['wrongemail'] = 100;
		echo "<script>window.history.back()</script>";
    }
    
}


//Create Admin Account
if(isset($_POST['createadminAccount'])){
    $username = $_POST['usernameAdmin'];
    $sql = "SELECT * FROM adminlist where email = '{$username}' and pwd = ''";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
        }
        $password = $_POST['pwd'];
        $repassword = $_POST['repwd'];
        if($password ==  $repassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sqli = "UPDATE adminlist set pwd = '{$hash}' where id = {$id}";
            if($conn->query($sqli) === TRUE){
                $_SESSION['remadminlogin'] = $id;
                header("Location:admin");
            }
        }
        else{
            $_SESSION['wrongpwd'] = 100;
			echo "<script>window.history.back()</script>";
        }
    }
    else{
        $_SESSION['wrongemail'] = 100;
		echo "<script>window.history.back()</script>";
    }
    
}

//Add New User
if(isset($_POST['addnewuser'])){
	$name = $_POST['name'];
    $epf = $_POST['epf'];
    $email = $_POST['email'];
    $jobstatus = $_POST['jobstatus'];
	$sqli = "INSERT INTO `adminlogin`(name, epf, jobstatus,email) VALUES ('$name','$epf','$jobstatus','$email')";
	if($conn->query($sqli) === TRUE){
		$_SESSION['sussessReg'] = 0;
		echo "<script>window.history.back()</script>";
	}
}
//Add New Admin
if(isset($_POST['addnewadmin'])){
	$name = $_POST['name'];
    $epf = $_POST['epf'];
    $email = $_POST['email'];
    $jobstatus = $_POST['jobstatus'];
	$sqli = "INSERT INTO `adminlist`(name, epf, jobstatus,email) VALUES ('$name','$epf','$jobstatus','$email')";
	if($conn->query($sqli) === TRUE){
		$_SESSION['sussessReg'] = 0;
		echo "<script>window.history.back()</script>";
	}
}

//Add New License
if(isset($_POST['addnewlicanse'])){
	$name = $_POST['name'];

    $img = $_FILES['img'];
	    	
    $image = $_FILES['img']['name'];
    $filetmpname = $_FILES['img']['tmp_name'];
    $filesize = $_FILES['img']['size'];
    $folder = 'images/';
	$sqli = "INSERT INTO `licenselist`(name, attachment) VALUES ('$name','$image')";
	if($conn->query($sqli) === TRUE){
        move_uploaded_file($filetmpname,$folder.$image);
		$_SESSION['sussessReg'] = 0;
		echo "<script>window.history.back()</script>";
	}
}
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
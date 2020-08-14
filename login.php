<?php 
    if(!isset($_SESSION)) { 
        session_start(); 
    } 

    require('includes/config.php');
    
    if (! empty($_POST["login-user"])) {
    
		$username = filter_var($_POST["l_unm"], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST["l_pwd"], FILTER_SANITIZE_STRING);

		$errormsg = "";
		$_SESSION=array();

		if(empty($username)) { $errormsg.= "Username is required<br>";}
		if(empty($password)) { $errormsg.= "Password is required<br>";}
	
		$checkusn = "SELECT * FROM user WHERE u_unm='$username' AND u_pwd='$password'";
		$result = mysqli_query($conn,$checkusn) or die("Can't Execute Query...");
		$data = mysqli_fetch_assoc($result);

		if (!empty($data)) { 
			$_SESSION['logged'] = true;
			$_SESSION['unm'] = $username;
            header('location: index.php');
		}
		else {
            $errormsg .= "The username or password is incorrect<br>";
			$_SESSION['login_error_msg'] = $errormsg;
			header('location: access.php');
		}
	}		
?>
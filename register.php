<?php 
	if(!isset($_SESSION)) { 
        session_start(); 
    } 
	require('includes/config.php');

	if (! empty($_POST["register-user"])) {
    
		$fullname = filter_var($_POST["fnm"], FILTER_SANITIZE_STRING);
		$username = filter_var($_POST["unm"], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST["mail"], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST["pwd"], FILTER_SANITIZE_STRING);
		$confirmpassword = filter_var($_POST["cpwd"], FILTER_SANITIZE_STRING);

		$errormsg = "";
		$_SESSION=array();

		if(empty($fullname)) { $errormsg.= "Fullname is required<br>";}
		if(empty($username)) { $errormsg.= "Username is required<br>";}
		if(empty($email)) { $errormsg.= "Email is required<br>";}
		if(empty($password)) { $errormsg.= "Password is required<br>";}
		if($password != $confirmpassword) { $errormsg.= "Password doesn't match<br>";}
	
		$checkusn = "SELECT * FROM user WHERE u_unm='$username' OR u_email='$email' LIMIT 1";
		$result = mysqli_query($conn,$checkusn) or die("Can't Execute Query...");
		$data = mysqli_fetch_assoc($result);

		if ($data) { 
			if ($data['u_unm'] === $username) {
				$errormsg.= "Username already exists<br>";
			}
		
			if ($data['u_email'] === $email) {
				$errormsg.= "Email already used<br>";
			}
		}

		if ($errormsg == "") {
			$query="insert into user(u_fnm,u_unm,u_pwd,u_email)
			values('$fullname','$username','$password','$email')";
			mysqli_query($conn,$query) or die("Can't Execute Query...");
			$_SESSION['logged'] = true;
			$_SESSION["unm"] = $username;
			$_SESSION['signup_error_ok'] = true;
			header('location: index.php');
		}
		else {
			$_SESSION['signup_error_msg'] = $errormsg;
			header('location: access.php');
		}
	}
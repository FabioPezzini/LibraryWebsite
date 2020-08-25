<?php 
    if(!isset($_SESSION)) { 
        session_start(); 
    } ?>
<!DOCTYPE html>
<html>
<head>
    <?php
		include("includes/head.php");
	?>
</head>

<body>
   <!-- Header Begin -->
    <?php
		include("includes/header.inc.php");
	?>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin --> 
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb_text">
                        <h2>Login / Registration</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <!-- Breadcrumb Section End -->
    
    <!-- Login e Registration Form Begin -->
    <?php 
        require("register.php");
		if(!(isset($_SESSION['logged']))) {	
			echo '<div class="login-box">
                    <div class="lb-header">
                        <a href="#" class="active" id="signup-box-link">Sign Up</a>
                        <a href="#" id="login-box-link">Login</a>
                    </div>   
                    <form class="email-signup" name="email-signup" action="register.php" method="POST">';
                    if (isset($_SESSION['signup_error_msg'])) {	
                        echo '<div class="error-message">'; 
                        echo $_SESSION['signup_error_msg'];   
                        echo '</div>';
                        unset($_SESSION['signup_error_msg']);
                    }
                    elseif(isset($_SESSION['signup_ok'])){	
                        echo '<div class="success-message">'; 
                        echo 'Succesfully registered!';   
                        echo '</div>';
                    }
            echo        '<div class="u-form-group">
                            <input type="text" placeholder="FullName" name="fnm"/>
                        </div>
                        <div class="u-form-group">
                            <input type="text" placeholder="Username" name="unm"/>
                        </div>                   
                        <div class="u-form-group">
                            <input type="text" placeholder="Email" name="mail"/>
                        </div>
                        <div class="u-form-group">
                            <input type="password" placeholder="Password" name="pwd"/>
                        </div>
                        <div class="u-form-group">
                            <input type="password" placeholder="Confirm Password" name="cpwd"/>
                        </div>
                        <div class="u-form-group">
                            <input name="register-user" type="submit" value="Sign Up">
                        </div>
                    </form>';
            echo    '<form class="email-login" name="email-login" action="login.php" method="POST">';
                    if (isset($_SESSION['login_error_msg'])) {	
                        echo '<div class="error-message">'; 
                        echo $_SESSION['login_error_msg'];   
                        echo '</div>';
                        unset($_SESSION['login_error_msg']);
                    }
            echo       '<div class="u-form-group">
                            <input type="text" placeholder="Username" name="l_unm"/>
                        </div>
                        <div class="u-form-group">
                            <input type="password" placeholder="Password" name="l_pwd"/>
                        </div>
                        <div class="u-form-group">
                            <input type="submit" name="login-user" value="Log In">
                        </div>
                        <div class="u-form-group">
                            <a href="#" class="forgot-password">Forgot password?</a>
                        </div>
                    </form>';
        echo    '</div>';
		}
		else {
			// message if the user is already online
		}
	    ?>	
    <!-- Login e Registration Form End -->                          
    
    <br>
    <br>
    <!-- Footer Section Begin -->
    <?php
		include("includes/footer.inc.php");
	?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php
		include("includes/js_plugin.inc.php");
	?>

</body>

</html>
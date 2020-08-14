<!DOCTYPE html>
<html lang="zxx">

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
                        <h2>Contact Us</h2>
                        <div class="breadcrumb_option">
                            <a href="./index.php">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact_form_title">
                        <h2>Leave Message</h2>
                    </div>
                    <p>If you need some help OR you simply want to give us some advice on how to
                    improve the website OR you want to collaborate with us, write a message in the form below!</p>
                </div>
            </div>
            <form action="submit_contact.php" method="POST">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" id="name" name="name" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" id="mail" name="mail" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea id="message" name="message" placeholder="Your message"></textarea>
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

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
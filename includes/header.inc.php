<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- humburger Begin -->
    <div class="humburger_menu_overlay"></div>
    <div class="humburger_menu_wrapper">
        <div class="humburger_menu_logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humburger_menu_widget">
            <div class="header_top_right_auth">
                <?php 
		            if(isset($_SESSION['logged'])) {	
			            echo '<li><a href="logout.php" ><i class="fa fa-user"></i>Logout</a></li>';
		            }
		            else {
			            echo '<li><a href="access.php" ><i class="fa fa-user"></i>Sign Up / Login</a></li>';
		            }
	            ?>
            </div>
        </div>
        <nav class="humburger_menu_nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./search.php">Advanced Search</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <?php
                    if(isset($_SESSION['logged'])) {	
			            echo '<li><a href="#"><i class="fa fa-heart"></i>MyComics</a></li>';
		            }
                ?>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humburger_menu_contact"></div>
    </div>
    <!-- humburger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header_logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header_menu">
                        <ul>
                            <li id="index_page"><a href="./index.php">Home</a></li>
                            <li id="search_page"><a href="./search.php">Advanced Search</a></li>
                            <li id="contact_page"><a href="./contact.php">Contact</a></li>
                            <?php 
		                        if(isset($_SESSION['logged'])) {	
			                        echo '<li><a href="logout.php" ><i class="fa fa-user"></i>Logout</a></li>';
		                        }
		                        else {
			                        echo '<li><a href="access.php" ><i class="fa fa-user"></i>Sign Up / Login</a></li>';
		                        }
	                        ?>	
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header_menu">
                        <ul>
                            <li></li>
                            <?php
                            if(isset($_SESSION['logged'])) {	
			                        echo '<li id="mycomics_page"><a href="mycomics.php"><i class="fa fa-heart"></i>MyComics</a></li>';
		                        }
                            ?>
                        </ul> 
                    </div>
                </div>
            </div>
            <div class="humburger_open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Searchbar Section Begin -->
    <section class="searchbar searchbar-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="searchbar_categories">
                        <div class="searchbar_categories_all">
                            <i class="fa fa-bars"></i>
                            <span>Latest Series</span>
                        </div>
                        <ul>
                        <?php
                            require('includes/config.php');
				            $query="SELECT * FROM italiancomics group by serie_title ORDER BY issue_date DESC LIMIT 10";
				            $res=mysqli_query($conn,$query);					
				            while($row=mysqli_fetch_assoc($res)) {	
					            $valueformatted = str_replace("_"," ",$row["serie_title"]);
					            $valueformatted = str_replace("&","&amp", $valueformatted);
					        echo '<li><a href="search.php?by=serie_title&q='.$row['serie_title'].'">'.$valueformatted.'</a></li>';			
				            }			
				            mysqli_close($conn);
			            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="searchbar_search">
                        <div class="searchbar_search_form">
                            <form>
                                <input type="text" id="q" placeholder="What comic are you searching?">
                                <button type="button" class="site-btn">SEARCH</button>
                            </form>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Searchbar Section End -->
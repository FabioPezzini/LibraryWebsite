<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
    require('includes/config.php');
?>
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
    <?php
        echo '<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb_text">
                        <h2> Welcome ' . $_SESSION["unm"] . '</h2>         
                    </div>
                </div>
            </div>
        </div>
    </section>'
    ?>
    <!-- Breadcrumb Section End -->

    <!-- Comic Section Begin -->
    <section class="comic spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-9">
                    <div class="mycomics">
                        <div class="section-title mycomics_title">
                            <h2>Favorite Comics</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-5"></div>
                            <div class="col-lg-4 col-md-4">
                                <?php
                                    require('includes/config.php');
                                    $totalq="SELECT count(*) \"total\" FROM italiancomics INNER JOIN user_fav_comics ON italiancomics.link_albo=user_fav_comics.comic";
                                    $totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
                                    $totalrow=mysqli_fetch_assoc($totalres);
                                    echo '<div class="filter_found">
                                            <h6><span>' . $totalrow['total'] . '</span> comics found</h6>
                                          </div>';
                                ?>            
                            </div>
                            <br><br><br>
                            <div class="mycomics_slider owl-carousel">
                                <?php
                                    require('includes/config.php');
				                    $query="SELECT * FROM italiancomics INNER JOIN user_fav_comics ON italiancomics.link_albo=user_fav_comics.comic ORDER BY issue_date DESC";
                                    $res=mysqli_query($conn,$query);				
				                    while($row=mysqli_fetch_assoc($res)) {	
					                    $valueformatted = str_replace("_"," ",$row["serie_title"]);
					                    $valueformatted = str_replace("&","&amp", $valueformatted);
                                        echo '<div class="col-lg-4">
                                                <div class="mycomics_item">
                                                    <div class="mycomics_item_pic" >
                                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                                            <img src="'.$row['issue_link_image']. '" width="200" height="270" class="mycomics_center">
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="mycomics_item_text">
                                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                                        <h5>'.$row['issue_title']. '</h5>   
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                    
                                    $num = mysqli_num_rows($res);
                                    
                                    while ($num < 5) {
                                        echo '<div class="col-lg-4">
                                                <div class="mycomics_item">
                                                    <div class="mycomics_item_pic" >
                                                        <div class="mycomics_item_text">
                                                        </div>
                                                    </div>
                                                </div>
                                               </div>';
                                        $num += 1;    
                                    }			
				                    mysqli_close($conn);
			                    ?>
                            </div>
                        </div>
                    </div>
                    <div class="mycomics">
                        <div class="section-title mycomics_title">
                            <h2>Read Comics</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-5"></div>
                            <div class="col-lg-4 col-md-4">
                                <?php
                                    require('includes/config.php');
                                    $totalq="SELECT count(*) \"total\" FROM italiancomics INNER JOIN user_read_comics ON italiancomics.link_albo=user_read_comics.comic";
                                    $totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
                                    $totalrow=mysqli_fetch_assoc($totalres);
                                    echo '<div class="filter_found">
                                            <h6><span>' . $totalrow['total'] . '</span> comics found</h6>
                                          </div>';
                                ?>
                            </div>
                            <br><br><br>
                            <div class="mycomics_slider owl-carousel">
                                <?php
                                    require('includes/config.php');
				                    $query="SELECT * FROM italiancomics INNER JOIN user_read_comics ON italiancomics.link_albo=user_read_comics.comic ORDER BY issue_date DESC";
                                    $res=mysqli_query($conn,$query);				
				                    while($row=mysqli_fetch_assoc($res)) {	
					                    $valueformatted = str_replace("_"," ",$row["serie_title"]);
					                    $valueformatted = str_replace("&","&amp", $valueformatted);
                                        echo '<div class="col-lg-4">
                                                <div class="mycomics_item">
                                                    <div class="mycomics_item_pic" >
                                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                                            <img src="'.$row['issue_link_image']. '" width="200" height="270" class="mycomics_center">
                                                        </a>
                                                    </div>
                                                    <div class="mycomics_item_text">
                                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                                        <h5>'.$row['issue_title']. '</h5>   
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>';
                                    }			
                                    
                                    $num = mysqli_num_rows($res);
                                    while ($num < 5) {
                                        echo '<div class="col-lg-4">
                                                <div class="mycomics_item">
                                                    <div class="mycomics_item_pic" >
                                                        <div class="mycomics_item_text">
                                                        </div>
                                                    </div>
                                                </div>
                                               </div>';
                                        $num += 1;    
                                    }			
				                    mysqli_close($conn);
			                    ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="mycomics">
                        <div class="section-title mycomics_title">
                            <h2>Bought Comics</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <?php
                                    require('includes/config.php');
                                    $totalq="SELECT count(*) \"total\" FROM italiancomics INNER JOIN user_bought_comics ON italiancomics.link_albo=user_bought_comics.comic";
                                    $totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
                                    $totalrow=mysqli_fetch_assoc($totalres);
                                    echo '<div class="filter_found">
                                            <h6><span>' . $totalrow['total'] . '</span> comics found</h6>
                                          </div>';
                                ?>
                            </div>
                            <br><br><br>
                            <div class="mycomics_slider owl-carousel">
                                <?php
                                    require('includes/config.php');
				                    $query="SELECT * FROM italiancomics INNER JOIN user_bought_comics ON italiancomics.link_albo=user_bought_comics.comic ORDER BY issue_date DESC";
                                    $res=mysqli_query($conn,$query);				
				                    while($row=mysqli_fetch_assoc($res)) {	
					                    $valueformatted = str_replace("_"," ",$row["serie_title"]);
					                    $valueformatted = str_replace("&","&amp", $valueformatted);
                                        echo '<div class="col-lg-4">
                                                <div class="mycomics_item">
                                                    <div class="mycomics_item_pic" >
                                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                                            <img src="'.$row['issue_link_image']. '" width="200" height="270" class="mycomics_center">
                                                        </a>
                                                    </div>
                                                    <div class="mycomics_item_text">
                                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                                        <h5>'.$row['issue_title']. '</h5>   
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>';
                                    }		
                                    $num = mysqli_num_rows($res);
                                    while ($num < 5) {
                                        echo '<div class="col-lg-4">
                                                <div class="mycomics_item">
                                                    <div class="mycomics_item_pic" >
                                                        <div class="mycomics_item_text">
                                                        </div>
                                                    </div>
                                                </div>
                                               </div>';
                                        $num += 1;    
                                    }			
				                    mysqli_close($conn);
			                    ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Comic Section End -->

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
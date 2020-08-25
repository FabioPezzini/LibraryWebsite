<?php session_start();?>
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
 
    <!-- Latest Comics Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Latest Comics Added:</h2>
                    </div>
                </div>
            </div>

            <div class="row">
            <?php
                    require('includes/config.php');
				    $query="SELECT * FROM italiancomics ORDER BY issue_date DESC LIMIT 40";
				    $res=mysqli_query($conn,$query);					
				    while($row=mysqli_fetch_assoc($res)) {	
					    echo '<div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="latest_item">
                                    <div class="latest_item_pic" >
                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                            <img src="'.$row['issue_link_image']. '" width="200" height="270" class="center">
                                        </a>
                                        <ul class="latest_item_pic_hover">';
                                            if(isset($_SESSION['logged'])) {
                                                $totalq="SELECT count(*) \"total\" FROM italiancomics INNER JOIN user_fav_comics ON italiancomics.link_albo=user_fav_comics.comic WHERE italiancomics.link_albo=\"" . $row['link_albo'] ."\" AND user_fav_comics.u_unm=\"" . $_SESSION['unm'] . "\" LIMIT 1";
                                                $totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
                                                $totalrow=mysqli_fetch_assoc($totalres);
                                                if($totalrow['total']==1){
                                                    echo '<li><a id="heart_index" style="color:#7fad39;"><i class="fa fa-heart"></i></a></li>';
                                                }
                                                else{
                                                    echo'<li><a id="heart_index"><i class="fa fa-heart"></i></a></li>';
                                                }
                                                $totalq="SELECT count(*) \"total\" FROM italiancomics INNER JOIN user_read_comics ON italiancomics.link_albo=user_read_comics.comic WHERE italiancomics.link_albo=\"" . $row['link_albo'] ."\" AND user_read_comics.u_unm=\"" . $_SESSION['unm'] . "\" LIMIT 1";
                                                $totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
                                                $totalrow=mysqli_fetch_assoc($totalres);
                                                if($totalrow['total']==1){
                                                    echo '<li><a style="color:#7fad39;"><i class="fa fa-book"></i></a></li>';
                                                }
                                                else{
                                                    echo'<li><a><i class="fa fa-book"></i></a></li>';
                                                }
                                                $totalq="SELECT count(*) \"total\" FROM italiancomics INNER JOIN user_bought_comics ON italiancomics.link_albo=user_bought_comics.comic WHERE italiancomics.link_albo=\"" . $row['link_albo'] ."\" AND user_bought_comics.u_unm=\"" . $_SESSION['unm'] . "\" LIMIT 1";
                                                $totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
                                                $totalrow=mysqli_fetch_assoc($totalres);
                                                if($totalrow['total']==1){
                                                    echo '<li><a style="color:#7fad39;"><i class="fa fa-archive"></i></a></li>';
                                                }
                                                else{
                                                    echo'<li><a><i class="fa fa-archive"></i></a></li>';
                                                }                                            
                                            }
                                            else {
                                                echo '<li><a><i class="fa fa-heart"></i></a></li>';
                                                echo '<li><a><i class="fa fa-book"></i></a></li>';
                                                echo '<li><a><i class="fa fa-archive"></i></a></li>';
                                            }
                        echo            '</ul>
                                    </div>
                                    <div class="latest_item_text">
                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                            <h5>'.$row['issue_title']. '</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>';
				    }			
				    mysqli_close($conn);
			    ?>
            </div>
        </div>
    </section>
    <!-- Latest Comics End -->

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
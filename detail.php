<?php
    session_start();
	require('includes/config.php');
	
	$id=$_GET['id'];
    $_SESSION['id'] = $id;
    
	$q='select * from italiancomics where link_albo=' . '"' . $id . '"';
	
	$res=mysqli_query($conn,$q) or die("Can't Execute Query..");
    $row=mysqli_fetch_assoc($res);
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
        require('includes/config.php');
        $q='select * from italiancomics where link_albo=' . '"' . $id . '"';
	
	    $res=mysqli_query($conn,$q) or die("Can't Execute Query..");
        $row=mysqli_fetch_assoc($res);
        $valueformatted = str_replace("_"," ",$row["serie_title"]);
        $valueformatted = str_replace("&","&amp", $valueformatted);
        echo '<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb_text">
                        <h2>' . $row["issue_title"] . '</h2>
                        <div class="breadcrumb_option">
                            <a href="./index.php">Home</a>
                            <a href="search.php?q=' . $row["serie_title"] . '&by=serie_title">' . $valueformatted . '</a>
                            <span>' . $row["issue_title"] . '</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>'
    ?>
    <!-- Breadcrumb Section End -->

    <!-- comic Details Section Begin -->
    <section class="comic-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="comic_details_pic">
                        <div class="comic_details_pic_item">
                            <?php
                                echo '<img class="comic_details_pic_item" src="'.$row['issue_link_image']. '" >'
                            ?>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="comic_details_text">
                        <?php
                        
                            echo '<h3>' . $row['issue_title'] . '</h3>';
                            echo '<h4>' . $row['issue_subtitle'] . '</h4>';
                            echo '<br>';
                            echo '<p>' . $row['authors'] . '</p>';
                        ?>
                        <?php
                        require('includes/config.php');
                        
                        if(isset($_SESSION['logged'])) {
                            $q='select * from user_fav_comics where comic=' . '"' . $id . '" AND u_unm=' . '"' . $_SESSION['unm'] . '"';
									
							$res=mysqli_query($conn,$q) or die("Can't Execute Query..");
                            $row=mysqli_num_rows($res);
                
                            if (! $row) {
                                echo '<a id="heart-icon" class="heart-icon"><span class="icon_heart_alt"></span> Add to favorite</a> ';
                                
                            }
                            else {
                                echo '<a id="heart-icon" class="heart-icon-active"><span class="icon_heart_alt"></span> Remove to favorite</a> ';
                            }

                            $q='select * from user_read_comics where comic=' . '"' . $id . '" AND u_unm=' . '"' . $_SESSION['unm'] . '"';
									
							$res=mysqli_query($conn,$q) or die("Can't Execute Query..");
                            $row=mysqli_num_rows($res);
                            
                            if (! $row) {
                                echo '<a id="book-icon" class="heart-icon"><span class="icon_book_alt"></span> Add to read</a> ';
                            }
                            else {
                                echo '<a id="book-icon" class="heart-icon-active"><span class="icon_book_alt"></span> Remove to read</a> ';
                            }

                            $q='select * from user_bought_comics where comic=' . '"' . $id . '" AND u_unm=' . '"' . $_SESSION['unm'] . '"';
									
							$res=mysqli_query($conn,$q) or die("Can't Execute Query..");
                            $row=mysqli_num_rows($res);
                            
                            if (! $row) {
                                echo '<a id="archive-icon" class="heart-icon"><span class="icon_archive_alt"></span> Add to bought</a> ';
                            }
                            else {
                                echo '<a id="archive-icon" class="heart-icon-active"><span class="icon_archive_alt"></span> Remove to bought</a> ';
                            }
                        }
                        else {
                            echo '<a href="access.php">Login to manage your library</a>';
                        }
                        ?>
                        <ul>
                            <li><b>Issue Date</b> <span>
                                <?php
                                require('includes/config.php');
                                $q='select * from italiancomics where link_albo=' . '"' . $id . '"';
	
	                            $res=mysqli_query($conn,$q) or die("Can't Execute Query..");
                                $row=mysqli_fetch_assoc($res);
                                    echo $row['issue_date'];
                                ?>
                            </span></li>
                            <li><b>Publisher</b> <span>
                                <?php
                                    echo $row['publisher'];
                                ?>
                            </span></li>
                            <li><b>Serie</b> <span>
                                <?php
                                    $valueformatted = str_replace("_"," ",$row["serie_title"]);
                                    $valueformatted = str_replace("&","&amp", $valueformatted);
                               
                                    echo '<a class="redirect" href="search.php?q=' . $row["serie_title"] . '&by=serie_title">' . $valueformatted . '</a>';
                                ?>
                            </span></li>
                            <li><b>Serie Numbers</b> <span>
                                <?php
                                    echo $row['serie_numbers'];
                                ?>
                            </span></li>
                            <li><b>Serie Year</b> <span>
                                <?php
                                    echo $row['serie_year'];
                                ?>
                            </span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="comic_details_tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Issue Plot</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Issue Stories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Protagonists <span></span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="comic_details_tab_desc">
                                    <h6>Plot</h6>
                                    <?php
                                        echo '<p>' . $row['issue_description'] . '</p>';
                                    ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="comic_details_tab_desc">
                                    <h6>Original Stories (USA Edition)</h6>
                                    <?php
                                        echo '<p>' . $row['issue_originalstories'] . '</p>';
                                    ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="comic_details_tab_desc">
                                    <h6>Protagonists of the Issue</h6>
                                    <?php
                                        echo '<p>' . $row['protagonists'] . '</p>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Comic Details Section End -->

    <!-- Related comic Section Begin -->
    <section class="related-comic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    require('includes/config.php');
                    $q='SELECT * FROM italiancomics WHERE serie_title=' . '"' . $row['serie_title'] . '" AND link_albo <>' . '"' . $row['link_albo'] . '" ORDER BY issue_date DESC LIMIT 4';
                    $res=mysqli_query($conn,$q) or die("Can't Execute Query..");
                    if(mysqli_num_rows($res)!=0) {
                        echo'<div class="section-title related_comic_title">
                                <h2>Related Comics:</h2>
                            </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <?php
                    require('includes/config.php');
                    $q='SELECT * FROM italiancomics WHERE serie_title=' . '"' . $row['serie_title'] . '" AND link_albo <>' . '"' . $row['link_albo'] . '" ORDER BY issue_date DESC LIMIT 4';
                    $res=mysqli_query($conn,$q) or die("Can't Execute Query..");
                    if(mysqli_num_rows($res)==0) {
                    }
                    while($row=mysqli_fetch_assoc($res)) {
                        echo '<div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="comic_item">
                                    <div class="comic_item_pic">
                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                            <img src="'.$row['issue_link_image']. '" width="200" height="270" class="center">
                                        </a>
                                        <ul class="comic_item_pic_hover">';
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
                                            
                                    echo'  </ul>
                                    </div>
                                    <div class="comic_item_text">
                                        <a href="detail.php?id=' .$row['link_albo']. '">
                                            <h5>'.$row['issue_title']. '</h5>   
                                        </a>
                                    </div>
                                </div>
                            </div>';
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Related comic Section End -->

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
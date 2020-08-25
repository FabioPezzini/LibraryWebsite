<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
    require('includes/config.php');

	$textsearch = isset($_GET['q']) ? $_GET['q'] : false;
	$optionfilter = isset($_GET['by']) ? $_GET['by'] : false;
    $optionorder = isset($_GET['order']) ? $_GET['order'] : false;
    $optiondatestart = isset($_GET['dateI']) ? $_GET['dateI'] : false;
    $optiondateend = isset($_GET['dateE']) ? $_GET['dateE'] : false;
	$optionlimit = isset($_GET['limit']) ? $_GET['limit'] : false;


	$totalq="select count(*) \"total\" from italiancomics";

	if($optionfilter) {
        if($optionfilter == "serie_title") {
            $totalq = $totalq . " where $optionfilter = '" . $textsearch . "'";
        }
        else {
            $totalq = $totalq . " where $optionfilter like '%" . $textsearch . "%'";
        }
    }
    else {
        $totalq = $totalq . " where issue_title like '%" . $textsearch . "%'";
    }
    if($optiondatestart) {
        $totalq = $totalq . " AND issue_date >= '" . $optiondatestart . "-01-01'";
        $totalq = $totalq . " AND issue_date <= '" . $optiondateend . "-12-31'";
    }
	if($optionorder) {
		$totalq = $totalq . " ORDER BY issue_date " . $_GET['order'];
    }
	
	$totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
	$totalrow=mysqli_fetch_assoc($totalres);
	
	
	$page_per_page=18;
	
    $page_total_rec=$totalrow['total'];
    
    if($optionlimit) {
		$page_total_rec = $_GET['limit'];
	}
	
	$page_total_page=ceil($page_total_rec/$page_per_page);
	
	
	if(!isset($_GET['page'])){
		$page_current_page=1;
	}
	else{
		$page_current_page=$_GET['page'];
	}
	
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

    <!-- Page Content Begin -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">    
                <div class="sidebar">
                    <div class="sidebar_item">
                        <h4>Filter By</h4>
                        <input type="checkbox" class="radiolist" id="issue_title" name="filterby" value="issue_title">
                        <label for="issue_title">Issue Title</label>
                        <br>
                        <input type="checkbox" class="radiolist" id="serie_title" name="filterby" value="serie_title">
                        <label for="serie_title">Serie Title</label>     
                        <br>
                        <input type="checkbox" class="radiolist" id="publisher" name="filterby" value="publisher">
                        <label for="publisher">Publisher</label>   
                        <br>
                        <input type="checkbox" class="radiolist" id="issue_subtitle" name="filterby" value="issue_subtitle">
                        <label for="issue_subtitle">Issue Subtitle</label> 
                        <br>
                        <input type="checkbox" class="radiolist" id="authors" name="filterby" value="authors">
                        <label for="authors">Authors</label> 
                        <br>
                        <input type="checkbox" class="radiolist" id="protagonists" name="filterby" value="protagonists">
                        <label for="protagonists">Protagonists</label> 
                    </div>
                    <div class="sidebar_item">
                        <h4>Limit Date Year:</h4>
                        <?php
                            require('includes/config.php');
                            $totalq="SELECT YEAR(issue_date) FROM italiancomics ORDER BY issue_date DESC LIMIT 1";
                            $totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
                            $last=mysqli_fetch_row($totalres);
                            $totalq="SELECT YEAR(issue_date) FROM italiancomics ORDER BY issue_date ASC LIMIT 1";
                            $totalres=mysqli_query($conn,$totalq) or die("Can't Execute Query...");
                            $first=mysqli_fetch_row($totalres);
                                
                            echo '<div class="price-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                        data-min="'.$first[0].'" data-max="'.$last[0].'">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                        </div>
                                        <div class="range-slider">
                                            <div class="price-input">
                                                <input type="text" id="minamount" readonly>
                                                <input type="text" id="maxamount" readonly>
                                            </div>
                                        </div>
                                    </div>';
                        ?>
                    </div>
                    <div class="sidebar_item sidebar_item_color--option">
                        <h4>Limit</h4>
                        <div class="sidebar_item_color sidebar_item_color--white">
                            <input type="checkbox" class="radiolist" name="filterlimit" id="10" value="10">    
                            <label for="10">10</label>
                        </div>
                        <div class="sidebar_item_color sidebar_item_color--gray">
                            <input type="checkbox" class="radiolist" name="filterlimit" id="20" value="20">    
                            <label for="20">20</label>
                        </div>
                        <div class="sidebar_item_color sidebar_item_color--red">
                            <input type="checkbox" class="radiolist" name="filterlimit" id="30" value="30">
                            <label for="30">30</label>
                        </div>
                        <div class="sidebar_item_color sidebar_item_color--black">
                            <input type="checkbox" class="radiolist" name="filterlimit" id="40" value="40">    
                            <label for="40">40</label>
                        </div>
                        <div class="sidebar_item_color sidebar_item_color--blue">
                            <input type="checkbox" class="radiolist" name="filterlimit" id="50" value="50">    
                            <label for="50">50</label>
                        </div>
                        <div class="sidebar_item_color sidebar_item_color--green">
                            <input type="checkbox" class="radiolist" name="filterlimit" id="100" value="100">    
                            <label for="100">100</label>
                        </div>
                    </div>
                    <div class="sidebar_item">
                        <h4>Order by</h4>
                        <div class="sidebar_item_size">
                            <input type="checkbox" class="radiolist" name="filterorder" id="ASC" value="ASC">
                            <label for="ASC">Ascending</label>
                        </div>
                        <div class="sidebar_item_size">
                            <input type="checkbox" class="radiolist" name="filterorder" id="DESC" value="DESC">
                            <label for="DESC">Descending</label>
                        </div>
                    </div>
                    <div class="sidebar_item"></div>
                </div>
            </div>
           
            <div class="col-lg-9 col-md-7">  
                <div class="filter_item">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title">
                                <?php
                                    if ($textsearch != null) {
                                        $valueformatted = str_replace("_"," ",$textsearch);
					                    $valueformatted = str_replace("&","&amp", $valueformatted);
                                        echo '<h2>Search result for: ' . $valueformatted . '</h2>';
                                    }
                                    else {
                                        echo '<h2>Set the filters and search something</h2>';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5"></div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter_found">
                                <?php
                                    if ($textsearch != null) {
                                        echo '<h6><span>' . $page_total_rec . '</span> comics found</h6>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                <?php		
                    require('includes/config.php');
                            
                    $textsearch = isset($_GET['q']) ? $_GET['q'] : false;
                    $optionfilter = isset($_GET['by']) ? $_GET['by'] : false;
                    $optionorder = isset($_GET['order']) ? $_GET['order'] : false;
                    $optiondatestart = isset($_GET['dateI']) ? $_GET['dateI'] : false;
                    $optiondateend = isset($_GET['dateE']) ? $_GET['dateE'] : false;
	                $optionlimit = isset($_GET['limit']) ? $_GET['limit'] : false;
                            
                    if ($textsearch) {
						$k=($page_current_page-1)*$page_per_page;

                        $query="select * from italiancomics";
                             
						if($optionfilter) {
                            if($optionfilter == "serie_title") {
                                $query = $query . " where $optionfilter = '" . $textsearch . "'";
                            }
                            else {
                                $query = $query . " where $optionfilter like '%" . $textsearch . "%'";
                            }                                
                        }    
                        else {
							$query = $query . " where issue_title like '%" . $textsearch . "%'";
                        }
                        if($optiondatestart) {
                            $query = $query . " AND issue_date >= '" . $optiondatestart . "-01-01'";
                            $query = $query . " AND issue_date <= '" . $optiondateend . "-12-31'";
                        }
						if($optionorder) {
							 $query = $query . " ORDER BY issue_date " . $_GET['order'];
                        }
                        if($optionlimit) {
                            if ($optionlimit <= 18) {
                                $query = $query . ' LIMIT 0 , ' . $optionlimit;
                            }
                            else if (($k + $page_per_page > $optionlimit)) {
                                $query = $query . ' LIMIT ' . $k . ' , ' . ($optionlimit-$k);
                            }
                            else {
                                $query = $query . ' LIMIT ' . $k . ' , ' . $page_per_page;
                            }
                        }
                        else {
							$query = $query . ' LIMIT ' . $k . ' , ' . $page_per_page;
                        }	
                        		
						$res=mysqli_query($conn,$query) or die("Can't Execute Query...");
	
						while($row=mysqli_fetch_assoc($res)) {
								    echo '<div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="comic_item">
                                                <div class="comic_item_pic" >
                                                    <a href="detail.php?id=' .$row['link_albo']. '">
                                                        <img src="'.$row['issue_link_image']. '" width="200" height="270" class="center">
                                                    </a>
                                                    <ul class="comic_item_pic_hover">
                                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-book"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-archive"></i></a></li>
                                                    </ul>
                                                </div>
                                            <div class="comic_item_text">
                                                <a href="detail.php?id=' .$row['link_albo']. '">
                                                    <h5>'.$row['issue_title']. '</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>';
                        }
                    }
				?>   
            </div>

            <div class="comic_pagination">
                <?php
                    if ($textsearch != null) {
                        $string = "q=$textsearch";
                        if($optionfilter) {
                            $string = $string . "&by=" . $optionfilter;
                        }
                        if($optionorder) {
                             $string = $string . "&order=" . $optionorder;
                        }        
                        if($optiondatestart) {
                            $string = $string . "&dateI=" . $optiondatestart;
                            $string = $string . "&dateE=" . $optiondateend;
                        }
                        if ($optionlimit) {
                            $string = $string . "&limit=" . $optionlimit;
                        }
                            
                        if($page_current_page>1){
                            echo '<a href="search.php?' . $string.'&page='.($page_current_page - 1).'">Back</a>';
						}
                            
                        if ($page_current_page <= ($page_total_page - 3)) {
                            echo '<a href="search.php?' . $string.'&page='.($page_current_page + 1).'">' .($page_current_page + 1).'</a>';
                            echo '<a href="search.php?' . $string.'&page='.($page_current_page + 2).'">' .($page_current_page + 2).'</a>';
                            echo '<a href="search.php?' . $string.'&page='.($page_current_page + 3).'">' .($page_current_page + 3).'</a>';
                        }
                        
                                                
                        if($page_total_page>$page_current_page){	
                            echo '<a href="search.php?' . $string.'&page='.($page_current_page + 1).'">Next</a>';
                        }
                    }
                ?>
            </div>
            <br>
            </div>
        </div>
    </div> 
    <!-- Page Content End -->

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
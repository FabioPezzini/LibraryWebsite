<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    require('includes/config.php');
    $id= $_SESSION['id'];
    print_r($_POST);
    $table = filter_var($_POST["table"], FILTER_SANITIZE_STRING);

    $q='SELECT * FROM ' . $table . ' WHERE comic=' . '"' . $id . '" AND u_unm=' . '"' . $_SESSION['unm'] . '"';
                
    $res=mysqli_query($conn,$q) or die("Can't Execute Query..");
    $row=mysqli_num_rows($res);
    if (isset($_POST['add'])) {
                         
         $sql = "INSERT INTO " . $table . " (comic, u_unm)
        VALUES ('" . $id ."', '". $_SESSION['unm'] ."' )";
        mysqli_query($conn,$sql) or die("Can't Execute Query..");
    }
    else {

        $sql = "DELETE FROM " . $table . " 
        WHERE u_unm ='" . $_SESSION['unm'] ."'AND comic= '". $id ."'";
        mysqli_query($conn,$sql) or die("Can't Execute Query..");
    }   
?>
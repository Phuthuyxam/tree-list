<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
    error_reporting(0);
    require "data.php";
    global $PTX_MAKE_DATA;
    if($_GET['parent']){
        echo $PTX_MAKE_DATA->buildTree($_GET['parent']);

    }else{
        if($_GET['find']){
            echo $PTX_MAKE_DATA->searchTree($_GET['find']);
        }else{
            echo $PTX_MAKE_DATA->buildTree(0);
        }
    }


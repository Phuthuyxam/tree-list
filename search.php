<?php
error_reporting(0);
require "data.php";
global $PTX_MAKE_DATA;
if(isset($_POST) && !empty($_POST)){
    echo $PTX_MAKE_DATA->buildTreeRoot($_POST['idNode'], json_decode($_POST['lastNode']));
}
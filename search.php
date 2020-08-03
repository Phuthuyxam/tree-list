<?php
error_reporting(0);
require "data.php";
global $PTX_MAKE_DATA;
$A = array(1 , 2, 4, 12 , 19 , 5, 6);
$PTX_MAKE_DATA->searchTree(1, $A );
if(isset($_POST) && !empty($_POST)){
    echo $PTX_MAKE_DATA->buildTreeRoot($_POST['idNode'], json_decode($_POST['lastNode']));
}
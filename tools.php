<?php

function preShow( $arr, $returnAsString=false ) {
    $ret  = '<pre>' . print_r($arr, true) . '</pre>';
    if ($returnAsString)
        return $ret;
    else
        echo $ret;
}

function printMyCode() {
    $lines = file($_SERVER['SCRIPT_FILENAME']);
    echo "<pre class='mycode'><ol>";
    foreach ($lines as $line)
        echo '<li>'.rtrim(htmlentities($line)).'</li>';
    echo '</ol></pre>';
}

function php2js( $arr, $arrName ) {
    $lineEnd="";
    echo "<script>\n";
    echo "/* Generated with A4's php2js() function */";
    echo "  var $arrName = ".json_encode($arr, JSON_PRETTY_PRINT);
    echo "</script>\n\n";
}

//$nameErr = $emailErr = $mobileErr = $creditCardErr = $expiryErr = "";
//$custName = $custEmail = $custMobile = $custCard = $custExpiry = $movieID = $movieDay = $movieHour = "";



//function verifyPostData($post){
//    $allOK = true;
//
//    if (empty($_POST['cust']['name'])) {
//        $nameErr = "Name is required";
//        $allOK = false;
//    } else {
//        $custName = test_input($_POST['cust']['name']);
//    }
//
//    if (empty($_POST['cust']['email'])) {
//        $emailErr = "Email is required";
//        $allOK = false;
//    } else {
//        $custEmail = test_input($_POST['cust']['email']);
//    }
//
//    if (empty($_POST['cust']['mobile'])) {
//        $mobileErr = "Mobile number is required";
//        $allOK = false;
//    } else {
//        $custMobile = test_input($_POST['cust']['mobile']);
//    }
//
//    if (empty($_POST['cust']['card'])) {
//        $creditCardErr = "Credit card is required";
//        $allOK = false;
//    } else {
//        $custCard = test_input($_POST['cust']['card']);
//    }
//
//    if (empty($_POST['cust']['expiry'])) {
//        $expiryErr = "Expiry is required";
//        $allOK = false;
//    } else {
//        $custExpiry = test_input($_POST['cust']['expiry']);
//    }
//
//    if (empty($_POST['movie']['id'])) {
//        $allOK = false;
//    } else {
//        $movieID = test_input($_POST['movie']['id']);
//    }
//
//    if (empty($_POST['movie']['day'])) {
//        $allOK = false;
//    } else {
//        $movieDay = test_input($_POST['movie']['day']);
//    }
//
//    if (empty($_POST['movie']['hour'])) {
//        $allOK = false;
//    } else {
//        $movieHour = test_input($_POST['movie']['hour']);
//    }
//
//    if($allOK == true){
//        $_SESSION['cart'] = $_POST;
//        header("Location: receipt.php");
//    }
//
//}

function testInput($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function topModule(){
    $html = <<<"TOPMODULE"
    <!DOCTYPE html>
    <html lang='en'>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lunardo Cinema</title>
    <link rel="icon" href="favicon.ico">

    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather|Montserrat|Sacramento" type="text/css" rel="stylesheet">
    <script src='../wireframe.js'></script>
    </head>
TOPMODULE;
    echo $html;
}

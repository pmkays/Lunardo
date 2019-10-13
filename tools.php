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

function advanceDate($interval)
{
  $date = new DateTime(date("Y-m"));
  $oneMonth = new DateInterval($interval);
  $date->add($oneMonth);
  echo $date->format("Y-m");
}
//$nameErr = $emailErr = $mobileErr = $creditCardErr = $expiryErr = "";
//$custName = $custEmail = $custMobile = $custCard = $custExpiry = $movieID = $movieDay = $movieHour = "";
// Date	Name	Email	Mobile	MovieID	Day	Hour	STA Qty	STP Qty	STC Qty	FCA Qty	FCP Qty	FCC Qty	Total

function writeToFile($totalPrice){
  $order = [
    date("d.m.y"),
    $_SESSION['cart']['cust']['name'],
    $_SESSION['cart']['cust']['email'],
    $_SESSION['cart']['cust']['mobile'],
    $_SESSION['cart']['movie']['id'],
    $_SESSION['cart']['movie']['day'],
    $_SESSION['cart']['movie']['hour'],
    checkIfEmpty($_SESSION['cart']['seats']['STA']),
    checkIfEmpty($_SESSION['cart']['seats']['STP']),
    checkIfEmpty($_SESSION['cart']['seats']['STC']),
    checkIfEmpty($_SESSION['cart']['seats']['FCA']),
    checkIfEmpty($_SESSION['cart']['seats']['FCP']),
    checkIfEmpty($_SESSION['cart']['seats']['FCC']),
    $totalPrice
  ];
  $fp = fopen("bookings.txt", "a");
  flock($fp, LOCK_EX);
  fputcsv($fp, $order, "\t");
  flock($fp, LOCK_UN);
  fclose($fp);
}

// returns 0 if it is empty
function checkIfEmpty($check){
  if(empty($check)){
    return 0;
  }
  else return $check;
}

function testInput($data)
{
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

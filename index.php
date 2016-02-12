<?php
session_start();
include_once("pages/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Country-City-Lang </title>

    <!--meta charset="utf-8"-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->
   <script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
   <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/moment-with-locales.min.js"></script>
   

    <!--load bootstrap css-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />   
    <link rel='stylesheet' type='text/css' href='styles/style.css' />
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    [endif]-->


</head>

<body>
<div class='header'>
	<h2>Country-City-Lang</h2>
</div>




<?php

//ShowHeader( "Country-City-Lang","white","Country-City-Lang");
echo "<div class='menu'>";
include_once("pages/menu.php");
echo "</div>";
echo "<div class='content'>";
if(isset($_GET['id']))
{
  $id = $_GET['id'];
  if($id>=10) include_once("pages/edit.php");
  if($id==2) include_once("pages/select.php"); 
}
echo "</div>"

?> 
</body>
</html>






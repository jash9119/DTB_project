<?php require_once('connect.php'); ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/navbar.css">
</head>

<div class="topnav" id="myTopnav">
  <a href="#">
    <div class="nav-title" style="margin-right: 20rem">
    <a href = "landing.php"><img class="logo" src="image/logo.svg"></a>
    <a href = "landing.php"><h1 class="title">Amusigo.</h1></a>
    </div>
  </a>

  <a href="landing.php#about">About</a>
  <a href="landing.php#faq-container">FAQ</a>
  <a href="landing.php#contact">Contact</a>
  <div><a href="signin.php"><button id="btn-join"
  style = " background-color: #8d2182;
  border-style: none;
  border-radius: 5px;
  color: white;
  padding-inline: 1.5rem;
  padding-block: 10px;
  font-size: 1rem;
  margin-block: 1rem;"
  >Sign In</button></a></div>
  
  
  

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
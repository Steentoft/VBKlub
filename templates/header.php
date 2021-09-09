<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/import.css">

    <title>Volleyball</title>
</head>
<body>

<div class="logo-container container">
    <img class="logo" src="billeder/logo.png">
</div>
<div class="container container-custom">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="./">Forside</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="omklubben.php">Om klubben</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="staevneplan.php">Stævneplan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tilmelding.php">Tilmelding</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="galleri.php">Galleri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bestyrelse.php">Bestyrelse</a>
                </li>
            </ul>
            <?php
            if($_SESSION['volleyball_validation'] == true){
            ?>
                <div class="my-2 my-lg-0 mr-3">
                    <a href="adminpanel/" class="mb-0">Adminpanel</a>
                </div>
                <div class="my-2 my-lg-0">
                    <a href="BL/verification/verify_logout.php" class="mb-0">Log ud</a>
                </div>
            <?php
            } else{
            ?>
                <form method="post" id="loginForm" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" id="username" name="username" placeholder="Brugernavn"/>
                    <input class="form-control mr-sm-2" id="password" type="password" y name="password" placeholder="Kodeord" />
                    <button type="submit" class="btn btn-outline-success my-2 my-sm-0" >Login</button>
                </form>
            <?php
            }
            ?>
        </div>
    </nav>
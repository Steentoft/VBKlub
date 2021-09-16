<?php session_start();
if ($_SESSION['volleyball_validation'] == false){
    header('Location: ../');
}
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="billeder/icon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/import.css">
    <link href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css" rel="stylesheet"/>


    <!-- TinyMCE WYSIWYG -->
    <script src="https://cdn.tiny.cloud/1/af7kksyzobw5301ef24l8ls6ix9f9nksoxhl21geyd0l6kmq/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="../js/tinyInit.js"></script>

    <title>Volleyball</title>
</head>
<body>
<div class="logo-container container">
    <a href="../"><img class="logo" src="../billeder/logo.png"></a>
</div>
<div class="container container-custom">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../">Forside</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../omklubben.php">Om klubben</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../staevneplan.php">Stævneplan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../tilmelding.php">Tilmelding</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../galleri.php">Galleri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../bestyrelse.php">Bestyrelse</a>
                </li>

            </ul>
            <div class="my-2 my-lg-0 mr-3">
                <a href="./" class="mb-0">Adminpanel</a>
            </div>
            <div class="my-2 my-lg-0">
                <a href="../BL/verification/verify_logout.php" class="mb-0">Log ud</a>
            </div>
        </div>
    </nav>
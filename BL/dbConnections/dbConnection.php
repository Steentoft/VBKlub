<?php

//$conn = mysqli_connect("localhost", "nrlynvk_dk_volleyball", "v0lleyb4ll653!", "nrlynvk_dk_volleyball");
$conn = mysqli_connect("localhost", "root", "", "volleyball");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
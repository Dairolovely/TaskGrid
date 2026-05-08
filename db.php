<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "taskgrid"
);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

?>
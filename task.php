<?php
include 'db.php';

if(isset($_POST['add_task'])){

    $task = $_POST['task_title'];
    $description = $_POST['description'];
    $due = $_POST['due_date'];

    $sql = "INSERT INTO tasks(task_title, description, due_date)
            VALUES('$task','$description','$due')";

    mysqli_query($conn, $sql);
}
?>


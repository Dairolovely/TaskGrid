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

<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
</head>
<body>

<h2>Add Task</h2>

<form method="POST">

<input type="text" name="task_title" placeholder="Task Title" required><br><br>

<textarea name="description"></textarea><br><br>

<input type="date" name="due_date"><br><br>

<button type="submit" name="add_task">Add Task</button>

</form>

</body>
</html>
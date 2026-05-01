<!-- <?php
session_start();
require 'db.php'; // This connects to $conn

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$res = $conn->query("SELECT * FROM tasks WHERE task_id = $id");
$task = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $status = $_POST['status'];
    // Update Operation
    $stmt = $conn->prepare("UPDATE tasks SET task_title = ?, status = ? WHERE task_id = ?");
    $stmt->bind_param("ssi", $title, $status, $id);
    $stmt->execute();
    header("Location: dashboard.php");
    exit();
}
?> -->
<!-- <!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"><title>Edit Task</title></head>
<body class="auth-page">
    <div class="auth-card">
        <h3>Update Task Details</h3>
        <form method="POST">
            <input type="text" name="title" value="<?php echo htmlspecialchars($task['task_title']); ?>" required>
            <select name="status">
                <option <?php if($task['status']=='Pending') echo 'selected'; ?>>Pending</option>
                <option <?php if($task['status']=='Completed') echo 'selected'; ?>>Completed</option>
            </select>
            <button type="submit" class="btn-primary">Save Changes</button>
            <a href="dashboard.php">Cancel</a>
        </form>
    </div>
</body>
</html> -->
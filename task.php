<?php
session_start();
require 'db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM tasks WHERE task_id = $id");
    header("Location: dashboard.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $due = $_POST['due'];
    $uid = $_POST['user_id'];

    $stmt = $conn->prepare("INSERT INTO tasks (task_title, description, due_date, assigned_to) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $title, $desc, $due, $uid);
    $stmt->execute();
    header("Location: dashboard.php");
}
$users = $conn->query("SELECT user_id, fullname FROM users");
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"><title>Add Task</title></head>
<body class="auth-page">
    <div class="auth-card">
        <h3>New Task</h3>
        <form method="POST">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="desc" placeholder="Details"></textarea>
            <input type="date" name="due" required>
            <select name="user_id">
                <option value="">Assign Member</option>
                <?php while($u = $users->fetch_assoc()): ?>
                    <option value="<?php echo $u['user_id']; ?>"><?php echo $u['fullname']; ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="btn-primary">Create</button>
        </form>
    </div>
</body>
</html>
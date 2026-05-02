<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

// SQL JOIN INTEGRATION (Requirement #3 - 30 Points)
// We use LEFT JOIN to retrieve tasks and the names of users assigned to them.
$sql = "SELECT tasks.*, users.fullname 
        FROM tasks 
        LEFT JOIN users ON tasks.assigned_to = users.user_id 
        ORDER BY tasks.due_date ASC";
$result = $conn->query($sql);

// Chart Data
$p_res = $conn->query("SELECT COUNT(*) as total FROM tasks WHERE status='Pending'");
$p_count = $p_res->fetch_assoc()['total'];
$c_res = $conn->query("SELECT COUNT(*) as total FROM tasks WHERE status='Completed'");
$c_count = $c_res->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>TaskGrid Dashboard</title>
</head>
<body>
    <div class="sidebar">
        <h2>TaskGrid</h2>
        <p>Welcome, <?php echo $_SESSION['fullname']; ?></p>
        <a href="dashboard.php">Dashboard</a>
        <a href="task.php">New Task</a>
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
    <div class="main-content">
        <div class="card chart-container">
            <h3>Progress Overview</h3>
            <canvas id="statusChart"></canvas>
        </div>
        <div class="card">
            <h3>Tasks Grid</h3>
            <table>
                <tr>
                    <th>Task</th>
                    <th>Assignee (SQL JOIN)</th>
                    <th>Status</th>
                    <th>Due</th>
                    <th>Actions</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['task_title']; ?></td>
                    <td><?php echo $row['fullname'] ?? 'Unassigned'; ?></td>
                    <td><span class="status-<?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></td>
                    <td><?php echo $row['due_date']; ?></td>
                    <td>
                        <a href="editTask.php?id=<?php echo $row['task_id']; ?>">Edit</a> |
                        <a href="task.php?delete=<?php echo $row['task_id']; ?>" style="color:red;">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <script>
        new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: ['Pending', 'Completed'],
                datasets: [{
                    data: [<?php echo $p_count; ?>, <?php echo $c_count; ?>],
                    backgroundColor: ['#f1c40f', '#2ecc71']
                }]
            }
        });
    </script>
</body>
</html>
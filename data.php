<?php 
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Session timeout duration (in seconds)
$timeout_duration = 60; // 1 minute

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check for inactivity logout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php?session=expired");
    exit();
}

// Update last activity timestamp
$_SESSION['LAST_ACTIVITY'] = time();

include 'config.php'; // Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="startIdleTimer()">
    <script>
        let idleTime = 0;
        let logoutTime = 60; // 60 seconds

        function resetIdleTimer() {
            idleTime = 0;
        }

        function startIdleTimer() {
            document.onmousemove = resetIdleTimer;
            document.onkeypress = resetIdleTimer;
            document.onscroll = resetIdleTimer;
            document.onclick = resetIdleTimer;

            setInterval(() => {
                idleTime++;
                if (idleTime >= logoutTime) {
                    alert("Session expired due to inactivity!");
                    window.location.href = "index.php";
                }
            }, 1000);
        }
    </script>

    <div class="container mt-4">
        <h1 class="text-center">Student Details</h1>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>Skills</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM stud";
                $run = mysqli_query($connection, $sql);
                $id = 1;
                if ($run && mysqli_num_rows($run) > 0) {
                    while ($row = mysqli_fetch_assoc($run)) {
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['age']); ?></td>
                            <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                            <td><?php echo htmlspecialchars($row['course']); ?></td>
                            <td><?php echo htmlspecialchars($row['skills']); ?></td>
                            <td>
                                <?php if (!empty($row['file'])) : ?>
                                    <a href="<?php echo htmlspecialchars($row['file']); ?>" target="_blank">View File</a>
                                <?php else : ?>
                                    No File
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit.php?edit=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                                <a href="delete.php?del=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                        <?php 
                        $id++;
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }
            ?>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <a href="add.php" class="btn btn-primary">Add New</a>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>
</body>
</html>

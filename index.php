<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
            ?>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <a href="add.php" class="btn btn-primary">Add New</a>
            <a href="login.php" class="btn btn-primary">logout</a>
        </div>
    </div>

</body>
</html>

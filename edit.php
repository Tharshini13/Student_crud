<?php
include 'db.php';


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM stud WHERE id='$id'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Student not found!";
        exit;
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $age = mysqli_real_escape_string($connection, $_POST['age']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $course = mysqli_real_escape_string($connection, $_POST['course']);
    

    $skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : '';
    $skills = mysqli_real_escape_string($connection, $skills);


    if (!empty($_FILES['file']['name'])) {
        $filename = $_FILES['file']['name'];
        $tempname = $_FILES['file']['tmp_name'];
        $folder = "uploads/" . $filename;
        move_uploaded_file($tempname, $folder);
        

        $sql = "UPDATE stud SET name='$name', age='$age', mobile='$mobile', gender='$gender', course='$course', skills='$skills', file='$folder' WHERE id='$id'";
    } else {

        $sql = "UPDATE stud SET name='$name', age='$age', mobile='$mobile', gender='$gender', course='$course', skills='$skills' WHERE id='$id'";
    }
    
    if (mysqli_query($connection, $sql)) {
        echo '<script>location.replace("index.php")</script>';
    } else {
        echo 'Error: ' . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Edit Student</h2>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="edit.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
                            </div><br>
                            <div class="form-group">
                                <input type="number" class="form-control" name="age" value="<?php echo $row['age']; ?>" required>
                            </div><br>
                            <div class="form-group">
                                <input type="text" class="form-control" name="mobile" value="<?php echo $row['mobile']; ?>" required>
                            </div><br>
                            <div class="form-group">
                                <label><b>Gender</b></label><br>
                                <input type="radio" name="gender" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?>> Female
                                <input type="radio" name="gender" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?>> Male
                            </div><br>
                            <div class="form-group">
                                <label><b>Select Course</b></label>
                                <select class="form-control" name="course">
                                    <option value="B.Tech" <?php echo ($row['course'] == 'B.Tech') ? 'selected' : ''; ?>>B.Tech</option>
                                    <option value="M.Tech" <?php echo ($row['course'] == 'M.Tech') ? 'selected' : ''; ?>>M.Tech</option>
                                    <option value="B.Sc" <?php echo ($row['course'] == 'B.Sc') ? 'selected' : ''; ?>>B.Sc</option>
                                    <option value="M.Sc" <?php echo ($row['course'] == 'M.Sc') ? 'selected' : ''; ?>>M.Sc</option>
                                </select>
                            </div><br>
                            <div class="form-group">
                                <label><b>Skills</b></label><br>
                                <?php $selectedSkills = explode(", ", $row['skills']); ?>
                                <input type="checkbox" name="skills[]" value="PHP" <?php echo in_array("PHP", $selectedSkills) ? 'checked' : ''; ?>> PHP  
                                <input type="checkbox" name="skills[]" value="JavaScript" <?php echo in_array("JavaScript", $selectedSkills) ? 'checked' : ''; ?>> JavaScript  
                                <input type="checkbox" name="skills[]" value="Python" <?php echo in_array("Python", $selectedSkills) ? 'checked' : ''; ?>> Python  
                                <input type="checkbox" name="skills[]" value="HTML" <?php echo in_array("HTML", $selectedSkills) ? 'checked' : ''; ?>> HTML  
                            </div><br>
                            <div class="form-group">
                                <label><b>Upload New File</b></label>
                                <input type="file" class="form-control" name="file">
                            </div><br>
                            <center><input type="submit" class="btn btn-success" name="update" value="Update"></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
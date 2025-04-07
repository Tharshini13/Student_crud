<?php 
include 'db.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    $skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : '';
    $skills = mysqli_real_escape_string($conn, $skills);

    // Check if mobile number already exists
    $checkMobile = "SELECT * FROM stud WHERE mobile = '$mobile'";
    $checkResult = mysqli_query($conn, $checkMobile);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<div class='alert alert-warning text-center'>Mobile number already exists!</div>";
    } else {
        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $folder = "uploads/" . $filename;

        if (move_uploaded_file($tempname, $folder)) {
            $sql = "INSERT INTO stud (name, age, mobile, gender, course, skills, file) 
                    VALUES ('$name', '$age', '$mobile', '$gender', '$course', '$skills', '$folder')";

            if (mysqli_query($conn, $sql)) {
                echo '<script>location.replace("data.php")</script>';
            } else {
                echo '<div class="alert alert-danger text-center">Database Error: ' . $conn->error . '</div>';
            }
        } else {
            echo "<div class='alert alert-danger text-center'>File upload failed!</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Add Student</h2>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="add.php" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control" name="age" placeholder="Enter Age" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile" required>
                            </div>
                            <div class="form-group mb-3">
                                <label><b>Gender</b></label><br>
                                <input type="radio" name="gender" value="Female" checked> Female
                                <input type="radio" name="gender" value="Male"> Male
                            </div>
                            <div class="form-group mb-3">
                                <label><b>Select Course</b></label>
                                <select class="form-control" name="course">
                                    <option value="B.Tech">B.Tech</option>
                                    <option value="M.Tech">M.Tech</option>
                                    <option value="B.Sc">B.Sc</option>
                                    <option value="M.Sc">M.Sc</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label><b>Skills</b></label><br>
                                <input type="checkbox" name="skills[]" value="PHP"> PHP  
                                <input type="checkbox" name="skills[]" value="JavaScript"> JavaScript  
                                <input type="checkbox" name="skills[]" value="Python"> Python  
                                <input type="checkbox" name="skills[]" value="HTML"> HTML  
                            </div>
                            <div class="form-group mb-3">
                                <label><b>Upload File</b></label>
                                <input type="file" class="form-control" name="file" required>
                            </div>
                            <center>
                                <input type="submit" class="btn btn-primary" name="submit" value="Save">
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

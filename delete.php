<?php
include 'db.php';

if (isset($_GET['del'])) {
    $delete = mysqli_real_escape_string($conn, $_GET['del']);
    $sql = "DELETE FROM stud WHERE id = '$delete'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>location.replace("data.php")</script>';
    } else {
        echo 'Some error: ' . $conn->error;
    }
} else {
    echo 'Invalid request.';
}
?>

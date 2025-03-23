<?php
include 'db.php';
$delete = $_GET['del'];
$sql = "DELETE FROM stud WHERE id ='$delete'";
if(mysqli_query($connection, $sql)) {
    echo '<script>location.replace("index.php")</script>';
} else {
    echo 'Some error: ' . $connection->error;
}
?>

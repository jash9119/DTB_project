<!DOCTYPE html>
<html>
    <head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
</html>
<?php
require_once('connect.php');
session_start();
$username = $_SESSION["username"];
$song_id = $_GET['songid'];
$friend = $_GET["friend"];

if (isset($song_id)) {
    $frnd = "SELECT * FROM users WHERE Username = '$friend'";
        $result = $mysqli->query($frnd);
        if ($result !== false) {
            while ($row = $result->fetch_array()) {
                $friend_id = $row[0];
            }
        } else {
            echo "Error in query execution: " . $mysqli->error;
        }
    $song = "SELECT * FROM users WHERE Username = '$username'";
    $result1 = $mysqli->query($song);

    if ($result1 !== false) {
        while ($row1 = $result1->fetch_array()) {
            $student_id = $row1[0];
        }
    } else {
        echo "Error in query execution: " . $mysqli->error;
    }
        
    $check_query = "SELECT COUNT(*) as count FROM user_musicbank WHERE Song_ID = $song_id AND Student_id = $student_id";
    $check_result = $mysqli->query($check_query);

    if ($check_result !== false) {
        while ($row = $check_result->fetch_array()) {
            $count = $row['count'];
        }
    } else {
        echo "Error in query execution: " . $mysqli->error;
    }

    if ($count == 0) {
        $insert = "INSERT INTO user_musicbank VALUES($song_id,$student_id)";

        if (!$mysqli->query($insert)) {
            echo "INSERT failed. Error: " . $mysqli->error;
            return false;
        } else{
            echo "<script>
            Swal.fire({
               icon: 'success',
               title: 'Song Added',
               showConfirmButton: false,
               timer: 3000
            }).then(function() {
                window.location.href = 'mateProfile.php?friend=" . $friend . "';
            });
         </script>";
        }
    }
    else {
        echo "<script>
        Swal.fire({
           icon: 'success',
           title: 'Song Already In Music Bank',
           showConfirmButton: false,
           timer: 3000
        }).then(function() {
            window.location.href = 'mateProfile.php?friend=" . $friend . "';
 
        });
     </script>";
    }

    $mysqli->close();
   //header("Location:global.php");
}
?>

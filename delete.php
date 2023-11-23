<?php
require_once('connect.php');
session_start();
$username = $_SESSION["username"];
$song_id = $_GET['song_id'];
$mate_id = $_GET['mate_id'];

if (isset($song_id)) {
$songQold = "SELECT * FROM users WHERE Username = '$username'";
        $result1 = $mysqli->query($songQold);
        if ($result1 !== false) {
            while ($row1 = $result1->fetch_array()) {
                $student_id = $row1[0];
            }
        } else {
            echo "Error in query execution: " . $mysqli->error;
        }
        
$q="DELETE FROM user_musicbank WHERE Song_ID=$song_id and Student_ID = $student_id";
if(!$mysqli->query($q)){
	echo "DELETE failed. Error: ".$mysqli->error;}
$mysqli->close();
header("Location: musicbank.php");
}

if (isset($mate_id)) {
	$query = "SELECT * FROM users WHERE Username = '$username'";
			$result1 = $mysqli->query($query);
			if ($result1 !== false) {
				while ($row1 = $result1->fetch_array()) {
					//echo "<h1> this is my id " . $row1[0] . "</h1>";
					$student_id = $row1[0];
				}
			} else {
				echo "Error in query execution: " . $mysqli->error;
			}
			
	$q="DELETE FROM friend WHERE friend_id=$mate_id and user_id = $student_id";
	if(!$mysqli->query($q)){
		echo "DELETE failed. Error: ".$mysqli->error;}
	$mysqli->close();
	header("Location: musicmate.php");
	}
?>
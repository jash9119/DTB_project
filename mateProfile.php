<?php require_once('connect.php'); 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Amusigo</title>
<link rel="stylesheet" href="css/mateProfile.css">
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body id="mateProfile">

<?php include('sidebar.php'); ?>
<?php $friend = $_GET["friend"];
$username = $_SESSION["username"]; 
 ?>
    <div class="container">
        
        <h1 style="color:#8328BA">User Profile</h1>
        <div class="top-container">
            <img class="profile-pic"src="image/contact.svg"/>
            <div>
                <h2>Username: <?php echo $friend;?> </h2>
                <form method='post'>
                    <input type='hidden' name='friend_name' value='<?php echo $friend; ?>'>
                    <a href='musicmate.php'><button class="add-friend-btn" name="follow">Follow</button></a>
                            <!-- <input class="add-friend-btn" type='submit' name='follow' value='Follow'> -->
                </form>
               
            </div>
        </div>
        
        <div>
        <h3>Check your mate's playlist</h3>
        <table>
            <tr>
                <th>Song</th>
                <th>Artist</th>
                <th>Genre</th>
                <th>Add song</th>
            </tr>
            
            <?php
        $frnd = "SELECT * FROM users WHERE Username = '$friend'";
        $result = $mysqli->query($frnd);
        if ($result !== false) {
            while ($row = $result->fetch_array()) {
                $friendid = $row[0];
            }
        } else {
            echo "Error in query execution: " . $mysqli->error;
        }
        $songQold = "SELECT * FROM users WHERE Username = '$username'";
        $result1 = $mysqli->query($songQold);
        if ($result1 !== false) {
            while ($row1 = $result1->fetch_array()) {
                $student_id = $row1[0];
            }
        } else {
            echo "Error in query execution: " . $mysqli->error;
        }
        

            $songQ = "SELECT Songs.Song_ID, S.title, A.name, G.Genre_name
                    FROM user_musicbank as Songs
                    INNER JOIN global_musicbank as S on Songs.Song_ID = S.Song_ID
                    INNER JOIN Genre as G on S.Genre_ID = G.Genre_ID
                    INNER JOIN Artist as A on S.Artist_ID = A.Artist_ID
                    WHERE Student_ID = $friendid";
            if($result2=$mysqli->query($songQ)){
                while($row2=$result2->fetch_array()){
                    echo "<tr>
                        <td> " . $row2['title']."</td>
                        <td>" . $row2['name']."</td>
                        <td>" . $row2['Genre_name']."</td>
                        <td>
                            <a href='addfromuser.php?songid=" . $row2['Song_ID'] . "&friend=" . $friend . "'><i class='fa-regular fa-circle-plus'></i></a>
                        </td>
                    </tr>";
                }
            }

            if (isset($_POST['follow'])) {
                // Retrieve friend_id from the form submission
                $friend_name = $_POST['friend_name'];
                $fr = "SELECT * FROM users WHERE Username = '$friend_name'";
        $result = $mysqli->query($fr);
        if ($result !== false) {
            while ($row = $result->fetch_array()) {
                $friendid = $row[0];
            }
        } else {
            echo "Error in query execution: " . $mysqli->error;
        }

        // Check if the friendship already exists
    $checkFriendshipQuery = "SELECT * FROM friend WHERE user_id = $student_id AND friend_id = $friendid";
    $checkFriendshipResult = $mysqli->query($checkFriendshipQuery);

    if ($checkFriendshipResult->num_rows === 0) {
        $insert = "INSERT INTO friend VALUES ($student_id, $friendid)";
        $result3 = $mysqli->query($insert);

        if ($result3) {
            echo "Followed successfully! <br>";
        } else {
            echo "Error in query execution: " . $mysqli->error;
        }
    } else {
        echo "You are already following this user.<br>";
    }
        // echo "Student ID: " . $student_id . "<br>";
        // echo "Friend ID: " . $friendid . "<br>";

                // $insert = "INSERT INTO friend VALUES ($student_id,$friendid)";
                // $result3 = $mysqli->query($insert);
        
                // if ($result3) {
                //     echo "Followed successfully!";
                // } else {
                //     echo "Error in query execution: " . $mysqli->error;
                // }    
            }
       
        ?>
        </table>
        </div>

    </div>
</body>

</html>
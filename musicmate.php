<?php 
require_once('connect.php'); 

session_start();

if (!isset($_SESSION["username"]) || $_SESSION["login"] !== true) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Amusigo</title>
<link rel="stylesheet" href="css/musicmate.css">
<link rel="stylesheet" href="css/default.css">
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body id="music-mate">


<?php $username = $_SESSION["username"]; ?>
<?php include('sidebar.php'); ?>
    <div class="musicmate-right">
        
        <div class="top-container">
            <h1 style="color:#8328BA">Your Music Mates</h1>

            <!-- search bar -->
            <form action ="searchMate.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="Search for mate ... ">
                    <a href="searchMate.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
                    </a>
                </div>
            </form>
           
                <!-- profile button -->
                 <?php include('profile.php'); ?> 
            <!-- <a href="userprofile.php"><button class="profile-btn">
            <i class="fa-regular fa-user"></i>
                &nbsp;Profile  -->
        </button>
    </a>

        </div>
            <!-- Search bar -->
        <div class="input-container-2">
                <input class="search" type="text" placeholder="In your music bank ... ">            
                <i class="search-icon fa-solid fa-magnifying-glass"></i>
        </div>
        <div>
        <table>
        <tr>
            <th>Username</th>
            <th>Unfollow</th>
        </tr>
        <?php
        $stdid = "SELECT * FROM users WHERE Username = '$username'";
        $result1 = $mysqli->query($stdid);
        if ($result1 !== false) {
            while ($row1 = $result1->fetch_array()) {
                $student_id = $row1[0];
            }
            
            $frnd = "SELECT ff.friend_id, u.username from users as u
            INNER JOIN friend as ff on u.Student_ID = ff.friend_id
                    WHERE ff.user_id = $student_id";
            if($result=$mysqli->query($frnd)){
                while($row=$result->fetch_array()){
                    echo "<tr>
                        <td> " . $row['username']."</td>
                        <td>
                            <a href='delete.php?mate_id=" . $row['friend_id'] . "'><button class='remove-btn' 
                            style='font-size: medium;font-weight: bold;'> - </button></a>
                        </td>
                    </tr>";
                }
            }else {
                echo "Error in second query execution: " . $mysqli->error;
            }
        } else {
            echo "Error in query execution: " . $mysqli->error;
        }

        

        ?>
    </table>
        </div>
    </div>
</body>

</html>
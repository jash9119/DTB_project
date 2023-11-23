<?php 
require_once('connect.php'); 
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["login"] !== true) {
    header("Location: signin.php");
    exit();
}
$username = $_SESSION["username"];
//$search= $_SESSION['search'];
?>

<!DOCTYPE html>
<html class="bg-color">
    <head>
        <title>Amusigo</title>
        <link rel="stylesheet" href="css\searchGlobal.css">

        <link href = "https://fonts.googleapis.com/css2?family=Lato&display=swap" rel = "stylesheet">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    </head>
    <body id="global">   
        <?php 
            include('sidebar.php');
         ?>

        <div class="global-right">
           
           
            <h1 class="home-title" style="color:#8328ba"><strong>Your Music Mates</strong></h1>
            <!-- search bar -->
            <form action ="searchMate.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="Search for mates ... ">
                    <a href="searchMate.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
                    </a>
                </div>
            </form>

            <?php
                if ($_SESSION['role'] == 'admin') {
                    echo "<a href='addSong.php'>
                            <button class='add-btn'> + Add Song</button>
                        </a>
                        <br></br>";
                }
                
            ?>

<!-- for user mates -->
                <?php
                 if (isset($_POST['searchbtn'])) {
                    $search = $_POST["searchSong"];
                    
                    if (!empty($search)) {
                        
                        $stdid = "SELECT * FROM users WHERE Username = '$username'";
                        $result1 = $mysqli->query($stdid);
                        if ($result1 !== false) {
                            while ($row1 = $result1->fetch_array()) {
                                //echo "<h1> this is my id " . $row1[0] . "</h1>";
                                $student_id = $row1[0];
                            }
                        } else {
                            echo "Error in query execution: " . $mysqli->error;
                        }
                            
                            $frnd = "SELECT ff.friend_id, u.username from users as u
                            INNER JOIN friend as ff on u.Student_ID = ff.friend_id
                                    WHERE u.username like '%" . $search . "%' and ff.user_id = $student_id";
                            
                            $result=$mysqli->query($frnd);
                            
                            if($result->num_rows > 0){
                                echo "<strong>Friend Found !";
                                echo "<br></br>";
                                    echo "<table>
                                            <tr>
                                               <th>Mate name</th>
                                                <th>Action</th>
                                            </tr>";
                                while($row=$result->fetch_array()){
                                    echo "<tr>
                                        <td> " . $row['username']."</td>
                                        <td>
                                            <a href='delete.php?mate_id=" . $row['friend_id'] . "'><button class='delete-btn' 
                                            style='font-size: medium;font-weight: bold;'> - </button></a>
                                        </td>
                                    </tr>";
                                }
                                echo"</table>";
                            }
        
                        
                         else {
                            echo "<strong>No results found";
                            echo "<br></br>";
                        }
                            
                        // Free result set
                        $result->free_result();
                    } else {

                        echo "<strong>No search term provided.";
                    }
                
        
                 }
            
                ?>

        </div>
    </body>

    
</html>




<?php 
require_once('connect.php'); 
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["login"] !== true) {
    header("Location: signin.php");
    exit();
}
$username = $_SESSION["username"]; 
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
           
           
            <h1 class="home-title" style="color:#8328ba"><strong>Your Music Bank</strong></h1>
            <!-- search bar -->
            <form action ="searchUserBank.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="In your music bank ... ">
                    <a href="searchUserBank.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
                    </a>
                </div>
            </form>

                <?php
                 if (isset($_POST['searchbtn'])) {
                    $search = $_POST["searchSong"];
                    
                    if (!empty($search)) {
                        
                        $songQold = "SELECT * FROM users WHERE Username = '$username'";
                        $result1 = $mysqli->query($songQold);
                        
                        if ($result1 !== false) {
                            while ($row1 = $result1->fetch_array()) {
                                //echo "<h1> this is my id " . $row1[0] . "</h1>";
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
                                    WHERE S.title like '%" . $search . "%' and Student_ID=$student_id";
                           
                            $result = $mysqli->query($songQ); 
                            //echo $songQ;
                                if ($result->num_rows > 0) {
                                    echo "<strong>Song Found !";
                                echo "<br></br>";
                                    echo "<table>
                                            <tr>
                                                <th>Song</th>
                                                <th>Artist</th>
                                                <th>Genre</th>
                                                <th>Action</th>
                                            </tr>";    

                                while($row=$result->fetch_array()){
                                    echo "<tr>
                                        <td> " . $row['title']."</td>
                                        <td>" . $row['name']."</td>
                                        <td>" . $row['Genre_name']."</td>
                                        <td>
                                            <a href='delete.php?song_id=" . $row['Song_ID'] . "'><button class='delete-btn' 
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




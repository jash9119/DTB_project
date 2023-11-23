<?php 
require_once('connect.php'); 

session_start();

if (!isset($_SESSION["username"]) || $_SESSION["login"] !== true) {
    header("Location: signin.php");
    exit();
}

$username = $_SESSION["username"]; 
?>

<script>
    console.log(document.cookie);
</script>


<!DOCTYPE html>
<html class="bg-color">
    <head>
        <title>Amusigo</title>
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/default.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    </head>
    <body id="homepage">

        
        <?php include('sidebar.php'); ?>

        <div class="homepage-right">
            <!-- profile button -->
            <?php include('profile.php'); ?>
           
            <h1 class="home-title" style="color:#8328ba">Welcome <?php echo $username;?> !
</h1>
            
            <!-- search bar -->
            <form action ="searchGlobal.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="Search for a song ... ">
                    <a href="searchGlobal.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
                    </a>
                </div>
            </form>

            
            <?php 
               $songQold = "SELECT * FROM users WHERE Username = '$username'";
               $result1 = $mysqli->query($songQold);
               
               if ($result1 !== false) {
                   while ($row1 = $result1->fetch_array()) {
                       $student_id = $row1['Student_ID'];
                   }
               } else {
                   echo "Error in query execution: " . $mysqli->error;
               }
               
               $maxartist = "SELECT count(u.Song_ID) as c, a.Artist_ID FROM user_musicbank as u 
                   INNER JOIN global_musicbank as g ON u.Song_ID = g.Song_ID 
                   INNER JOIN artist as a ON g.Artist_ID = a.Artist_ID
                   WHERE u.Student_ID = $student_id 
                   GROUP BY a.Artist_ID 
                   ORDER BY c DESC 
                   LIMIT 1";
               
               if ($resultm = $mysqli->query($maxartist)) {
                   while ($rowm = $resultm->fetch_array()) {
                       $artist = $rowm[1];
                       
                   }
               } else {
                   echo 'Query error: ' . $mysqli->error;
               }
               
            //    $checkQ = mysqli_query("SELECT count(Song_ID) as c from user_musicbank 
            //    as umb where umb.Student_ID = $student_id", $mysqli); 
            //    echo $checkQ;
                // $stmt = $mysqli->query($checkQ);
                // Bind the parameter and execute the statement
                // $stmt->bind_param("i", $student_id); // Assuming Student_ID is an integer
                // $stmt->execute();
                // $stmt->bind_result($count);
            
                // // Fetch the result
                // $stmt->fetch();

                

                $checkQ = "SELECT count(Song_ID) as c from user_musicbank as umb where umb.Student_ID = $student_id";
                $result = mysqli_query($mysqli, $checkQ);
                $count = mysqli_fetch_assoc($result)['c'];
                //echo "Number of songs for student ID $student_id: $count[0]";
          
                    if (($count)==0){
                        $newQ = "SELECT * from users as u WHERE u.Student_ID != $student_id and u.role != 'admin' limit 4";
                        echo "<h2 class='subtitle'>Explore new mates ...</h2>";
                        echo "<div class='user-profile'>";
                        if($resultR = $mysqli->query($newQ)){
                            while ($row = $resultR->fetch_array()) {
                        echo '<div>';
                        echo '<a href="mateProfile.php?friend=' . $row[1] . '">';
                        echo '<img class="user-img" src="' . $row[7] . '" >';
                        echo '</a>';
                        echo '<p class="user-name"> ' . $row[1] . ' </p>';
                        echo '</div>';
                    }
                        }
                        mysqli_free_result($result1);
                    
                    
                    } else {

                        //echo $result;
                        $userQ = "SELECT u.* FROM users AS u 
                        INNER JOIN (SELECT um.Student_ID 
                            FROM user_musicbank AS um 
                            INNER JOIN global_musicbank AS gm ON um.Song_ID = gm.Song_ID 
                            WHERE gm.Artist_ID = $artist 
                            GROUP BY um.Student_ID 
                            ORDER BY COUNT(um.Song_ID) DESC 
                            ) AS max_user 
                        ON u.Student_ID = max_user.Student_ID
                        WHERE u.Student_ID != $student_id and u.role != 'admin';";
                        $result = $mysqli->query($userQ);
                        echo "<h2 class='subtitle'>Mates based on same artist...</h2>";
                        echo "<div class='user-profile'>";
                        while ($row = $result->fetch_array()) {
                            echo '<div>';
                            echo '<a href="mateProfile.php?friend=' . $row[1] . '">';
                            echo '<img class="user-img" src="' . $row[7] . '" >';
                            echo '</a>';
                            echo '<p class="user-name"> ' . $row[1] . ' </p>';
                            echo '</div>';
                        }

                    
                //   echo 'Query error: ' . $mysqli->error;
               
            
               
               
            echo "</div>";
               
            echo "<h2 class='subtitle'>Mates based on same genre...</h2>";
            echo "<div class='user-profile'>";
                
                     $maxgenre = "SELECT count(u.Song_ID) as c, genre.Genre_ID FROM user_musicbank as u 
                     INNER JOIN global_musicbank as g ON u.Song_ID = g.Song_ID 
                     INNER JOIN genre ON g.Genre_ID = genre.Genre_ID
                     WHERE u.Student_ID = $student_id 
                     GROUP BY genre.Genre_ID 
                     ORDER BY c DESC 
                     LIMIT 1";
                 
                 if ($resultg = $mysqli->query($maxgenre)) {
                     while ($rowg= $resultg->fetch_array()) {
                         $genre = $rowg[1];
                         
                     }
                 } else {
                     echo 'Query error: ' . $mysqli->error;
                 }

                 $userg = "SELECT u.* FROM users AS u 
                 INNER JOIN (SELECT um.Student_ID, COUNT(um.Song_ID) as cc
                     FROM user_musicbank AS um 
                     INNER JOIN global_musicbank AS gm ON um.Song_ID = gm.Song_ID 
                     WHERE gm.Genre_ID = $genre 
                     GROUP BY um.Student_ID 
                     ORDER BY cc desc
                     ) AS max_g
                 ON u.Student_ID = max_g.Student_ID
                 WHERE u.Student_ID != $student_id and u.role != 'admin';";
               
               if ($res = $mysqli->query($userg)) {
                   while ($row9 = $res->fetch_array()) {
                       echo '<div>';
                       echo '<a href="mateProfile.php?friend=' . $row9[1] . '">';
                       echo '<img class="user-img" src="' . $row9[7] . '" >';
                       echo '</a>';
                       echo '<p class="user-name"> ' . $row9[1] . ' </p>';
                       echo '</div>';
                   }
               } else {
                   echo 'Query error: ' . $mysqli->error;
               }
                
            echo "</div>";

            echo "<h2 class='subtitle'>Suggested Mates...</h2>";
            echo "<div class='user-profile'>";
                
                    $sugg = "SELECT u.*, count(um.Song_ID) AS cs
                    FROM users AS u
                    LEFT JOIN user_musicbank AS um ON u.Student_ID = um.Student_ID
                    WHERE u.Student_ID != $student_id and u.role != 'admin'
                    GROUP BY u.Student_ID
                    ORDER BY cs DESC;";
                    if ($result2 = $mysqli->query($sugg)) {
                        while ($row2 = $result2->fetch_array()) {
                            echo '<div>';
                            echo '<a href="mateProfile.php?friend=' . $row2[1] . '">';
                            echo '<img src="' . $row2[7] . '" class="user-img">';
                            echo '</a>';
                            echo '<p class="user-name" >' . $row2[1] . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo 'Query error: ' . $mysqli->error;
                    }}
                ?>
            </div>
        </div>
    </body>

    
</html>


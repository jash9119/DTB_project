<?php 
require_once('connect.php'); 
session_start();

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
           
           
            <h1 class="home-title" style="color:#8328ba"><strong>Global Music Bank</strong></h1>
            <!-- search bar -->
            <form action ="searchGlobal.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="Search for songs ... ">
                    <a href="searchGlobal.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
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

                <?php
                 if (isset($_POST['searchbtn'])) {
                    $search = $_POST["searchSong"];
                    
                    if (!empty($search)) {
                        
                        $sql = "SELECT Songs.Song_ID, Songs.Title, A.Name AS Artist, G.Genre_name AS Genre 
                                FROM global_musicbank AS Songs
                                INNER JOIN global_musicbank AS S ON Songs.Song_ID = S.Song_ID
                                INNER JOIN Genre AS G ON S.Genre_ID = G.Genre_ID
                                INNER JOIN Artist AS A ON S.Artist_ID = A.Artist_ID
                                WHERE Songs.Title LIKE '%" . $search . "%'";
        
                        $result = $mysqli->query($sql);
                        
                        // Display results
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
        
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row['Title'] . "</td>
                                        <td>" . $row['Artist'] . "</td>
                                        <td>" . $row['Genre'] . "</td>
                                        <td>
                                            <a href='add.php?songid=" . $row['Song_ID'] . "'><button>+</button></a>
                                        </td>
                                    </tr>";
                            }
        
                            echo "</table>";
                        } else {
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




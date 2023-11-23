<?php 
require_once('../connect.php'); 
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin' || $_SESSION["login"] !== true) {
    header("Location: ../signin.php"); 
} 
?>

<!DOCTYPE html>
<html class="bg-color">
    <head>
        <title>Amusigo</title>
        <link rel="stylesheet" href="../css/adminGlobal.css">
        <link rel="stylesheet" href="../css/default.css">
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
            include('adminSidebar.php');
         ?>

        <div class="global-right">
           
           
            <h1 class="home-title" style="color:#8328ba"><strong>Global Music Bank</strong></h1>

            <!-- Search bar -->
            <!-- <div class="input-container">
                <input class="search" type="text" placeholder="In your music bank ... ">            
                <i class="search-icon fa-solid fa-magnifying-glass"></i>
            </div> -->
            
            <form action ="search.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="In your music bank ... ">
                    <a href="search.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
                    </a>
                </div>
            </form>

            <?php
                if ($_SESSION['role'] == 'admin') {
                    echo "<a href='addSong.php'>
                            <button class='main-btn'> + Add Song</button>
                        </a>
                        <br></br>";
                }
            ?>
            <table>
                <tr>
                    <th>Song</th>
                    <th>Artist</th>
                    <th>Genre</th>
                    <th>Action</th>
                </tr>
                <?php
                    $songQ = "SELECT * 
                            FROM global_musicbank as Songs
                            INNER JOIN global_musicbank as S on Songs.Song_ID = S.Song_ID
                            INNER JOIN Genre as G on S.Genre_ID = G.Genre_ID
                            INNER JOIN Artist as A on S.Artist_ID = A.Artist_ID";
                    if ($result = $mysqli->query($songQ)) {
                        while ($row = $result->fetch_array()) {
                            echo "<tr>
                                    <td> " . $row['Title'] . "</td>
                                    <td>" . $row['Name'] . "</td>
                                    <td>" . $row['Genre_name'] . "</td>";

                            if ($_SESSION['role'] == 'admin') {
                                echo "<td>
                                        <a href='adminEditSongInfo.php?songid=" . $row[0] . "'><button class='edit-btn'>Edit</button></a>
                                        <a href='adminDelete.php?songid=" . $row['Song_ID'] . "'><button class='delete-btn'>Delete</button></a>
                                    </td>";
                            }else {
                                echo "<td>
                                        <a href='../add.php?songid=" . $row['Song_ID'] . "'><button>+</button></a>
                                    </td>";
                            }

                            echo "</tr>";
                        }
                    }
?>

            </table>

        </div>
    </body>

    
</html>


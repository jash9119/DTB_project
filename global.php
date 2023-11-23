<?php 
require_once('connect.php'); 
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["login"] !== true) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html class="bg-color">
    <head>
        <title>Amusigo</title>
        <link rel="stylesheet" href="css\adminGlobal.css">
        <link rel="stylesheet" href="css\default.css">

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
           
           
            <h1 class="home-title" style="color:#8328ba">Global Music Bank</h1>

            <!-- search bar -->
            <form action ="searchGlobal.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="Search for songs ... ">
                    <a href="searchGlobal.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
                    </a>
                </div>
            </form>
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
        INNER JOIN Genre as G on Songs.Genre_ID = G.Genre_ID
        INNER JOIN Artist as A on Songs.Artist_ID = A.Artist_ID";
if ($result = $mysqli->query($songQ)) {
    while ($row = $result->fetch_array()) {
        echo "<tr>
                <td> " . $row['Title'] . "</td>
                <td>" . $row['Name'] . "</td>
                <td>" . $row['Genre_name'] . "</td>
                <td>
                    <a href='add.php?songid=" . $row['Song_ID'] . "'><button class='add-btn' style='width:50px; background-color:#D177FC !important'>+</button></a>
                </td>
                </tr>";
    }
}
?>
            </table>

        </div>
    </body>

    
</html>

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
        
        <link rel="stylesheet" href="../css/adminArtist.css">
        <link rel="stylesheet" href="../css/default.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    </head>
    <body id="global">

        
        <?php include('adminSidebar.php'); ?>

        <div class="global-right">
           
           
            <h1 class="home-title" style="color:#8328ba">Artist Lists</h1>

            <!-- search bar -->
            <form action ="searchArtist.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="Search for artist ... ">
                    <a href="searchArtist.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
                    </a>
                </div>
            </form>

            <a href='addArtist.php'>
                <button class="main-btn"> + Add Artists</button>
            </a>
            <br></br>
            <table>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>BirthDate</th>
                    <th>Age</th>
                    <th>Bio</th>
                    <th>Website</th>
                    <th>Action</th>
                </tr>
                <?php
                    $songQ = "SELECT * FROM artist";
                    if($result=$mysqli->query($songQ)){
                        while($row=$result->fetch_array()){
                            echo "<tr>
                                <td><img class='user-pic' src = ". $row['Image_Url']. "></img></td>
                                <td> " . $row['Name']."</td>
                                
                                <td> " . $row['Country']."</td>
                               
                                <td>" . $row['Birth_Date']."</td>
                                <td> " . $row['Age']."</td>
                                <td class='bio-txt'>" . $row['Bio']."</td>
                                <td>" . $row['Website']."</td>
                                <td>
                                    <a href='adminEditArtist.php?artistid=" .$row['Artist_ID']. "'><button class='edit-btn'>Edit</button></a>
                                    <a href='adminDelete.php?artistid=" . $row[0] . "'><button class='delete-btn'>Delete</button></a>
                                </td>
                            </tr>";
                        }
                    }
            
                ?>
            </table>

        </div>
    </body>

    
</html>


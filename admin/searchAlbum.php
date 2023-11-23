<?php 
require_once('../connect.php'); 
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin' || $_SESSION["login"] !== true) {
    header("Location: ../signin.php"); 
} 

//$search= $_SESSION['search'];
?>

<!DOCTYPE html>
<html class="bg-color">
    <head>
        <title>Amusigo</title>
        <link rel="stylesheet" href="../css/adminArtist.css">

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
            <!-- search bar -->
            <form action ="searchAlbum.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="Search for artist ... ">
                    <a href="searchAlbum.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
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
                        
                        $sql = "SELECT album.*, artist.Name as ArtistName
                        FROM album join artist on album.Artist_ID = artist.Artist_ID where Album_Name like '%$search%'";
        
                        $result = $mysqli->query($sql);
                        
                        // Display results
                        if ($result->num_rows > 0) {
                            echo "<strong>Album Found !";
                            echo "<br></br>";
                            echo "<table>
                            <tr>
                                <th>Album Name</th>
                                <th>Artist</th>
                                <th>Action</th>
                            </tr>
                            ";
                            while ($row = $result->fetch_assoc()){
                                echo "<tr>
                                <td>" . $row['Album_Name'] . "</td>
                                <td>" . $row['ArtistName'] . "</td>
                    
                                <td>
                                    <a href='adminEditAlbum.php?albumid=" .$row['Album_ID']. "'><button class='edit-btn'>Edit</button></a>
                                    <a href='adminDelete.php?albumid=" . $row['Album_ID'] . "'><button class='delete-btn'>Delete</button></a>
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




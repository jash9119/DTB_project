<?php require_once('../connect.php'); 
session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $title = $_POST['title'];
        $artist = $_POST['artist'];
        $genre = $_POST['genre'];
        $reldate = $_POST['reldate'];
        $mysqlFormattedDate = date('Y-m-d H:i:s', strtotime($reldate));
        $album = $_POST['album'];

    $artistIDQ = "SELECT Artist_ID from artist where Name = '$artist';";
    $resArtist = mysqli_query($mysqli, $artistIDQ );
    $artist_ID = mysqli_fetch_row($resArtist );

    $genreIDQ = "SELECT Genre_ID from genre where Genre_name = '$genre';";
    $resGenre = mysqli_query($mysqli, $genreIDQ );
    $genre_ID = mysqli_fetch_row($resGenre );

    echo $albumIDQ = "SELECT Album_ID from album where Album_Name = '$album' and Artist_ID = '$artist_ID[0]' ";
    $resAlbum = mysqli_query($mysqli, $albumIDQ );
    echo $album_ID = mysqli_fetch_row($resAlbum );

                            // Use prepared statement to prevent SQL injection
                            $q = "INSERT INTO global_musicbank (Title, Artist_ID, Genre_ID, Release_Date, Album_ID) VALUES (?,?,?,?,?)";
                            //$result = mysqli_query($q);
                            //$row = mysqli_fetch_array($result);
                            $stmt = $mysqli->prepare($q);
    
                             // Bind parameters
                            $stmt->bind_param("siisi", $title, $artist_ID[0], $genre_ID[0], $reldate, $album_ID[0]);
    
                            // // Execute the query
                            $result = $stmt->execute();
    
                            // Check for success
                            if ($result) {
                                echo "Insert successful!";
                                header("Location:adminGlobal.php");
                            } else {
                                echo "Insert failed: " . $stmt->error;
                            }
    
        
                             $stmt->close();
            


}

    
    

// }
?>

<!DOCTYPE html>
<html class="bg-color">
<head>
    <title>Amusigo</title>
    <link href = "https://fonts.googleapis.com/css2?family=Lato&display=swap" rel = "stylesheet">
    
    <link rel="stylesheet" href="../css/addSong.css">
    <link rel="stylesheet" href="../css/default.css">
    
    <link
  
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body id="admin">
<?php include('adminSidebar.php'); ?>
 
        
    <div class = "global-right">
        
        <br></br>
        <div class="container">
            <div class="form-left"> 
                <h1 class="edit-title" ><strong>Add New Song</h1>
                <form action= "addSong.php" method="post">
                    <div class="input-label">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="Song title">
                    </div>

                    <div class="dropdown">
                        <label for="artist">Artist</label>
                        <select name="artist">
                        <?php
                        $artistQ = "SELECT Name FROM artist"; 
                        if ($result = $mysqli->query($artistQ)) {
                            echo "<option value='' selected disabled>Select an artist</option>";
                            while ($row = $result->fetch_array()) {
                                echo "<option value='" . $row['Name'] . "'>" . $row['Name'] . "</option>";
                            }
                        }
                        ?>                
                        </select>
                    </div>

                    <div class = "dropdown">
                        <label for="genre">Genre</label>
                        <select name="genre">
                        <?php
                            $genreQ = "SELECT * FROM genre"; 
                            if ($result = $mysqli->query($genreQ)) {
                                echo "<option value='' selected disabled>Select a genre</option>";
                                while ($row = $result->fetch_array()) {
                                echo "<option value='" . $row['Genre_name'] . "'>" . $row['Genre_name'] . "</option>";
                                }
                            }
                        ?>                
                        </select>
                    </div>
            
                    <div class="input-label">
                        <label for="reldate">Released Date</label>
                        <input type="date" name="reldate" placeholder="released date">
                    </div>

                    <div class="dropdown">
                        <label for="album">Album</label>
                        <select name="album">
                        <?php
                        $albumQ = "SELECT * FROM album"; 
                        if ($result = $mysqli->query($albumQ)) {
                            echo "<option value='' selected disabled>Select album</option>";
                            while ($row = $result->fetch_array()) {
                                echo "<option value='" . $row['Album_Name'] . "'>" . $row['Album_Name'] . "</option>";
                        }
                    }
                        ?>                
                        </select>
                    </div>
                    
                    <br></br>
                    <div class="forbtn">
                        <button id="add-btn" class="add-btn" name= "addsong" type="submit">Add Song</button>
                    </div>
                    
                </form>  

            </div>

        </div>
    </div>
</body>

</html>
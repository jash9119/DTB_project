<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>

<?php
require_once('../connect.php');
session_start();
    $id = $_GET['songid'];
    $updateQ = "SELECT global_musicbank.*, artist.Name, genre.Genre_name 
    FROM global_musicbank join artist on artist.Artist_ID = global_musicbank.Artist_ID 
    join genre on genre.Genre_ID =  global_musicbank.Genre_ID
    where global_musicbank.Song_ID = $id";

    $resUpdate = mysqli_query($mysqli, $updateQ);
    $row = mysqli_fetch_array($resUpdate);

    if ($row) {
        $title = $row['Title'];
        $artist_Name = $row['Name'];
        $genre = $row['Genre_name'];
    } else {
    // Handle case where the song ID isn't found or there's no data retrieved
        echo "Song not found or data retrieval issue.";
         exit();
    }   
    if (isset($_POST['submit'])) {

        $title = $_POST["title"];
        $artist_Name = $_POST["artist"];
        $genre = $_POST["genre"];
    

        $artistq = "SELECT Artist_ID FROM `artist` WHERE Name = '$artist_Name';";
        $resArtist = mysqli_query($mysqli, $artistq);
        $artistData = mysqli_fetch_assoc($resArtist);
        $artist_ID = $artistData['Artist_ID'];

        $genreIDQ = "SELECT Genre_ID from genre where Genre_name = '$genre';";
        $resGenre = mysqli_query($mysqli, $genreIDQ );
        $genreData = mysqli_fetch_assoc($resGenre);
        $genre_ID = $genreData['Genre_ID'];
        //$artistID = mysqli_fetch_row($resUpdate)[0];

        $sql = "UPDATE `global_musicbank` SET Title='$title', Artist_ID=$artist_ID, Genre_ID=$genre_ID where Song_ID = $id";
        $result = mysqli_query($mysqli, $sql);

        if ($result) {
            phpAlert("Updated Song Sucessfully!");
            echo '<script>
                      window.location.href = "adminGlobal.php";
                   </script>';
            exit();
        } else {
            echo "Update failed: " . mysqli_error($mysqli);
        }
        
    } 
    else{
        echo "cant get songid";
    }



    //else {
    //     echo "Error fetching artist: " . mysqli_error($mysqli);
    // }
//}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Amusigo</title>
    <link rel="stylesheet" href="../css/addAlbum.css">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer"/>
</head>

<body id="admin">
<?php include('adminSidebar.php'); ?>
<div class = "global-right">
    
    <div class="container-main">
        <form method="post">
        <h1 class="home-title">Edit Song</h1>
                    <div class="input-label">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="Song title" value="<?php echo isset($title) ? $title : ''; ?>">
                    </div>
                        
                    <div class="dropdown">
            <label for="artist">Artist</label>
            <select name="artist">
                <?php
                $artistQ = "SELECT Name FROM artist";
                if ($result = $mysqli->query($artistQ)) {
                    echo "<option value='' selected disabled>Select an artist</option>";

                    while ($row = $result->fetch_array()) {
                        $selected = ($row['Name'] == $artist_Name) ? 'selected' : '';
                        echo "<option value='" . $row['Name'] . "' $selected>" . $row['Name'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
                    <div class = "dropdown">
                        <label for="genre">Genre</label>
                        <select name="genre">
                        <?php
                            $genreQ = "SELECT Genre_name FROM genre"; 
                            if ($result = $mysqli->query($genreQ)) {
                                echo "<option value='' selected disabled>Select a genre</option>";
                                while ($row = $result->fetch_array()) {
                                    $selected = ($row['Genre_name'] == $genre) ? 'selected' : '';
                                echo "<option value='" . $row['Genre_name'] . "'$selected>" . $row['Genre_name'] . "</option>";
                                }
                            }
                        ?>                
                        </select>
                    </div>
        <br></br>
        <div class="forbtn">
             <button id = "btn-add" class="add-btn" type="submit" name="submit">Update</button>
        </div>
       

    </form>
</div>

</div>

</body>
</html>

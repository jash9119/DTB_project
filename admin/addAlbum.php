<?php
require_once('../connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $artist_Name = $_POST["artist"];

    $sql = "SELECT Artist_ID FROM `artist` WHERE Name = '$artist_Name';";
    $res = mysqli_query($mysqli, $sql);
    $artistID = mysqli_fetch_row($res);

    $q = "INSERT INTO album (Album_Name, Artist_ID) VALUES ('$name', $artistID[0])";
    $result = mysqli_query($mysqli, $q);

    if ($result) {
        echo "Insert successful!";
        header("Location: adminAlbum.php");
    } else {
        echo "Insert failed: " . mysqli_error($mysqli);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Amusigo</title>
<link href = "https://fonts.googleapis.com/css2?family=Lato&display=swap" rel = "stylesheet">
<link rel="stylesheet" href="../css/addAlbum.css">
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
<div class="global-right">
    
    <br></br>
    <div class="container-main">
        <form action="addAlbum.php" method="post">
        <h1 class="edit-title">Add New Album</h1>
            <div class="input-label">
                <label>Album Name</label>
                <input type="text" name="name" placeholder="Album name">
            </div>

            <div>
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
            <br></br>


           <div class="forbtn">
            <button id = "add-btn" class="add-btn" type="submit">Add</button>
           </div>
            
          
        </form>
    </div>
</div>
    

</body>

</html>
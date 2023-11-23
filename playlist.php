<?php 
require_once('connect.php'); 

session_start();

if (!isset($_SESSION["username"]) || $_SESSION["login"] !== true) {
    header("Location: signin.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Amusigo</title>
<link rel="stylesheet" href="css/playlist.css">
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body id="playlist">
<?php $username = $_SESSION["username"]; ?>
<?php include('sidebar.php'); ?>
    <div class="playlist-right">
        
        <div class="top-container">
            <h1 style="color:#8328BA"><?php echo $username ?>'s Playlist</h1>

            <!-- Search bar -->
            <div class="input-container-1">
                <input class="search" type="text" placeholder="In your music bank ... ">            
                <i class="search-icon fa-solid fa-magnifying-glass"></i>
            </div>

            <!-- profile button -->
            <?php include('profile.php'); ?>
           
        </div>

        <!-- Search bar -->
        <div class="input-container-2">
                <input class="search" type="text" placeholder="In your music bank ... ">            
                <i class="search-icon fa-solid fa-magnifying-glass"></i>
        </div>

       
    </table>
        </div>

        

    </div>


</body>

</html>
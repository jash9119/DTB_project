<?php 
require_once('../connect.php'); 
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin' || $_SESSION["login"] !== true) {
    header("Location: ../signin.php"); 
} 
$uname = $_SESSION['username'];
$q = "SELECT * FROM users where Username='$uname';";
$result = $mysqli->query($q);
$row = mysqli_fetch_row($result);

$id = $row[0];
$email = $row[2];
$name = $row[6];
$line= $row[3];
$role = $row[8];
?>

<!DOCTYPE html>
<html class="bg-color">
    <head>
        <title>Amusigo</title>
        <link href = "https://fonts.googleapis.com/css2?family=Lato&display=swap" rel = "stylesheet">
        <link rel="stylesheet" href="../css/adminDashboard.css">
        <link rel="stylesheet" href="../css/default.css">
      
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600&family=Playfair+Display:ital,wght@1,400;1,500;1,800&family=Quicksand:wght@300;500;600&family=Roboto+Slab&family=Shantell+Sans&family=Space+Grotesk&display=swap" rel="stylesheet">
        
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    </head>
    <body id="dashboard">
        <?php include('adminSidebar.php'); ?>

        <div class="dashboard-right">
            <h1 class="home-title" style="color:#8328ba">Admin Dashboard</h1>
            <div class="dashboard-list">
                <a href="adminGlobal.php">
                    <div class="list-card">
                        <h2>Global Music Bank</h2>
                        <?php
                            $q= "SELECT COUNT(*) as count from global_musicbank";
                            $result = $mysqli->query($q);
                            $row=$result->fetch_array();
                            echo "<p>" . $row['count'] ." songs</p>";
                        ?>
                        
                    </div>
                </a>

                <a href="adminUser.php">
                    <div class="list-card">
                        <h2>Users List</h2>
                        <?php
                            $q= "SELECT COUNT(*) as count from users";
                            $result = $mysqli->query($q);
                            $row=$result->fetch_array();
                            echo "<p>" . $row['count'] ." users</p>";
                        ?>
                    </div>
                </a>

                <a href="adminArtist.php">
                    <div class="list-card">
                        <h2>Artist List</h2>
                        <?php
                            $q= "SELECT COUNT(*) as count from artist";
                            $result = $mysqli->query($q);
                            $row=$result->fetch_array();
                            echo "<p>" . $row['count'] ." artists</p>";
                        ?>
                    </div>
                </a>

                <a href="adminAlbum.php">
                    <div class="list-card">
                        <h2>Album List</h2>
                        <?php
                            $q= "SELECT COUNT(*) as count from album";
                            $result = $mysqli->query($q);
                            $row=$result->fetch_array();
                            echo "<p>" . $row['count'] ." albums</p>";
                        ?>
                    </div>
                </a>

                <a href="adminGenre.php">
                    <div class="list-card">
                        <h2>Genre List</h2>
                        <?php
                            $q= "SELECT COUNT(*) as count from genre";
                            $result = $mysqli->query($q);
                            $row=$result->fetch_array();
                            echo "<p>" . $row['count'] ." genres</p>";
                        ?>
                    </div>
                </a>
                
            </div>
            <br/>
            <br/>
            <hr/>
            <div>
                <div class="profile-top">
                    <h2 class="sub-title">Admin Profile</h2>
                    <!-- <a href="adminProfileEdit.php"><button class="edit-btn">Edit Profile</button></a> -->
                    <?php
                    echo "<a href='adminProfileEdit.php?userid=$id'><button class='main-btn'>Edit Profile</button></a>";
                    ?>
                    
                </div>
                <div class="profile-body">
                    <div class="body-label">
                        <p class="label">Admin ID: </p>
                        <p class="label">Full Name: </p>
                        <p class="label">Email: </p>
                        <p class="label">Line ID: </p>
                        <p class="label">Role: </p>
                    </div>
                    
                    <div class="body-info">
                        <p ><?php echo $id;?></p>
                        <p ><?php echo $name;?></p>
                        <p ><?php echo $email;?></p>
                        <p ><?php echo $line;?></p>
                        <p ><?php echo $role;?></p>
                    </div>
                </div>
                
            </div>
        </div>
    </body>

    
</html>


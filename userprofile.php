<?php require_once('connect.php');
session_start(); 
$username = $_SESSION["username"]; 
?>

<?php
        $profileimg = "SELECT * FROM users WHERE Username = '$username'";
        $res = $mysqli->query($profileimg);
        if ($res !== false && $res->num_rows) {
            while ($row = $res->fetch_array()) {
                $stdid = $row[0];
               $profile = $row[7];
            }
        } else {
            echo "Error in query execution: " . $mysqli->error;
        }?>

<!DOCTYPE html>
<html>
<head>
<title>Amusigo</title>
<link rel="stylesheet" href="css/userprofile.css">
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
   

</head>

<body id="userprofile">
    <?php 
    include('sidebar.php')?>
    
    <div class="userprofile-right">
        <div  class="top-container" style="display:flex; align-content:center; margin: 2rem;  ">
            <h1 style="color:#8328BA">Your Account</h1>
            <!-- <?php echo $stdid?> -->
            <!-- <a href='edituser.php?userid=<?php echo $stdid?>'><button class="btn-edit">Edit profile</button></a> -->
            <a href='edituser.php'><button class="btn-edit">Edit profile</button></a>
        </div>
        <img style="border-radius: 50%; width: 250px; margin-left:3.5rem" class="profile-img" src=<?php echo $profile?>>
        <div id="container">
            <div id="personal-container">
                <h2>Personal Information</h2>
                <?php
        $userprofile = "SELECT * FROM users WHERE Username = '$username'";
        $result1 = $mysqli->query($userprofile);
        if ($result1 !== false && $result1->num_rows) {
            while ($row1 = $result1->fetch_array()) {
               $student_id = $row1[0];
               $uname = $row1[1];
               $email = $row1[2];
               $line = $row1[3];
               $faculty = $row1[4];
               $year = $row1[5];
               $name = $row1[6];
               $newname = explode(" ", $name);
            }
        } else {
            echo "Error in query execution: " . $mysqli->error;
        }?>
                    <label><b>Username: </b><?php echo $uname; ?></label>
                    
                    <label><b>First name: </b><?php echo $newname[0]; ?></label>
 
                    <label><b>Last name: </b><?php echo $newname[1]; ?></label>

                    <label><b>Email: </b><?php echo $email; ?></label>
      
               
            </div>
            <div id="school-container">
                <h2>School Information</h2>
                <label><b>Student ID: </b><?php echo $student_id; ?></label>
                <label><b>Faculty: </b><?php echo $faculty; ?></label>
                <label><b>Current Study Year: </b><?php echo $year; ?></label>
                <label><b>Line ID: </b><?php echo $line; ?></label>
            </div>
        </div>
            
    </div>



</body>

</html>
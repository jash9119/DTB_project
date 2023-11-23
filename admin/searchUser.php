<?php 
require_once('../connect.php'); 
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["login"] !== true) {
    header("Location: signin.php");
    exit();
}
$username = $_SESSION["username"];
//$search= $_SESSION['search'];
?>

<!DOCTYPE html>
<html class="bg-color">
    <head>
        <title>Amusigo</title>
        <link rel="stylesheet" href="../css/searchGlobal.css">

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
           
           
            <h1 class="home-title" style="color:#8328ba"><strong>Users List</strong></h1>
            <!-- search bar -->
            <form action ="searchUser.php"  method="POST">
                <div class="input-container">
                    <input type="text" name="searchSong" placeholder="Search for users ... ">
                    <a href="searchUser.php"><button type="submit" name ="searchbtn"><i class="search-icon fa-solid fa-magnifying-glass"></i></button>
                    </a>
                </div>
            </form>

            <!-- <?php
                if ($_SESSION['role'] == 'admin') {
                    echo "<a href='addUser.php'>
                            <button class='add-btn'> + Add User</button>
                        </a>
                        <br></br>";
                }
                
            ?> -->

<!-- for user mates -->
                <?php
                 if (isset($_POST['searchbtn'])) {
                    $search = $_POST["searchSong"];
                    
                    if (!empty($search)) {
                        
                        $stdid = "SELECT * FROM users WHERE Username like '%$search%'";
                        $result1 = $mysqli->query($stdid);
                        
                        if (($result1 !== false)&&($result1->num_rows > 0)) {
                            while ($row1 = $result1->fetch_array()) {
                                //echo "<h1> this is my id " . $row1[0] . "</h1>";
                                $student_id = $row1[0];
                                
                            
                                echo "<strong>User Found !";
                                echo "<br></br>";
                                    echo "<table>
                                            <tr>
                                               <th>Username</th>
                                                <th>Action</th>
                                            </tr>";
                                    
                                    echo "<tr>
                                        <td> " . $row1[1] ."</td>
                                        <td>
                                            <a href='delete.php?user_id=" . $student_id . "'><button class='delete-btn' 
                                            style='font-size: medium;font-weight: bold;'> - </button></a>
                                        </td>
                                    </tr>";
                                    }
                                echo"</table>";
                                }
                            else {
                                echo "<strong>No user found";
                                echo "<br></br>";   
                        }
                
        
                 } else {
                        echo "<strong>No search term provided.";
                    }
                }
            
                ?>

        </div>
    </body>

    
</html>




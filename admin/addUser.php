<?php 
require_once('../connect.php'); 
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin' || $_SESSION["login"] !== true) {
    header("Location: ../signin.php"); 
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
    $username = $_POST["username"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $name = "$fname $lname";
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
    $stdid = $_POST["stdid"];
    $faculty = $_POST["faculty"];
    $year = $_POST["year"];
    $line = $_POST["line"];
    $profile = $_POST["profile"];
    $role = $_POST["role"];

    $hashedPassword = password_hash($passwd, PASSWORD_DEFAULT);
    $duplicate = "SELECT * from users WHERE Username = '$username' OR Email = '$email' ";
    $check_dup = $mysqli-> query($duplicate);
    if(mysqli_num_rows($check_dup)>0){
        echo "username already exist";
    
    }else {
        $insert="INSERT INTO users(Student_ID,Username,Email,Line_ID,Faculty,Year,Name,profile_url,role) 
            VALUES($stdid,'$username','$email','$line','$faculty','$year','$name','$profile','$role')";
        $result=$mysqli->query($insert);

        if(!$result){
            echo "Insert failed. Error: ".$mysqli->error ;
            return false;
        }
        else{
            $insertLogin = "Insert into login(Username, Password) values('$username','$hashedPassword')";
            $qLogin = $mysqli->query($insertLogin);
            echo '<script>alert("Added user successfully!");
            window.location.href = "adminUser.php";</script>';
        }
    }  
}

?>

<!DOCTYPE html>
<html class="bg-color">
    <head>
        <title>Amusigo</title>
        <link href = "https://fonts.googleapis.com/css2?family=Lato&display=swap" rel = "stylesheet">
        <link rel="stylesheet" href="../css/addUser.css">
        <link rel="stylesheet" href="../css/default.css">
        
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>
    <body id="user">

        
        <?php include('adminSidebar.php'); ?>

        <div class="user-right">
            <div class="titles">
                <h1 class="edit-title">Add User Account</h1>
            
            </div>
            
        
            
            
        <div class="container" >
            <form action="addUser.php" method="post" >
                <div class="form1">
                    <h1 class="subtitle" style="font-size:25px">Personal Information</h1>
                    <!-- <p class="subtitle">Please fill in the informaiton correctly</p> -->
                    <div class="input-label">
                        <label class="required">Username</label>
                        <input type="text" name="username" required>
                    </div>

                    <div class="input-label">
                        <label class="required" for="fname">First name</label>
                        <input type="text" name="fname" required>
                    </div>

                    <div class="input-label">
                        <label class="required" for="lname">Last name</label>
                        <input type="text" name="lname" required>
                    </div>

                    <div class="input-label">
                        <label class="required" for="email">Email</label>
                        <input type="email" name="email" required>
                    </div>
                    
                    <div class="input-label">
                        <label class="required">Password</label>
                        <input type="password" name="passwd" required>
                    </div>

                    <div class="input-label">
                        <label class="required">Role</label>
                        <select name="role" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                         </select>          
                    </div>
                </div>


                <div class = "form2">
                    <h1 class="subtitle" style="font-size:25px">School Information</h1>
                    <div  class="input-label">
                        <label class="required">Student ID</label>
                        <input type="text" name="stdid" required>
                    </div>

                    <div class="input-label">
                        <label class="required">Faculty</label>
                        <input type="text" name="faculty" required>
                    </div>

                    <div class="year-container">
                        <label class="required">Current Study Year</label>
                        <select name="year">
                            <option value="" disabled selected>select your year</option>
                            <option value="Bachelor-1">Bachelor-1</option>
                            <option value="Bachelor-2">Bachelor-2</option>
                            <option value="Bachelor-3">Bachelor-3</option>
                            <option value="Bachelor-4">Bachelor-4</option>
                            <option value="Master-1">Master-1</option>
                            <option value="Master-2">Master-2</option>
                         </select>
                    </div>
                   
                    <div class="input-label">
                        <label>Line ID</label>
                        <input type="text" name="line">
                    </div>   
                    
                    <div class="input-label">
                        <label>Profile URL</label>
                        <input type="text" name="profile">
                    </div>
                </div>
                    
               
            
                <div class="btn-container">
                    <button type="submit" id = "add-btn" class="add-btn">Add User</button>
                </div>
               
        </form>
        <div>
      
        </div>
       
        </div>
        </div>
        </div>
        
        
    </body>

    
</html>


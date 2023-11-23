<?php 
require_once('connect.php');

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST["username"];
        $pass = $_POST["passwd"];

        $q="SELECT login.*, users.role FROM login 
        join users on login.Username = users.Username
        WHERE login.Username = '$username';";
        $result=$mysqli->query($q);
       
        if(mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_array($result);
            $hashedPW = $row['Password'];
            
            if (password_verify($pass,$hashedPW)){
                $_SESSION["login"] = true;
                $_SESSION['username'] = $row["Username"];

                //check user's role
                $userRole = $row['role'];

                if($userRole == 'admin'){
                    $_SESSION['role'] = 'admin';
                    header("Location: admin/adminDashboard.php");
                    exit;
                }else {
                    $_SESSION['role'] = 'user'; 
                    header("Location: home.php");
                    exit;
                }
        
            }else {
                if ($pass == $row['Password']){
                    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
                    $updateQuery = "UPDATE login SET Password = '$hashedPassword' WHERE Username = '$username';";
                    $mysqli->query($updateQuery);

                    $_SESSION["login"] = true;
                    $_SESSION["id"] = $row["Username"];
                    header("Location: home.php");
                    exit;
                }else {
                    echo "<script> alert('Incorrect password'); </script>";
                }
            }
        }
        else{
            echo "<script> alert('Username is not correct'); </script>";
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
<title>Amusigo</title>
<link rel="stylesheet" href="css/signin.css">
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body id="music-bank">
<?php include('navbar.php') ?>
    <div class="container">
        <div>
            <form action="signin.php" method="post" class="signin-form">
                <h1 style="text-align:center; margin-block:2rem 3rem">Login</h1>
                <div class="input-form">
                    <label>Username</label>
                    <input type="text" name="username" placeholder=" Enter your username">
                </div>
                
                <div class="input-form">
                    <label>Password</label>
                    <input type="password" name="passwd" placeholder=" Enter your password">
                </div>
            
                <button class="btn-submit" type="submit" name="submit">Login</button>
                <p style="text-align:center">Dont have an account? <a href="signup.php">Sign up</a></p>
            </form>
    </div>
    <div class="container-right">
        <h1 class="welcome-text">Welcome!</h1>
        <img class="singin-img" src="image/signin.svg"/>
    </div>

    </div>

</body>

</html>


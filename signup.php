<?php 
require_once('connect.php'); 
?>

<!DOCTYPE html>
<html>
<head>

<title>Amusigo</title>
<link rel="stylesheet" href="css/signup.css">
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body id="signup">
    <?php include('navbar.php')?>
 
    <div class="main">
        <h1 class="title1">Create your account</h1>
        <div class="container" >
            <form action="signup.php" method="post" >
                <div class="form1">
                    <h1 class="subtitle">Personal Information</h1>
                    <!-- <p class="subtitle">Please fill in the informaiton correctly</p> -->
                    <div class="input-container">
                        <label class="required">Username</label>
                        <input type="text" name="username" required>
                    </div>

                    <div class="input-container">
                        <label class="required">First name</label>
                        <input type="text" name="fname" required>
                    </div>

                    <div class="input-container">
                        <label class="required">Last name</label>
                        <input type="text" name="lname" required>
                    </div>

                    <div class="input-container">
                        <label class="required">Email</label>
                        <input type="email" name="email" required>
                    </div>
                    
                    <div class="input-container">
                        <label class="required">Password</label>
                        <input type="password" name="passwd" required>
                    </div>
                </div>

                <div class="form2">
                    <h1 class="subtitle">School Information</h1>
                    <div  class="input-container">
                        <label class="required">Student ID</label>
                        <input type="text" name="stdid" required>
                    </div>

                    <div class="input-container">
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
                    <br></br>
                    <div class="input-container">
                        <label>Line ID</label>
                        <input type="text" name="line">
                    </div>   
                    
                    <div class="input-container">
                        <label>Profile URL</label>
                        <input type="text" name="profile">
                    </div>
                </div>
                
                <div class="btn-container">
                    <button type="submit"  name="reg" class="btn-register">Register</button>
                    <p>Already have an account? <a href="signin.php">Login</a></p>
                </div>
                </form>
        </div>

        
    </div>
</body>

</html>

<?php
if (isset($_POST['reg'])) {
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

    $hashedPassword = password_hash($passwd, PASSWORD_DEFAULT);
    $duplicate = "SELECT * from users WHERE Username = '$username' OR Email = '$email' ";
    $check_dup = $mysqli-> query($duplicate);
    if(mysqli_num_rows($check_dup)>0){
        echo "<script>
            Swal.fire({
               icon: 'error',
               title: 'Username or Email is already exist',
               showConfirmButton: false,
               timer: 1500
            });
         </script>";
    }else {
        $insert="INSERT INTO users(Student_ID,Username,Email,Line_ID,Faculty,Year,Name,profile_url) 
            VALUES($stdid,'$username','$email','$line','$faculty','$year','$name','$profile')";
        $result=$mysqli->query($insert);

        if(!$result){
            echo "Insert failed. Error: ".$mysqli->error ;
            return false;
        }
        else{
            $insertLogin = "Insert into login(Username, Password) values('$username','$hashedPassword')";
            $qLogin = $mysqli->query($insertLogin);

            echo "<script>
         Swal.fire({
            icon: 'success',
            title: 'Register successfully',
            showConfirmButton: false,
            timer: 3000
         }).then(function() {
            window.location.href = 'home.php'; 
         });
      </script>";
        }
    }  
}
?>



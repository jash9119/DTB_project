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
    <!-- <?php include('sidebar.php')?> -->
    <?php session_start();
        $uname= $_SESSION['username'];?>
    <div class="main">
        <h1 class="title1">Edit your profile</h1>
        <div class="container" >
            <form action="mateProfile1.php" method="post" >
                <div class="form1">
                    <h1 class="subtitle">Personal Information</h1>
                    <!-- <p class="subtitle">Please fill in the informaiton correctly</p> -->
                    <div class="input-container">
                        <label class="required">Username</label>
                        <!-- <input type="text" name="username" required> -->
                        <input type="text" name="username" placeholder="Username" value="<?php echo $uname; ?>">
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
                    <button type="submit"  name="confirm" class="btn-register">Confirm</button>
                </div>
            </form>
        </div>

        
    </div>
</body>

</html>

<?php
if (isset($_POST['confirm'])) {
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
        if($username==$uname){
        $update="UPDATE users SET Student_ID=$stdid,Email='$email',Line_ID='$line',Faculty='$faculty',Year='$year',Name='$name',profile_url='$profile' 
        WHERE Username='$uname'";
        $result=$mysqli->query($update);


        if(!$result){
            echo "Update failed. Error: ".$mysqli->error ;
            return false;
        }
        else{
            $updatelogin="UPDATE login SET Password='$hashedPassword' 
        WHERE Username='$uname'";
        $result1=$mysqli->query($updatelogin);
            echo "<script>
         Swal.fire({
            icon: 'success',
            title: 'Update successfully',
            showConfirmButton: false,
            timer: 3000
         }).then(function() {
            window.location.href = 'userprofile.php'; 
         });
      </script>";
        }
    }else{
        echo "<script>
        Swal.fire({
           icon: 'success',
           title: 'Cannot Change Username',
           showConfirmButton: false,
           timer: 3000
        }).then(function() {
           window.location.href = 'userprofile.php'; 
        });
     </script>";
    }
    }
?>
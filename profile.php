<?php require_once('connect.php'); ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/userprofile.css">
    <style>
        /* .profile-btn {
            
            background: linear-gradient(
                90.11deg,
                rgba(200, 83, 219, 0.18) 32.29166567325592%,
                rgba(200, 83, 219, 0.1) 100%
            );
            border-radius: 25px;
            border-style: solid;
            border-color: #a654d8;
            border-width: 2px;
            width: 150px;
            height: 40px;
           
            font: 600 16px "NotoSans-SemiBold", sans-serif;
            color: #a654d8;
           
            font-size:1.2rem;
        } */
        

/* CSS */
.profile-btn {
    margin: 25px;
    float: right;
    position: relative;
    background-color: #8f55b2;
    border-radius: 100px;
    box-shadow: rgb(106 26 154) 3px 3px 6px 0px inset, #b88cd2 -3px -3px 6px 1px inset;
    /* box-shadow: rgba(202, 158, 227, 0.5) 0 -25px 18px -14px inset, rgba(202, 158, 227, 0.1) 0 1px 2px, rgba(202, 158, 227, 0.2) 0 2px 4px, rgba(202, 158, 227, 0.4) 0 4px 8px, rgba(202, 158, 227, 0.8) 0 8px 16px; */
    font-family: "Quicksand", sans-serif;
    color: white;
    width: 120px;
    cursor: pointer;
    display: inline-block;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    transition: all 250ms;
    border: 0;
    font-size: 16px;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
}

.profile-btn:hover {
  box-shadow: rgba(202, 158, 227, 0.5) 0 -25px 18px -14px inset,rgba(202, 158, 227, 0.5) 0 1px 2px,rgba(202, 158, 227, 0.5) 0 2px 4px,rgba(202, 158, 227, 0.5)0 4px 8px,rgba(202, 158, 227, 0.5)0 8px 16px,rgba(202, 158, 227, 0.5)0 16px 32px;
  transform: scale(1.05) rotate(-1deg);
}
        
        @media screen and (max-width: 768px) {
            .profile-btn {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <a href="userprofile.php">
        <button class="profile-btn">
            <i class="fa-regular fa-user"></i>
                Profile
        </button>
    </a>
        
</body>

</html>

<?php require_once('connect.php'); ?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Amusigo</title>
<link rel="stylesheet" href="css/landing.css">
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

</head>

<body>


  <?php include('navbar.php') ?>

  <div id="home">
    <div class="home-left">
      <h1 class="home-title">Find your <span style="color: #8d2182">music soulmate</span> today</h1>
      <p style="color: #480034; font-size: 1.2rem;">Your music mate is right around the corner!</p>
      <a href="signup.php"><button id="btn-join">Join Now</button></a>
      <img class="img2" style="margin: 6.3rem;" src="image/landing2.svg"/>
    </div>
      <div class="home-right"  >
      <img src="image/bg-landing1.svg"/>
      <img class="img1"  src="image/landing1.svg"/>
    </div>   
  </div>

  <hr/>


  <!-- About -->
  <div id="about">
        <div class="about-left">
          <div style="color:#5F0099; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
            <h1 class="title-left">Welcome to Amusigo</h1>
            <p class="subtitle-left">An overview of Amusigo benefits</p>
          </div>
           
            <div class="about-box1">
                <p class="box1-text">We focus on what is more important to you</p>
                <img class="cassette" src="image/cassette.svg">
            </div>
        </div>

        <div class="about-right">
            <div style="display:flex; justify-content: center;">
                <h1 class="about-text2">WITH US YOU COULD...</h1>
                <img class="headphone" style="margin-top:1.5rem" src="image/headphone.svg">
            </div>
          
            <ul class="about-list2">
                <li>Organize playlists seperately</li>
                <li style="margin-block:1.5rem">Find people with same music taste as you</li>
                <li>Link with music mates through Line</li>
            </ul>
        </div>
    </div>
    <hr/>
  
   <!-- FAQ -->
   <div id="faq-container">
        <img class="faq-img" src="image/faq.svg"/>
        
        <div>
        <div class="faq">
            <div class="question">
                <h3>What is JavaScript?</h3>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        
            <div class="answer">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>
        </div>

        <div class="faq">
            <div class="question">
                <h3>What is JavaScript?</h3>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        
            <div class="answer">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
        </div>
    </div>
    <hr/>


    <!-- Contact -->
    <div id="contact">
        <div>
            <h1 style="color:#843e71; font-size:3.5rem">Get in touch...</h1>
            <form>
                <div class="contact-form">
                    <label>NAME</label>
                    <input type="text" placeholder="Enter your username">

                    <label style="margin-top:3rem">EMAIL</label>
                    <input style="margin-bottom:3rem" type="text" placeholder="Enter your email">

                    <label>MESSAGE</label>
                    <input type="text" placeholder="Send us a message">
                </div>
            

            <button id="btn-join" style="margin-top:4rem; margin-left:2rem"> Submit</button>
            </form>
            
        </div>
        <img class="contact-img" src="image/contact.svg"/>
    </div>

    <div id="footer">
        <div class="footer-1">
            <ul>
                <p>Home</p>
                <p>About Us</p>
                <p>Contact Us</p>
                <p>FAQ</p>
            </ul>
        </div>
        <div class="footer-2">
            <p>Address </p>
            <p>Sirindhorn International Institute of Technology, Thammasat University, Rangsit Campus, Pathum Thani, 12120</p>
            <p>View on map</p>
        </div>
        <div class="footer-3">
            <p>Inquiries</p>
            <p>00-000-000</p>
            <p>Amusigo@emai.com</p>
        </div>

        <div class="footer-4">
           <p> Follow us on</p>
           <div style="font-size:1.5rem;">
           <i class="fa-brands fa-facebook"></i>
           <i class="fa-brands fa-instagram"></i>
           <i class="fa-brands fa-line"></i>
           </div>
          
        </div>

    </div>


 



   
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

const faqs = document.querySelectorAll(".faq");
faqs.forEach(faq => {
  faq.addEventListener("click", () => {
    faq.classList.toggle("active");
  })
})
</script>
</body>
</html>

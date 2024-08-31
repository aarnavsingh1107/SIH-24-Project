<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="exx.css">
    <title>Home</title>
</head>
<body>
<div class="background1" ></div>
    <div class="content1">
        <h1>Welcome to FixMyRoad</h1>
        <div class="button-container1">
            <!-- <a href="register.html">Register</a> -->
            <!-- <a href="login.html">Login/SignUp</a> -->
            <a href="imgu/create.php">Register Complaint</a>
            <a href="imgu/index.php">View Complaints</a>
            <a href="about.html">ABOUT</a>
        </div>
    </div>
<div>  
    <br>
    <div class="nav">
        <!-- <div class="logo">
            <p><a href="home.php">Logo</a> </p>
        </div> -->

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
                $res_id = $result['Id'];
            }
            
            echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $res_Email ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>And you are <b><?php echo $res_Age ?> years old</b>.</p> 
            </div>
          </div>
       <!-- </div>
       <div class="p">
        <a href="https://www.instagram.com/shivam7107saini/#"><img src="https://c8.alamy.com/comp/2WAY8XE/instagram-logo-instagram-icon-social-media-app-symbol-meta-instagram-2WAY8XE.jpg" alt="" width="30"></a>
       </div> -->

    </main>
    <!-- <br> -->
    <!-- <div class="background1" ></div>
    <div class="content1">
        <h1>Welcome to FixMyRoad</h1>
        <div class="button-container1">
            <a href="register.html">Register</a> -->
            <!-- <a href="login.html">Login/SignUp</a> -->
            <!-- <a href="complaint.html">Register Complaint</a> -->
            <!-- <a href="media.html">View Complaints</a> -->
            <!-- <a href="about.html">ABOUT</a> -->
        <!-- </div> -->
    <!-- </div> -->
</body>
</html>
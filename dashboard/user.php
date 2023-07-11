<?php 
require_once '../vendor/autoload.php';

session_start();
date_default_timezone_set("Africa/Lagos");

$conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());
if(!isset($_SESSION["user"])){  
    header("location: ../login/index.htm");  
}
if(isset($_SESSION["user"])) {  

    $email = $_SESSION['user'];
    $va = mysqli_query($conn,"select * from users WHERE `username`='$email' or `email`='$email'");
    
    if(mysqli_num_rows($va) < 1){
        header("Location: ../login/login.php");
    }

    $data = mysqli_fetch_array($va);

    $username = $data['username'];
    $email = $data['email'];
    $user_id = $data['id'];

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162222857-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-162222857-3');
    </script>


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow">
    <meta name="description" content="iTrans DATA. Recharge Smarter.">
    <meta name="keywords" content="">


    <meta name="google-site-verification" content="">
    <meta name="naver-site-verification" content="">


    <title> iTicket </title>

    <link rel="icon" type="image/jpg" href="../yaba.png">




    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap_1680.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style_front_1680.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

    <script type="text/javascript" async="" src="../js/_Incapsula_Resource.js"></script>
    <script async="" src="../js/analytics.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/svg4everybody.legacy.min.js"></script>

    <!-- Open graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Largest Recharging website ">
    <meta property="og:description" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="../yaba.png">

    <style>
    body {
      background-image: url("../backgrd.jpg")
    }
    </style>
</head>

<body>
    <?php
if(isset($_SESSION['booked_ticket']))
		  {
		  	echo ' <div class="container">
              </div>
              
            <div class="container" >
                <div class="row splash-main"> 
                <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <div class="alert alert-success">
              <button type="button" class="close" title="exit message" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>' . $_SESSION['booked_ticket'] . '</div> </div> </div> </div>';
          }
          
          unset($_SESSION['booked_ticket']);
		  ?>
    <br />
    <div
        style="background-image:url('datap.jpg'); filter:blur(8px); -webkit-filter:blur(8px); height:100%; background-position:center; background-repeat:no-repeat; background-size:cover;">
    </div>
    <div class="container">
        <div class="row splash-main">

            <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h4>Welcome, <?=$username;?>! &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<a href="logout.php">Logout</a></h4>
                <br />
                <span>iTicket Management System</span>

                <form action="" id="UserLoginNowForm" method="post" enctype="multipart/form-data"
                    accept-charset="utf-8">

                    <div class="form-group required">

                        <ul>

                            <li>
                                <a href="book_ticket.php"> Book Ticket </a>
                            </li>
                            <br />
                            <li>
                                <a href="view_transactions.php"> View Transactions </a>
                            </li>
                            <br />
                            <li>
                                <a href="rate_reviews_events.php">Rate Events & Add Reviews</a>
                            </li>
                            <br />
                            <li>
                                <a href="group_book_ticket.php"> Group Booking / Reservation </a>
                            </li>
                            <br />
                            <li>
                                <a href="waitlist.php"> Pending Reservation(s) </a>
                            </li>
                        </ul>

                    </div>
                </form>
                <br />

                <!-- <form method="post" action="registered.php">
            <div class="submit">
		            		<input class="btn btn-primary" style="color:#ffffff; text-align:center;" name="viewreg" id="signInButton" type="submit" value="Generate Report(s)" disabled="">
		            	</div>
</form> -->

            </div>
        </div>

    </div>
    <script type="text/javascript">
    document.getElementById("signInButton").disabled = false;

    function enableBtn() {
        document.getElementById("signInButton").disabled = false;
    }

    document.getElementById("signInButton1").disabled = false;

    function enableBtn() {

        document.getElementById("signInButton1").disabled = false;
    }
    document.getElementById("signInButton2").disabled = false;

    function enableBtn() {
        document.getElementById("signInButton2").disabled = false;
    }


    //radio
    function hideInputs() {
        if (document.getElementById('sendEmailOption').checked) {
            document.getElementById('emailto').style.display = 'block';
            document.getElementById('emailfrom').style.display = 'block';

        } else {
            document.getElementById('emailto').style.display = 'none';
            document.getElementById('emailfrom').style.display = 'none';
            $("#emailto").prop('required', false);
            $("#emailfrom").prop('required', false);
        }
    }

    function hidePassword() {
        if (document.getElementById('setpassword').checked) {
            document.getElementById('password').style.display = 'block';
        } else {
            document.getElementById('password').style.display = 'none';
            $("#password").prop('required', false);
        }

    }
    </script>


</body>

</html>
<?php
    $conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());
    mysqli_close($conn);}
?>
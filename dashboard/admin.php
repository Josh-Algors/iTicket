<?php   
session_start();

$conn=mysqli_connect('localhost','root','','iTransfer') or die('Could not Connect My Sql:'.mysql_error());
if(!isset($_SESSION["admin"])){  
    header("location: ../login/index.htm");  
}
if(isset($_SESSION["admin"])) {  

  $email = $_SESSION['email'];
  $va = mysqli_query($conn,"select * from users WHERE `username`='$email' or `email`='$email'");
  
  if(mysqli_num_rows($va) < 1){
    header("Location: ../login/login.php");
  }

  $data = mysqli_fetch_array($va);

  $username = $data['username'];
  $email = $data['email'];

// if(isset($_POST['sendmessage'])){
//   $vals = mysqli_query($conn,"select * from student ");
//   $message = $_POST['message'];
//   $curdate = date("Y-M-d, h:i:sa");
//   $que = mysqli_query($conn,"INSERT INTO `messages`(`message`,  `date`) VALUES ('$message','$curdate')");
//     for ($y = 0; $y < mysqli_num_rows($vals); $y++) {
//       $rowval = mysqli_fetch_array($vals);
//       $rownum = "+" . $rowval['phone'];

//       //config for mails 
//       $to = $rowval['email'];
//       $sub = "Important Notice!!";
//       $message = $message;
//       $from = "From: iTransfer6@gmail.com";
//       mail($to,$sub,$message,$from);
          
//       // Your Account SID and Auth Token from twilio.com/console
//       $account_sid = 'AC039121e48fa58c46c42f3f97ea5bb80c';
//       $auth_token = 'ee0460591e3ed7d65746dcd9badcc0e3';
//       // In production, these should be environment variables. E.g.:
//       // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
      
//       // A Twilio number 
//       $twilio_number = "+12065043061";
      
//       $client = new Client($account_sid, $auth_token);
//       $client->messages->create(
//           // Where to send a text message (your cell phone?)
//           $rownum,
//           array(
//               'from' => $twilio_number,
//               'body' => $message
//           )
//       );


//             }
//             echo '<script>alert("Info Sent!")</script>';
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
      
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162222857-3"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
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


    <title> iTransfer </title>

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

<link href="css/widget.css" rel="stylesheet">
</head>

<body >

<br />
<div style="background-image:url('datap.jpg'); filter:blur(8px); -webkit-filter:blur(8px); height:100%; background-position:center; background-repeat:no-repeat; background-size:cover;">
</div>
<div  class="container">
    <div class="row splash-main">
    
        <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <h4>Welcome, <?=$username;?>!  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<a href="logout.php">Logout</a></h4>
            <br/>
                        <span>TRANSFER SYSTEM</span>

            <form action="" id="UserLoginNowForm" method="post" accept-charset="utf-8">
	            <div style="display:none;"><input type="hidden" name="_method" value="POST">
                 <input type="hidden" name="key" value="6Lfwu8sUAAAAAGi3hFs-D8F8o2ZLI1mzBA2fIRiS" id="Token1532892527">
	            </div>
          <!-- <div class="form-group required">
            <select name="lev" class="form-control" id="pet-select" required>
              <option value="">--Choose Your Level--</option>
              <option value="nd1">ND1</option>
              <option value="nd2">ND2</option>
              <option value="hnd1">HND1</option>
              <option value="hnd2">HND2</option>
              
              
          </select>
          </div> -->
          <div class="form-group required">
                 <input name="emailto" class="form-control" placeholder="Email To: " type="email" id="emailto" required="required">
	            </div>

                <div class="form-group required">
                 <input name="emailfrom" class="form-control" placeholder="Your Email: " type="email" id="emailfrom" value=<?=$email;?> required="required" disabled>
	            </div>

              <div class="form-group required">
                    
	            	<input name="title" class="form-control" placeholder="Title" type="text" id="title" required="required">
	            </div>

                <div class="form-group required">
                    
	            	<input name="message" class="form-control" placeholder="Message" type="text" id="message" required="required">
	            </div>
              <div class="form-group required">
                    
                    <input name="file" class="form-control" placeholder="Upload File" type="file" id="file" required="required">
                  </div>
	            
	            <div class="form-group captcha-box">
	                                                <!--<div class="g-recaptcha" data-sitekey="6Lfwu8sUAAAAAGi3hFs-D8F8o2ZLI1mzBA2fIRiS" data-callback="enableBtn"></div>--> 
                                                    <div class="submit">
		            		<input class="btn btn-primary" style="color:#ffffff; text-align:center;" name="sendnote" id="signInButton1" type="submit" value="Transfer Now!" disabled="">
		            	</div>
                        
                       

		            	<div style="display:none;">
		            		<input type="hidden" name="data[_Token][fields]" value="a8f894205ef2839927d5ad906c061462f4424136%3A" id="TokenFields2092665347">
		            		<input type="hidden" name="data[_Token][unlocked]" value="User.form_type%7Cg-recaptcha-response" id="TokenUnlocked836959454">
		            	</div>
		        </div>
            </form>
<br/>

            <form method="post" action="registered.php">
            <div class="submit">
		            		<input class="btn btn-primary" style="color:#ffffff; text-align:center;" name="viewreg" id="signInButton" type="submit" value="View Registered Students" disabled="">
		            	</div>
</form>

        </div>
    </div>

</div>
<script type="text/javascript">
              document.getElementById("signInButton").disabled = false;
            function enableBtn(){
        document.getElementById("signInButton").disabled = false;
      }

      document.getElementById("signInButton1").disabled = false;
            function enableBtn(){
        document.getElementById("signInButton1").disabled = false;
      }
      document.getElementById("signInButton2").disabled = false;
            function enableBtn(){
        document.getElementById("signInButton2").disabled = false;
      }


    </script>

    
</body>
</html>
<?php
$conn=mysqli_connect('localhost','root','','iTransfer') or die('Could not Connect My Sql:'.mysql_error());
mysqli_close($conn);}
?>
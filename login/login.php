<?php
extract($_POST);

$conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());


if(isset($_POST["btnlogin"]))
{
    
    $secret = "dmjOlcsvpecxMDvx1FdiFw";
    $email = $_POST['email'];
    $fs = mysqli_query($conn,"select * from users where (email='$email' or username='$email')");

    $data = mysqli_num_rows($fs);

    if($data > 0)
    {

        // $value = $email;
        $data = mysqli_fetch_array($fs);

        $pwd_hashed = $data['password'];
        $password = $_POST['password'];
        $pwd_peppered = hash_hmac("sha256", $password, $secret);
        

        if (password_verify($pwd_peppered, $pwd_hashed))
        {

            session_start();

            $_SESSION["user"] = $email;
            header("location: ../dashboard/user.php"); 
        }
        else
        {
            $found="N";
        }
    }

}



mysqli_close($conn);
?>


<!DOCTYPE html>

<html>
<head>
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
        <meta property="og:image" content="localhost/iTransimg/iTrans_logo.png">

<link href="../css/widget.css" rel="stylesheet">

<style>
    body 
    {
        background-image: url("../backgrd.jpg")
    }
</style>
</head>

<body id="gm-home">

    <?php
		  if(isset($found))
		  {
		  	echo ' <div class="container">
              </div>
              
            <div class="container" >
                <div class="row splash-main"> 
                <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <div class="alert alert-success">
              <button type="button" class="close" title="exit message" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>Invalid Email/Password. Try Again...</div> </div> </div> </div>';
          }
          
		  ?>


 
<br />

  
<div class="container">
    <div class="row splash-main">
    
        <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <h2>iTicket</h2>
                        <span>Please enter your login data <br/></span>

            <form  action="" id="UserLoginNowForm" method="post" accept-charset="utf-8">
	            <div style="display:none;"><input type="hidden" name="_method" value="POST">
	            	<input type="hidden" name="key" value="6Lfwu8sUAAAAAGi3hFs-D8F8o2ZLI1mzBA2fIRiS" id="Token1532892527">
	            </div>
	            <div class="form-group required">
	            	<input name="email" class="form-control" placeholder="E-mail or Username" type="text" id="email" required="required">
	            </div>
	            <div class="form-group required">
	            	<input name="password" class="form-control" placeholder="Password" type="password" id="password" required="required">
	            </div>
	            
	            <p class="text-center"><a href="" class="text-warning">Lost your password?</a> |
	            	<a href="../register/index.htm" class="text-warning btn btn-default">Register</a>
	            </p>

	            <div class="form-group captcha-box">
	                                                <!--<div class="g-recaptcha" data-sitekey="6Lfwu8sUAAAAAGi3hFs-D8F8o2ZLI1mzBA2fIRiS" data-callback="enableBtn"></div>--> 
                        	            		<div class="submit">
		            		<input class="btn btn-primary" style="color:#ffffff;" name="btnlogin" id="signInButton" type="submit" value="Login" disabled="">
		            	</div>
		            	<div style="display:none;">
		            		<input type="hidden" name="data[_Token][fields]" value="a8f894205ef2839927d5ad906c061462f4424136%3A" id="TokenFields2092665347">
		            		<input type="hidden" name="data[_Token][unlocked]" value="User.form_type%7Cg-recaptcha-response" id="TokenUnlocked836959454">
		            	</div>
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
    </script>


</body>
</html>

<?php
extract($_POST);
if(empty($_POST['email'])) {  
     
    header("location: ../register/index.htm");  
}

if(!empty($_POST['email'])) {
$conn=mysqli_connect('localhost','root','','inotify') or die('Could not Connect My Sql:'.mysql_error());
$rs=mysqli_query($conn,"select * from student WHERE `matric no`='$matnum'");
$qs =mysqli_query($conn,"select * from student WHERE `phone`='$phone'");

if (mysqli_num_rows($rs)>0 || mysqli_num_rows($qs)>0)
{
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


    <title> iNotify </title>

    <link rel="icon" type="image/jpg" href="../yaba.png">

      
    

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap_1680.min.css">
    <link rel="stylesheet" type="text/css" href="css/style_front_1680.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <script type="text/javascript" async="" src="js/_Incapsula_Resource.js"></script>
    <script async="" src="js/analytics.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/svg4everybody.legacy.min.js"></script>

    <!-- Open graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Largest Recharging website ">
    <meta property="og:description" content="">
            <meta property="og:url" content="">
        <meta property="og:image" content="../img/iTrans_logo.png">

<link href="http://localhost/iTransdata/css/widget.css" rel="stylesheet">
</head>

<body id="gm-home">


    <br>
    <br />
<div class="container">
  </div>
  
<div class="container" style="margin-top:-80px;">
<div class="row splash-main">
<div class="alert alert-success">
						<button type="button" class="close" title="exit message" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>Email Address/Username Already Exists!.</div>
    <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <h2>Sign Up</h2>
            <span>Please enter your personal information</span>

        <form action="" autocomplete="off" id="UserRegisterForm" method="post" accept-charset="utf-8">
          <div style="display:none;">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="key" value="6LfhxncUAAAAAFUzGEfIoy0Vz1R7K2ZyjP3CJDAu" id="Token1759140670">
          </div>
          
          <div class="form-group required">
            <input  name="email" class="form-control" placeholder="Email" type="email" id="UserEmail" required="required" value="">
          </div>
                    <div class="form-group required">
            <input  name="fname" class="form-control" placeholder="First Name" type="text" id="fname" required="required" value="">
          </div>
          
              <div class="form-group required">
            <input  name="lname" class="form-control" placeholder="Last Name" type="text" id="lname" required="required" value="">
          </div>
          
          <div class="form-group required">
            <input  name="matnum" class="form-control" placeholder="Matric Number" type="text" id="matnum" required="required" value="">
          </div>
          <div class="form-group required">
            <select name="dept" class="form-control" id="pet-select" required>
              <option value="">--Choose Your Department--</option>
              <option value="Computer Technology">Computer Technology</option>
              <option value="Food Technology">Food Technology</option>
              <option value="Polymer & Textile">Polymer & Textile</option>
              <option value="Hospitality Management">Hospitality Management</option>
              <option value="Nutrition & Dietics">Nutrition & Dietics</option>
              
          </select>
          </div>

          

          <div class="form-group required">
            <select name="lev" class="form-control" id="pet-select" required>
              <option value="">--Choose Your Level--</option>
              <option value="nd1">ND1</option>
              <option value="nd2">ND2</option>
              <option value="hnd1">HND1</option>
              <option value="hnd2">HND2</option>
              
              
          </select>
          </div>
          <div class="form-group PhoneNumberInput">
            <input name="phone" class="form-control" selected="234" placeholder="234XXXXXXXXXX" required="required" maxlength="13" type="tel" id="UserPhoneNumber" value="">
            </div>

                    <div class="form-group">
            <input name="password" class="form-control" required="required" placeholder="Password" minlength="8" maxlength="200" type="password" id="UserChangePassword" value="">
            <div class="form-hint">Password must be at least 8 characters long.</div>
          </div>
                    <div class="form-group required">
            <input name="confirm_password" class="form-control" placeholder="Repeat password" minlength="8" maxlength="200" type="password" id="UserRepeatPassword" required="required" value="">
          </div>
             
          <div class="clearfix"></div>
    
          <p class="text-center"><a href="" class="text-warning">Lost your password?</a> | <a href="login/index.htm" class="text-warning">Already have an account?</a></p>

          <!--<div class="form-group captcha-box">
            <div class="g-recaptcha" data-sitekey="6LfhxncUAAAAAFUzGEfIoy0Vz1R7K2ZyjP3CJDAu" data-callback="enableBtn"></div>
          </div>-->
          <div class="submit">
            <input class="btn btn-primary" id="signUpButton" name="save" type="submit" value="Sign up" disabled="">
          </div>
          <div style="display:none;">
            <input type="hidden" name="data[_Token][fields]" value="b86c6be2bb5f6fdef1743a61b72cf4a89bbf7afb%3A" id="TokenFields493036425">
            <input type="hidden" name="data[_Token][unlocked]" value="User.form_type%7Cg-recaptcha-response" id="TokenUnlocked813289545">
          </div>
        </form>
      </div>
</div>
</div>
<script type="text/javascript">
    document.getElementById("signUpButton").disabled = false;
    function enableBtn(){
      document.getElementById("signUpButton").disabled = false;
    }
</script>


</body>
</html>
<?php
    
} else{

$query="INSERT INTO `student`(`email`,`first name`,`last name`,`matric no`,`department`,`level`,`phone`,`password`) 
VALUES('$email','$fname','$lname','$matnum','$dept','$lev','$phone','$password')";
mysqli_query($conn,$query) or die("Could Not Perform the Query");
session_start();
$_SESSION['login'] = 'student';
header('Location: ../register/success.php'); 
}
} 
?>








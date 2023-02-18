<?php
extract($_POST);
if(empty($_POST['email'])) {  
     
    header("location: ../register/index.htm");  
}

if(!empty($_POST['email'])) {
$conn=mysqli_connect('localhost','root','','iTransfer') or die('Could not Connect My Sql:'.mysql_error());
$rs=mysqli_query($conn,"select * from users WHERE `email`='$email' or `username`='$username'");

if (mysqli_num_rows($rs)>0)
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
        <meta property="og:image" content="img/iTrans_logo.png">

<link href="../css/widget.css" rel="stylesheet">

<style>
    body 
    {
        background-image: url("https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExODkzNGI1NjBjNDUwNzA2MmM1YjlhMTU0NGQwMjVhNDFmNGFjMzA3ZiZjdD1n/W6cs6H6vVaPmmJp100/giphy-downsized-large.gif")
    }
</style>
</head>

<body id="gm-home">

</header>


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
            <h2>iTransfer</h2>
            <span>Please fill the fields with your info.<br/></span>

        <form action="register_user.php" autocomplete="off" id="UserRegisterForm" method="post" accept-charset="utf-8">
            <div style="display:none;">
              <input type="hidden" name="_method" value="POST">
              <input type="hidden" name="key" value="6LfhxncUAAAAAFUzGEfIoy0Vz1R7K2ZyjP3CJDAu" id="Token1759140670">
            </div>
            
            <div class="form-group required">
              <input  name="email" class="form-control" placeholder="Email" type="email" id="email" required="required" value="">
            </div>
                      <div class="form-group required">
              <input  name="username" class="form-control" placeholder="Username" type="text" id="username" required="required" value="">
            </div>
            
                <div class="form-group required">
              <input  name="password" class="form-control" placeholder="Password" type="password" id="password" required="required" value="">
            </div>
  
               
            <div class="clearfix"></div>
    
          <p class="text-center"><a href="" class="text-warning">Lost your password?</a> | <a href="../login/index.htm" class="text-warning">Already have an account?</a></p>

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
    
} 
else
{
      $secret = "dmjOlcsvpecxMDvx1FdiFw";

      $pwd_secret = hash_hmac("sha256", $password, $secret);
      $pwd_hashed = password_hash($pwd_secret, PASSWORD_DEFAULT);

      $query="INSERT INTO `users`(`username`,`email`,`password`) VALUES('$username', '$email', '$pwd_hashed')";

      mysqli_query($conn,$query) or die("Could Not Perform the Query");

      session_start();

      $_SESSION['admin'] = "admin";
      header('Location: ../dashboard/admin.php'); 
  }
} 
?>








<?php 
require_once '../vendor/autoload.php';
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

session_start();
date_default_timezone_set("Africa/Lagos");

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
  $user_id = $data['id'];
  // echo $_SERVER['HTTP_HOST'];
  if(isset($_POST['transfer'])){

    function generateRandomString($length = 10) 
    {
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $charactersLength = strlen($characters);
      $randomString = '';

      for ($i = 0; $i < $length; $i++)
      {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }

      return $randomString;
    }

    function generateRand($length = 6)
    {
      $characters = '0123456789';
      $charactersLength = strlen($characters);
      $randomString = '';

      for ($i = 0; $i < $length; $i++)
      {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }

      return $randomString;
    }
  
    // echo generateRandomString();

    $secret = "dmjOlcsvpecxMDvx1FdiFw";

    $pwd_secret = hash_hmac("sha256", $_POST['password'], $secret);
    $pwd_hashed = password_hash($pwd_secret, PASSWORD_DEFAULT);
    $expires_at = date("Y-m-d H:i:sa", strtotime('+'.$_POST['expires'].' days'));


    $rand_num = generateRand();
    $fls = explode(".", $_FILES['file']['name']);
    $file_names = trim(current($fls) . $rand_num . "." . end($fls), "'");
    $file_name = str_replace( array('"', ',' , ';', '<', '>', '\''), '', $file_names);
    $file_type = $_FILES['file']['type'];
    $file_size = strval($_FILES['file']['size']);
    $file_tmp = $_FILES['file']['tmp_name'];
  

    $email_to = $_POST['emailto'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $send_type = $_POST['sendtype'];
    $expires_at = date("Y-m-d H:i:sa", strtotime('+'.$_POST['expires'].' days'));
    $password = $pwd_hashed;
    $status = "0";
    $link = generateRandomString();
    $download_link = "Kindly click this link to download the file - " . "http://localhost/itransfer?download_link=" . $link;
  


    // echo $file_name;
    $clicked = $_POST['sendtype'];

    if($clicked == "mail")
    {
      $email_from = $_POST['emailfrom'];
      
      $transport = Transport::fromDsn('smtp://email:password@smtp.gmail.com:587');
      // Create a Mailer object 
      $mailer = new Mailer($transport); 
      // Create an Email object 
      $emaill = (new Email());
      // Set the "From address" 
      $emaill->from($email_from);
      // Set the "From address" 
      $emaill->to($_POST['emailto']);
      // Set a "subject" 
      $emaill->subject('iTransfer - ' . $_POST['title']);
      // Set the plain-text "Body" 
      $mssg = $_POST['message'];
      $msg = "Hello!\n Kindly see the link below for download\nDownload Link - " . $download_link . "\nPassword - " . $_POST['password'] . "\nExpires in - " . $_POST['expires'] . "day(s)\n" . $mssg;
      $emaill->text($msg);

      // Send the message 
      $mailer->send($emaill);
    }


    if($file_name && $file_type && $file_size && $file_tmp)
    {
      $query="INSERT INTO `transfers`(`user_id`, `email_to`, `email_from`, `title`, `message`, `send_type`, `file_name`, `file_type`, `file_size`, `expires_at`, `password`, `link`, `status`) 
      VALUES('$user_id', '$email_to', '$email', '$title', '$message', '$send_type', '$file_name', '$file_type', '$file_size', '$expires_at', '$password', '$link', '$status')";

      // $query = 'SELECT * FROM users';
      $result = mysqli_query($conn, $query);
    }

    if($result)
    {
      // Move the uploaded file to a desired location
      move_uploaded_file($file_tmp, "../uploads/$file_name"); 
    }


    echo $result;

    // var_dump($result);
    echo "<script> alert('$download_link') </script>";
  
  }

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

<style>
    body 
    {
        background-image: url("https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExODkzNGI1NjBjNDUwNzA2MmM1YjlhMTU0NGQwMjVhNDFmNGFjMzA3ZiZjdD1n/W6cs6H6vVaPmmJp100/giphy-downsized-large.gif")
    }
</style>
</head>

<body >

<br />
<div style="background-image:url('datap.jpg'); filter:blur(8px); -webkit-filter:blur(8px); height:100%; background-position:center; background-repeat:no-repeat; background-size:cover;">
</div>
<div  class="container">
    <div class="row splash-main">
    
        <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <h4>Welcome, <?=$username;?>!  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<a href="logout.php">Logout</a></h4>
            <br/>
                        <span>TRANSFER SYSTEM</span>

            <form action="" id="UserLoginNowForm" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
                 <input name="emailto" class="form-control" placeholder="Email To: " type="email" id="emailto" required>
	            </div>

                <div class="form-group required">
                 <input name="emailfrom" class="form-control" placeholder="Your Email: " type="email" id="emailfrom" value=<?=$email;?> required disabled>
	            </div>

              <div class="form-group required">
                    
	            	<input name="title" class="form-control" placeholder="Title" type="text" id="title" required="required">
	            </div>

                <div class="form-group required">
                    
	            	<input name="message" class="form-control" placeholder="Message" type="text" id="message" required="required">
	            </div>

               <div>
                  <input onclick="javascript:hideInputs();" type="radio" id="sendEmailOption" name="sendtype" value="mail" checked>
                  <label for="sendEmailOption">Send Email Link</label>
                  <br/>
                  <input onclick="javascript:hideInputs();" type="radio" id="getTransferLinkOption" name="sendtype" value="link">
                  <label for="getTransferLinkOption">Get Transfer Link</label>
               </div>
               <br/>
              <div class="form-group required">
                    
                    <input name="file" class="form-control" placeholder="Upload File" type="file" id="file" required="required">
                  </div>
	            
                  <div class="form-group required">
                    
	            	<input name="expires" class="form-control" placeholder="expiration (in days)" type="text" id="expires" required="required">
	            </div>

              <div>
                  <input onclick="javascript:hidePassword();" type="checkbox" id="setpassword" name="setpassword" value="30" checked>
                  <label for="setpassword">Set Password</label>
                  <br/>
               </div>

              <div class="form-group required">
                    
	            	<input name="password" class="form-control" placeholder="Enter Password" type="text" id="password" required>
	            </div>
	            <div class="form-group captcha-box">
	                                                <!--<div class="g-recaptcha" data-sitekey="6Lfwu8sUAAAAAGi3hFs-D8F8o2ZLI1mzBA2fIRiS" data-callback="enableBtn"></div>--> 
                                                    <div class="submit">
		            		<input class="btn btn-primary" style="color:#ffffff; text-align:center;" name="transfer" id="signInButton1" type="submit" value="Transfer Now!" disabled="">
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
		            		<input class="btn btn-primary" style="color:#ffffff; text-align:center;" name="viewreg" id="signInButton" type="submit" value="View Transfer History" disabled="">
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


      //radio
      function hideInputs(){
      if (document.getElementById('sendEmailOption').checked) {
        document.getElementById('emailto').style.display = 'block';
        document.getElementById('emailfrom').style.display = 'block';

      }
      else {
        document.getElementById('emailto').style.display = 'none';
        document.getElementById('emailfrom').style.display = 'none';
        $("#emailto").prop('required', false);
        $("#emailfrom").prop('required', false);
        }
      }

      function hidePassword()
      {
        if (document.getElementById('setpassword').checked) {
        document.getElementById('password').style.display = 'block';
      }
      else {
        document.getElementById('password').style.display = 'none';
        $("#password").prop('required', false);
        }

      }

    </script>

    
</body>
</html>
<?php
    $conn=mysqli_connect('localhost','root','','iTransfer') or die('Could not Connect My Sql:'.mysql_error());
    mysqli_close($conn);}
?>
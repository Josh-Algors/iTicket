<?php   
session_start();
date_default_timezone_set("Africa/Lagos");
require_once '../vendor/autoload.php';
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$conn=mysqli_connect('localhost','root','','iTransfer') or die('Could not Connect My Sql:'.mysql_error());
$link = $_SESSION['download_link'];

if(!isset($link))
{
    header("location: ../login/index.htm");
}

if(isset($_POST['download']))
{
    
    $secret = "dmjOlcsvpecxMDvx1FdiFw";
    $password = $_POST['password'];
    $get_file = mysqli_query($conn, "select * from transfers where (link='$link')");

    $datass = mysqli_num_rows($get_file);

    // $value = $email;
    $data = mysqli_fetch_array($get_file);

    $expires = date("Y-m-d H:i:sa", strtotime($data['expires_at']));
    $today = date("Y-m-d H:i:sa");

    if($data['expires_at'] < $today)
    {
        echo "<script> alert('Link Expired') </script>";
        // header("location: files.php");
    }
    else if($datass > 0)
    {
        $pwd_hashed = $data['password'];
        $password = $_POST['password'];
        $pwd_peppered = hash_hmac("sha256", $password, $secret);
        
        if (password_verify($pwd_peppered, $pwd_hashed))
        {
            $url = $data['url'];
            // $file = $data['file_name'];
            // $content_type = $data['file_type'];
            // // echo $content_type;
            // $file_size = $data['file_size'];
            // $file_path = "../uploads/$file";

            // header('Content-Description: File Transfer');
            // header('Content-Type: ' . $content_type);
            // header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
            // header('Content-Transfer-Encoding: binary');
            // header('Expires: 0');
            // header('Cache-Control: must-revalidate');
            // header('Pragma: public');
            // header('Content-Length: ' . filesize($file_path));
            // flush();
            // readfile($file_path);
            // exit();

            if($data['send_type'] == "mail")
            {
                $transport = Transport::fromDsn('smtp://ife.illustrator@gmail.com:vyfwtjfdhibjuvyc@smtp.gmail.com:587');
                // Create a Mailer object 
                $mailer = new Mailer($transport); 
                // Create an Email object 
                $emaill = (new Email());
                // Set the "From address" 
                $emaill->from($data['email_from']);
                // Set the "From address" 
                $emaill->to($data['email_to']);
                // Set a "subject" 
                $emaill->subject('iTransfer - ' . $data['title']);
                // Set the plain-text "Body" 
                $mssg = $data['message'];
                $msg = "Hello!\n Kindly see the link below for download\nDownload Link - " . $url . "\n" . $mssg;
                $emaill->text($msg);

                // Send the message 
                $mailer->send($emaill);
            }
            else
            {
                echo "<script> alert('Copy this url to download the file - $url') </script>";
            }
        }
        else
        {
            echo "<script> alert('Incorrect Password') </script>";
        }
    }
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

<link href="css/widget.css" rel="stylesheet">

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
                        <h4>Welcome!  &nbsp; &nbsp;</h4>
            <br/>
                        <span>ITRANSFER SYSTEM</span>

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
                    
                    <input name="file" class="form-control" value="<?= $link; ?>" type="text" id="file_name" disabled required>
          <br />
	            	<input name="password" class="form-control" placeholder="Enter Password" type="password" id="password">
	            </div>
	            <div class="form-group captcha-box">
	                                                <!--<div class="g-recaptcha" data-sitekey="6Lfwu8sUAAAAAGi3hFs-D8F8o2ZLI1mzBA2fIRiS" data-callback="enableBtn"></div>--> 
                                                    <div class="submit">
		            		<input class="btn btn-primary" style="color:#ffffff; text-align:center;" name="download" id="signInButton1" type="submit" value="Download File!" disabled="">
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
             

    document.getElementById("signInButton1").disabled = false;
    
    function enableBtn()
    {
        document.getElementById("signInButton1").disabled = false;
    }

    //radio
    function hideInputs()
    {
        if (document.getElementById('sendEmailOption').checked) 
        {
        document.getElementById('emailto').style.display = 'block';
        document.getElementById('emailfrom').style.display = 'block';
        }
        else
        {
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
    mysqli_close($conn);
?>
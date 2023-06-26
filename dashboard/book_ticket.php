<?php   
session_start();
date_default_timezone_set("Africa/Lagos");
require_once '../vendor/autoload.php';
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());

if(!isset($_SESSION['user']))
{
    header("location: ../login/indexs.htm");
}
else
{
    $email = $_SESSION['user'];
    $user_query = mysqli_query($conn,"select * from users where (email='$email' or username='$email')");
    $user = mysqli_fetch_assoc($user_query);

    $_SESSION['user_email']  = $user['email'];

    $tickets = mysqli_query($conn,"select id, ticket_name, ticket_cost from tickets");

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

    <link href="css/widget.css" rel="stylesheet">

    <style>
    body {
        background-image: url("../backgrd.jpg")
    }
    </style>
</head>

<body>
<?php
		  if(isset($_SESSION['insufficient']))
		  {
		  	echo ' <div class="container">
              </div>
              
            <div class="container" >
                <div class="row splash-main"> 
                <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <div class="alert alert-success">
              <button type="button" class="close" title="exit message" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>' . $_SESSION['insufficient'] . '</div> </div> </div> </div>';
          }
          
          unset($_SESSION['insufficient']);
		  ?>
    <br />
    <div
        style="background-image:url('datap.jpg'); filter:blur(8px); -webkit-filter:blur(8px); height:100%; background-position:center; background-repeat:no-repeat; background-size:cover;">
    </div>
    <div class="container">
        <div class="row splash-main">

            <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h4>Welcome! &nbsp; &nbsp;</h4>
                <br />
                <span>iTicket SYSTEM</span>

                <form action="initialize.php" id="UserLoginNowForm" method="post" enctype="multipart/form-data"
                    accept-charset="utf-8">
                    <div style="display:none;"><input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="key" value="6Lfwu8sUAAAAAGi3hFs-D8F8o2ZLI1mzBA2fIRiS"
                            id="Token1532892527">
                    </div>
                    <div class="form-group required">
                        <label for="ticketType">Select Ticket Type:</label>
                        <select name="ticket">
                            <?php
                    if ($tickets && mysqli_num_rows($tickets) > 0) {
                        
                        // Create an HTML dropdown list
                        
                        mysqli_data_seek($tickets, 0);
                        echo '<option value="" selected>  Select a ticket </option>';
                        // Iterate through each row and populate the dropdown options
                        while ($row = mysqli_fetch_assoc($tickets)) {
                            $ticket_id = $row['id'];
                            $ticket_name = $row['ticket_name'];
                            $ticket_cost = $row['ticket_cost'];
                            echo '<option value="' . $ticket_id . '">' . $ticket_name .' - #' . $ticket_cost .'</option>';
                        }
                        
                    } else {
                        echo 'No ticket(s) found.';
                    }

                ?>
                        </select>
                    </div>

                    <div>
                        <label for="ticketType">Enter Number of Ticket(s):</label>
                        <input name="no_tickets" class="form-control" value="" type="number" id="no_tickets" required>
                    </div>
                    <!-- <div class="form-group required">
                        <label for="ticketType">Select Ticket Type:</label>
                        <select id="ticketType">
                            <option value="vip">VIP</option>
                            <option value="standard">Standard</option>
                            <option value="economy">Economy</option>
                        </select>

                        <div id="availableTickets"></div>
                    </div> -->


                    <div class="form-group captcha-box">
                        <!--<div class="g-recaptcha" data-sitekey="6Lfwu8sUAAAAAGi3hFs-D8F8o2ZLI1mzBA2fIRiS" data-callback="enableBtn"></div>-->
                        <div class="submit">
                            <input class="btn btn-primary" style="color:#ffffff; text-align:center;" name="pay_ticket"
                                id="pay_ticket" type="submit" value="Book Ticket!" disabled="">
                        </div>



                        <div style="display:none;">
                            <input type="hidden" name="data[_Token][fields]"
                                value="a8f894205ef2839927d5ad906c061462f4424136%3A" id="TokenFields2092665347">
                            <input type="hidden" name="data[_Token][unlocked]"
                                value="User.form_type%7Cg-recaptcha-response" id="TokenUnlocked836959454">
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <script type="text/javascript">
    document.getElementById("pay_ticket").disabled = false;

    function enableBtn() {
        document.getElementById("pay_ticket").disabled = false;
    }

    </script>


</body>

</html>
<?php
    $conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());
    mysqli_close($conn);


}
?>
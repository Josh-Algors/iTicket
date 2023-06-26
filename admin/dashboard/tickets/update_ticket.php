<?php
require_once '../../vendor/autoload.php';

session_start();
date_default_timezone_set("Africa/Lagos");

$conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());
if(!isset($_SESSION["admin"])){  
    header("location: ../../login/index.htm");  
}
if(isset($_SESSION["admin"])) {  

  $email = $_SESSION['email'];
  $result = mysqli_query($conn,"select id, ticket_name, ticket_type, ticket_cost from tickets ORDER BY id DESC");

  $val = mysqli_fetch_array($result);

//   $username = "admin";

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

    <link rel="icon" type="image/jpg" href="../../yaba.png">




    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap_1680.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/style_front_1680.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">

    <script type="text/javascript" async="" src="../../js/_Incapsula_Resource.js"></script>
    <script async="" src="../../js/analytics.js"></script>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/svg4everybody.legacy.min.js"></script>

    <!-- Open graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Largest Recharging website ">
    <meta property="og:description" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="../../yaba.png">

    <style>
    body {
        background-image: url("../../backgrd.jpg")
    }
    </style>
</head>

<body>

    <br />
    <div
        style="background-image:url('datap.jpg'); filter:blur(8px); -webkit-filter:blur(8px); height:100%; background-position:center; background-repeat:no-repeat; background-size:cover;">
    </div>
    <div class="container">
        <div class="row splash-main">

            <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h4>Welcome, <?=$username;?>! &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<a href="../logout.php">Logout</a> <br /> <br /> <?php
                    $previousPage = $_SERVER['HTTP_REFERER'];
                    echo '<a href="' . $previousPage . '">Go back <br/></a>';

                    if(isset($_POST["addTicket"]))
                    {
                        echo "<span> Ticket added Successfully! </span>";
                    }

                    ?></h4>
                <br />
                <span>iTicket Management System</span>

                <form action="" id="UserLoginNowForm" method="post" enctype="multipart/form-data"
                    accept-charset="utf-8">
                    <div style="display:none;"><input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="key" value="6Lfwu8sUAAAAAGi3hFs-D8F8o2ZLI1mzBA2fIRiS"
                            id="Token1532892527">
                    </div>

	            <div class="form-group required">
                <label > Select Ticket:  &nbsp; &nbsp; &nbsp;</label>
                <select name="users">
                <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        
                        // Create an HTML dropdown list
                        
                        mysqli_data_seek($result, 0);
                        echo '<option value="" selected>  Select a ticket </option>';
                        // Iterate through each row and populate the dropdown options
                        while ($row = mysqli_fetch_assoc($result)) {
                            $userId = $row['id'];
                            $userName = $row['ticket_name'];
                            echo '<option value="' . $userId . '">' . $userName . '</option>';
                        }
                        
                    } else {
                        echo 'No ticket(s) found.';
                    }
                ?>
                </select>
                <!-- </label> -->
                </div>
                

                <div class="form-group required">
                
                
                <input name="ticket-name" class="form-control" placeholder="Ticket Name" type="text" id="ticket-name" required="required" value="">
	         
                <!-- </label> -->
                </div>

                

                <div class="form-group required">
                
                
                <input name="ticket-name" class="form-control" placeholder="Ticket Type" type="text" id="ticket-name" required="required" value="">
	         
                <!-- </label> -->
                </div>

                <div class="form-group required">
                
                
                <input name="ticket-cost" class="form-control" placeholder="Ticket Cost" type="text" id="ticket-cost" required="required" value="">
	         
                <!-- </label> -->
                </div>

                <div class="submit">
                    <input class="btn btn-primary" style="color:#ffffff; text-align:center;" name="updateTicket"
                        id="updateTicket" type="submit" value="Update Ticket" disabled="">
                </div>
                </form>
            </div>
        </div>

    </div>
    <script type="text/javascript">

        document.getElementById("updateTicket").disabled = false;

        function enableBtn()
        {
            document.getElementById("updateTicket").disabled = false;
        }    
    </script>


</body>

</html>
<?php
    $conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());
    mysqli_close($conn);}
?>
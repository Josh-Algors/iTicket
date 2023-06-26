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
  $result = mysqli_query($conn,"select * from users ORDER BY id DESC");

  $val = mysqli_fetch_array($result);

  $username = $val['username'];
  // echo $_SERVER['HTTP_HOST'];
//   if(isset($_POST['transfer']))
//   {

//     function generateRandomString($length = 10) 
//     {
//       $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
//       $charactersLength = strlen($characters);
//       $randomString = '';

//       for ($i = 0; $i < $length; $i++)
//       {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//       }

//       return $randomString;
//     }

//     function generateRand($length = 6)
//     {
//       $characters = '0123456789';
//       $charactersLength = strlen($characters);
//       $randomString = '';

//       for ($i = 0; $i < $length; $i++)
//       {
//           $randomString .= $characters[rand(0, $charactersLength - 1)];
//       }

//       return $randomString;
//     }
  
//   }

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
                    echo '<a href="' . $previousPage . '">Go back</a>';
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
                        <table>
                            <tr>
                                <th>User ID &nbsp; &nbsp; &nbsp; &nbsp;</th>
                                <th>&nbsp; &nbsp; &nbsp; &nbsp; Name &nbsp; &nbsp; &nbsp; &nbsp;</th>
                                <th>&nbsp; &nbsp; &nbsp; &nbsp; Email &nbsp; &nbsp; &nbsp; &nbsp;</th>
                            </tr>
                            <tbody>
                                <?php
                                
                                // Check if there are any rows returned
                                if (mysqli_num_rows($result) > 0)
                                {
                                    mysqli_data_seek($result, 0);
                                    // Loop through each row and display the user data
                                    while ($row = mysqli_fetch_assoc($result)) 
                                    {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . " &nbsp; &nbsp; &nbsp; &nbsp;</td>";
                                        echo "<td>&nbsp; &nbsp; &nbsp; &nbsp; " . $row['username'] . " &nbsp; &nbsp; &nbsp; &nbsp;</td>";
                                        echo "<td>&nbsp; &nbsp; &nbsp; &nbsp; " . $row['email'] . " &nbsp; &nbsp; &nbsp; &nbsp;</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                // Display a message if no users are found
                                echo "<tr><td > No users found </td></tr>";
                                }

                            ?>
                            </tbody>
                        </table>

                    </div>
                </form>
                <br />

                <form method="post" action="registered.php">
                    <div class="submit">
                        <input class="btn btn-primary" style="color:#ffffff; text-align:center;" name="viewreg"
                            id="signInButton" type="submit" value="Manage Payments" disabled="">
                    </div>
                </form>

            </div>
        </div>

    </div>
    <script type="text/javascript">


    </script>


</body>

</html>
<?php
    $conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());
    mysqli_close($conn);}
?>
<?php

$conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());

if($_GET['download_link'])
{
  
    $download_link = $_GET['download_link'];
    $validate_link = mysqli_query($conn,"select * from transfers where (link='$download_link')");

    $data = mysqli_num_rows($validate_link);

    if($data > 0)
    {

        $info = mysqli_fetch_array($validate_link);

        $expires = date("Y-m-d H:i:sa", strtotime($info['expires_at']));
        $today = date("Y-m-d H:i:sa");
        if($info['expires_at'] > $today)
        {
            session_start();
            $_SESSION["download_link"] = $download_link;
            // echo $_SESSION["download_link"];
            header("location: dashboard/files.php");
        }
        else
        {
            echo "<script> alert('Link Expired!') </script>";

        }
        

    }
    
}
else if(!isset($_SESSION['login']))
{

    header("location: login/index.htm");
    
}


?>
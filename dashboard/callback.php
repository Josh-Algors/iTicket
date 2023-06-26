<?php
session_start();
$conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());

$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
}

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer sk_test_261b476a34373366572bbd0a3bd2951f84689140",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);

if(!$tranx->status){
  // there was an error from the API
  die('API returned error: ' . $tranx->message);
}

$amount = $_SESSION['amount'] / 100;
$ticket_no = $_SESSION['no_tickets'];
$user = $_SESSION['this_email'];
$ticket_id = $_SESSION['ticket_id'];

$trans_status = $tranx->data->status;

if(isset($_SESSION['waitlist_ticket_id']))
{
    $waitlist_id = $_SESSION['waitlist_ticket_id'];
    mysqli_query($conn,"update waitlist_logs set payment_status=1 where id = " . $waitlist_id . " ORDER BY id DESC");
}

if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value

    $user_info = mysqli_query($conn,"select * from users where (email='$user' or username='$user')");
    $users = mysqli_fetch_assoc($user_info); 
    $user_id = $users['id']; 

    $query="INSERT INTO `ticket_transactions`(`user_id`,`ticket_id`,`ticket_ref`, `ticket_status`, `amount`) VALUES('$user_id', '$ticket_id', '$reference', '$trans_status','$amount')";

    mysqli_query($conn,$query) or die("Could Not Perform the Query: ". mysqli_error($conn));

  $_SESSION['booked_ticket'] = "Ticket has been successfully booked. Check your email for more details!";
  return header("Location: ../dashboard/user.php");
}

$user_info = mysqli_query($conn,"select * from users where (email='$user' or username='$user')");
$users = mysqli_fetch_assoc($user_info); 
$user_id = $users['id']; 

$query="INSERT INTO `ticket_transactions`(`user_id`,`ticket_id`,`ticket_ref`, `ticket_status`, `amount`) VALUES('$user_id', '$ticket_id', '$reference', '$trans_status','$amount')";

mysqli_query($conn,$query) or die("Could Not Perform the Query");

$_SESSION['booked_ticket'] = "Ticket couldn't be processed at this time. Check back later!";
return header("Location: ../dashboard/user.php");

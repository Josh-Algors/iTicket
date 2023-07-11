<?php
session_start();
$conn=mysqli_connect('localhost','root','','iTicket') or die('Could not Connect My Sql:'.mysql_error());

$curl = curl_init();

if(isset($_POST['waitlist_id']))
{
    $waitlist_id = $_POST['waitlist_id'];

    $waitlist = mysqli_query($conn,"select * from waitlist_logs where id = " . $waitlist_id . " ORDER BY id DESC");
    $waitlist_info = mysqli_fetch_assoc($waitlist);

    $_SESSION['waitlist_ticket_id'] = $waitlist_info['ticket_id'];
    $_SESSION['waitlist_no_of_people'] = $waitlist_info['no_of_people'];
    $_SESSION['waitlist_payment_status'] = $waitlist_info['payment_status'];
}
                               
// $_SESSION['waitlist_ticket_id'] = $get_ticket['id'];
// $_SESSION['waitlist_ticket_name'] = $get_ticket['id'];
// $_SESSION['waitlist_no_of_people'] = $get_ticket['id'];
// $_SESSION['waitlist_payment_status'] = $get_ticket['id'];

$selected_ticket = (isset($_POST['ticket'])) ? $_POST['ticket'] : $_SESSION['waitlist_ticket_id'];

$tickets = mysqli_query($conn,"select id, ticket_name, ticket_cost, status from tickets where id =" . $selected_ticket . "");

$ticket_row = mysqli_fetch_assoc($tickets);
$_SESSION['no_tickets'] = (isset($_POST['no_tickets'])) ? $_POST['no_tickets'] : $_SESSION['waitlist_no_of_people'];

$email = $_SESSION['user_email'];
$amount = $ticket_row['ticket_cost'] * 100 * $_SESSION['no_tickets'];  //the amount in kobo. This value is actually NGN 300

$_SESSION['amount'] = $amount;
$_SESSION['this_email'] = ($_SESSION['user_email']) ?? $_SESSION['user'];
$_SESSION['ticket_id'] = (isset($_POST['ticket'])) ? $_POST['ticket'] : $waitlist_info['ticket_id'];

// echo $_SESSION['no_tickets'];
// echo $ticket_row['status'];
// echo $_SESSION['user_email'];

// return "";

if($ticket_row['status'] < $_SESSION['no_tickets'])
{
    $no_ticket = $_SESSION['no_tickets'];
    $ticket_id = $_SESSION['ticket_id'];
    $payment_status = 0;
    $approved = 0;
    $email = $_SESSION['user_email'];

    $check_user = mysqli_query($conn,"select * from users where (email='$email' or username='$email')");
    $user_info = mysqli_fetch_assoc($check_user);
    $user_id = $user_info['id'];
    $amount /= 100;
    $query="INSERT INTO `waitlist_logs`(`user_id`,`ticket_id`,`amount`, `no_of_people`, `payment_status`, `approved`) VALUES('$user_id', '$ticket_id', '$amount', '$no_ticket', '$payment_status', '$approved')";

    mysqli_query($conn,$query) or die("Could Not Perform the Query" . mysqli_error($conn));
    $_SESSION['insufficient'] = "Ticket(s) left is less than what you have selected. You have been added to the waitlist. Kindly check back later!";

    return header('Location: ../dashboard/book_ticket.php');
}

// url to go to after payment
$callback_url = 'http://localhost/iticket/dashboard/callback.php';  

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'email'=>$email,
    'callback_url' => $callback_url
  ]),
  CURLOPT_HTTPHEADER => [
    "authorization: Bearer sk_test_261b476a34373366572bbd0a3bd2951f84689140", //replace this with your own test key
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if(!$tranx['status']){
  // there was an error from the API
  print_r('API returned error: ' . $tranx['message']);
}

// comment out this line if you want to redirect the user to the payment page
print_r($tranx);
// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $tranx['data']['authorization_url']);

<?php
include "db.php";


              
/// bulksms.com.pk Text API URL


$username ="923415032045" ;
$password ="9542" ;
$sender = "UMSIT" ;
$message = $_POST['event'];
$department=$_POST['department'];
$alert="select phone from member where department='$department'";
$result = mysqli_query($con,$alert) or die(mysqli_error($con));
$mobileNumber='';
if(mysqli_num_rows($result) > 0){
   while($row = mysqli_fetch_assoc($result))
   {
      $mobileNumber .= $row['phone'].',';
   }
}


$mobileNumber = substr($mobileNumber,0,strlen($mobileNumber)-1);

$url = "http://bulksms.com.pk/api/sms.php?username=".$username."&password=".$password."&sender=".$sender."&mobile=".urlencode($mobileNumber)."&message=".urlencode($message)." ";


///Curl start 

$ch = curl_init();
$timeout = 30;
curl_setopt ($ch, 
CURLOPT_URL, $url);; 
curl_setopt ($ch, 
CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, 
CURLOPT_CONNECTTIMEOUT, $timeout);
$response = curl_exec($ch);
curl_close($ch); 
///Write out the response
echo "<br>" .$response;

?>



<?php

if(empty($_GET['delete']) AND empty($_GET['update']) AND empty($_GET['submitAlert']) AND empty($_POST['sendSms']))
{
	$myId=$_SESSION["myId"];
	$myUserName=$_SESSION["myUserName"];
}

$eventAlertObj=new eventAlert;

if(isset($_GET['delete']))
{
	$eventAlertObj->deleteEvent();
}

if(isset($_GET['update']))
{
	$eventAlertObj->editEvent();
}



if(isset($_GET['submitAlert']) OR isset($_POST['sendSms']))
{
	$eventAlertObj->insertEvent();
}


class eventAlert
{
public $id;
public $alert;
public $alertReciever;
public $alertGenerator;
public $date;

function insertEvent()
{
	if(isset($_GET['submitAlert']))
	{
		include 'db.php';
		include "dateTime.php";
		session_start();
		$myId=$_SESSION["myId"];
		
		$alert= $_GET['alert'];
		$alertReciever=$_GET['alertReciever'];
		
		$alert="INSERT INTO `eventalert` (`id`, `event`, `alertReciever`, `alertGeneratorId`, `date`) VALUES (NULL, '$alert', '$alertReciever', '$myId', '$time')";	
		$insertAlert=mysqli_query($con, $alert);
		if($insertAlert)
		{
			header("location:eventAlert.php?success=1");	
		}
	}
	
	
	
	if(isset($_POST['sendSms']))
	{
include "db.php";

/// bulksms.com.pk Text API URL


//$username ="923415032045" ;
//$password ="9542" ;
$username ="923445199844";
$password ="4852";


$sender = "UMSIT" ;
$message = $_POST['event'];
$department=$_POST['department'];
if($department=='*')
{
$alert="select distinct phone from member";
}

else
{
{
$alert="select distinct phone from member where department='$department'";
}	
}

$result = mysqli_query($con,$alert) or die(mysqli_error($con));
$mobileNumber='';
if(mysqli_num_rows($result) > 0){
   while($row = mysqli_fetch_assoc($result))
   {
   $mobileNumber .= $row['phone'].',';
   }



//$mobileNumber = substr($mobileNumber,0,strlen($mobileNumber)-1);

$url = "http://sendpk.com/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobileNumber."&sender=".urlencode($sender)."&message=".urlencode($message)."";

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

	}
	}
}

function editEvent()
{
	include 'db.php';
	$id=$_GET['eventId'];
	$event=$_GET['event'];
	$upd1="update eventalert set event='$event' where id='$id'";
	$upd1run=mysqli_query($con,$upd1);
	if($upd1run)
	{
		header("location:eventAlert.php?updated")	;
	}
}

function showEvent()
{
	include 'db.php';
	$alert2="select * from eventalert order by id desc";
	$showAlert=mysqli_query($con, $alert2);
	while($row2=mysqli_fetch_array($showAlert))
	{
		$id=$row2['alertGeneratorId'];
		$q2="select * from member where id='$id'";
		$q2run=mysqli_query($con, $q2);
		$result2=mysqli_fetch_array($q2run);
		$name=$result2['firstName']." ".$result2['lastName'];
		$eventId=$row2['id'];
		
	?>
    <div style=" background:white; margin-top:10px; box-shadow:5px 5px 5px #9A9999; padding:10px; margin-bottom:10px;">
    	<span style="float:left; color:#789DF3; font-weight:600;">
        	<?php echo $name; ?>
        </span>
        
        

         <span style="float:right;">

        	<?php echo $row2['date']; 
			
			if($_SESSION['myId']==$id)
			{
			?>
              
             <span  role="button" id="editbtn" onClick="navShow(<?php echo $eventId; ?>)" style="margin-right:5px;">
             	<img src="../img/edit.png" height="20px" width="20px"  title="edit">
            </span>
            <form action="eventAlertClass.php" method="get" style="float:right;"  name="event" id="eventDel<?php echo $eventId; ?>" >
            	<input type="hidden" name="eventId" value="<?php echo $eventId; ?>">
                <input type="button" name="delete" value="X" style="background:red; color:white; border:0; border-radius:5px;" title="delete" id="eventDel" onClick="del(<?php echo $eventId; ?>)">
                <input type="hidden" name='delete'>
            </form>

             <script>
				function del(id)
				{
					
					bootbox.confirm("Are you sure you want to delete this?", function(result){if (result) {$('#eventDel'+id).submit();}});
				}
             </script>
             
			 <?php }?>
        </span>
        <br>
        <span style=" width:100%;" id="event<?php echo $eventId; ?>">
        	<?php echo wordwrap($row2['event'],90,"<br>\n", true); ?>
        </span>
       
        <span style=" width:100%; display:none;" id="updField<?php echo $eventId; ?>">
        <form action="eventAlertClass.php" method="get">
             <input type="hidden" name="eventId" value="<?php echo $eventId; ?>">
        	<input name="event" value="<?php echo $row2['event']; ?>" class="form-control">
            <input type="submit" name="update" value="update" class="btn btn-success" style="margin-top:5px;">

        </form>
        
        </span>
       

        <?php
		if($_SESSION['position']=='Admin' OR $_SESSION['position']=='Staff')
			{
		?>
        
   		<br><br>
		<form action="eventAlertClass.php" method="post">
        	<input type="hidden" name="department" value="<?php echo $row2['alertReciever']; ?>">
            <input type="hidden" name="event" value="<?php echo $row2['event']; ?>">
            <input type="submit" name="sendSms" class="btn btn-default" value="Send sms alert">
        </form>
   		<?php
			}	
		?>
          <span style="float:right; margin-top:-10px; color:#FF6366;">
			        <?php
		if($_SESSION['position']=='Student' OR $_SESSION['position']=='teacher')
			{echo "<br>";}
		?>
        	Alert For:<?php if($row2['alertReciever']=='*') echo "All"; else echo $row2['alertReciever']?>
		</span>
    </div>
    <?php	
		
	}
?>
        <script>
		function navShow(eventId)
		{
				$("#event"+eventId).hide();
				$("#updField"+eventId).show();
				
		}
		</script>
<?php

}


function deleteEvent()
{ 
include 'db.php';
	$id=$_GET['eventId'];
	$del1="delete from eventalert where id='$id'";
	$del1run=mysqli_query($con,$del1);
	if($del1run)
	{
		header("location:eventAlert.php?deleted")	;
	}
}	
}


?>


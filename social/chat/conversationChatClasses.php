
<?php


$convObj=new conversation;

if(isset($_POST['delChat']))
{
 $convObj->deleteConversation();
}

if(empty($_GET['msgEdit']))
{
session_start();
}




if(isset($_POST['startConversation']))
{
$_SESSION['memberName']=$_POST['memberName'];
$_SESSION['memberId']=$_POST['memberId'];
$senderId=$_SESSION['myId'];
$recieverId=$_SESSION['memberId'];
	
	$convObj->checkConversation($senderId, $recieverId);
}

class conversation
{
public $conversationId;
public $senderId;
public $recieverId;
public $hash;

function checkConversation($senderId, $recieverId)
{
include 'db.php';

//if(empty($_GET['msgEdit']))
{

}

$q4="SELECT id from conversation where firstPersonId='$senderId' AND secondPersonId='$recieverId' OR firstPersonId='$recieverId' AND secondPersonId='$senderId';";

	$result1=mysqli_query($con,$q4);
	while($row1=mysqli_fetch_array($result1))
	{$conversationId=$row1['id'];}

	if(empty($conversationId))
		{
		 
		 $convObj1=new conversation;
		 $convObj1->createConversation();
		}
	else
	{
		$_SESSION['convId']=$conversationId;
		$st="update conversation set del1='0', del2='0' where id=$conversationId";
		$stRun=mysqli_query($con, $st);
			
		$messageObj2=new message;
		$messageObj2->showMsg();
	}
}

function createConversation()
{
include "db.php";
$senderId=$_SESSION['myId'];
$recieverId=$_SESSION['memberId'];
	include "dateTime.php";
	
	$q6="INSERT INTO `conversation` (`id`, `firstPersonId`, `secondPersonId`, `date`, `del1`, `del2`) VALUES (NULL, '$senderId', '$recieverId', '$time',0,0);";
	$q7=mysqli_query($con,$q6);
			
		 $convObj2=new conversation;
		 $convObj2->checkConversation($senderId, $recieverId);
			
}

function showConversation()
{
	include 'db.php';
	$myId=$_SESSION['myId'];
	
	?>
    <table id='contacts' class="table-responsive table-hover" style="margin-left:-10px; width:310px">
	<tr>
		<th bgcolor="#4169e1" style="color: white;" colspan="2">
		 &nbsp;	Chats
        </th>
	</tr>
	<?php
	
	$c="select * from conversation where (firstPersonId='$myId' OR secondPersonId='$myId') AND (del1!='$_SESSION[myId]' AND del2!='$_SESSION[myId]')";
	$crun=mysqli_query($con, $c);
	while($row=mysqli_fetch_array($crun))
	{
		
		if($myId!=$row['firstPersonId'])
		{
			$secondPersonId=$row['firstPersonId'];
		}
		else
		{
			$secondPersonId=$row['secondPersonId'];	
		}
		$c2="select * from member where id=$secondPersonId";
		$crun2=mysqli_query($con, $c2);
		$result=mysqli_fetch_array($crun2);
		$memberName=$result['firstName']." ".$result['lastName'];
		?>
        <tr>
        	<th>
        	<a href="chatEdit.php?name='<?php echo $memberName; ?>'&msgEdit=1&sid=<?php echo $secondPersonId; ?> " style="text-decoration: none; color: #3a5795;"> 
            <div style=" height:50px; width:100%; padding-top:12px;">&nbsp;
		<?php 
			echo $result['firstName']." ".$result['lastName']."<br>";
		?>
        </div>
        </a>
        	</th>
            <th style="width:20px;">
            
                        <form action="conversationChatClasses.php?msgEdit=2" method="post" style="" id="conDel<?php  echo $row['id']; ?>">
                            <input type="hidden" name="conId" value="<?php  echo $row['id']; ?>"/>
                           <input type="hidden" name="delChat">
                            <input type="button" name="delChat" Value="X" class="btn btn-danger" title="delete chat" onClick="delNoti(<?php  echo $row['id']; ?>)"/>
                        </form>
                        
                        <script>
                        	function delNoti(id)
							{
							bootbox.confirm("Are you sure you want to delete this?", function(result){if(result) {$('#conDel'+id).submit();}});
							}
                        </script>
            </th>
        </tr>
	<?php
	}
	?>
    </table>
    <?php
}

function deleteConversation()
{
	include "db.php";
	session_start();
	$conversationId=$_POST['conId'];
	$myId=$_SESSION['myId'];
	
	$check="select * from conversation where id='$conversationId'";
	$checkRun=mysqli_query($con, $check);
	$checkResult=mysqli_fetch_array($checkRun);
	$firstPersonId=$checkResult['firstPersonId'];	
	
	if($firstPersonId==$myId)
	{
		$u1="update conversation set del1='$myId' where id='$conversationId'";
		$u1Run=mysqli_query($con, $u1);
		
	}
	
	else
	{
		$u2="update conversation set del2='$myId' where id='$conversationId'";
		$u2Run=mysqli_query($con, $u2);
	}
		
			$u="select senderId from message where conversationId='$conversationId'";
			$uRun=mysqli_query($con, $u);
			
			$result=mysqli_fetch_array($uRun);
			
			$senderId=$result['senderId'];

				if($senderId==$myId)
				{
					$u1="update message set del1='$myId' where conversationId='$conversationId'";
					$u1Run=mysqli_query($con, $u1);	
				}
				else
				{
					$u2="update message set del2='$myId' where conversationId='$conversationId'";
					$u2Run=mysqli_query($con, $u2);		
				}
		
					//$q="delete from message where del1!=0 AND del2!=0";
					//$q1=mysqli_query($con,$q);
		
		
		
	$c="delete from conversation where del1!=0 AND del2!=0";
	$cRun=mysqli_query($con, $c);
	if($cRun)
	{
		header("location:chatEdit.php?name=&msgEdit=2&sid=&success=1");
	}
	else echo "not";
	
	header("location:chatEdit.php?name=&msgEdit=2&sid=&success=1");
	
}

}
////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

$messageObj=new message;
if(isset($_POST['show']))
{
$messageObj->showMsg();	

}

if(isset($_POST['saverecord']))
{
$messageObj->insertMsg();
}

if(isset($_POST['delete']))
{
$messageObj->deleteMsg();
}




class message
{
public $messageId;
public $message;
public $hash;
public $senderName;
public $senderId;
public $recieverId;
public $status;
public $time;

function insertMsg()
{
include 'db.php';
include "dateTime.php";
//session_start();
echo $senderName=$_SESSION['myName'];
echo $senderId=$_SESSION['myId'];
echo $recieverId=$_SESSION['memberId'];
$recieverName=$_SESSION['memberName'];
$convId=$_SESSION['convId'];
$message=$_POST['msgs'];


//if($message!=' ')
{
$q="INSERT INTO `message` (`id`, `conversationId`, `message`, `senderId`, `senderName`, `recieverId`, `status`, `date`, `del1`, `del2`) VALUES (NULL, '$convId', '$message', '$senderId', '$senderName', '$recieverId', '1', '$time', '0', '0')";
 $q1=mysqli_query($con,$q);
 if($q1)
 echo "inserted";
 else echo "not";
 		$chatR="update conversation set del1=0, del2=0 where id='$convId'";
		$resultR=mysqli_query($con,$chatR);
		if($resultR)
		{
			header("location:chatEdit.php?name=$recieverName&msgEdit=1&sid=$recieverId");
			}
}
}
//////////////////////////////////////
function showMsg()
{
	include 'db.php';
	
	if(empty($_GET['msgEdit']))
	{
	include "member.php";
	}
	
	else{echo "<br><br>";}
	
	//session_start();
	$conId=$_SESSION['convId'];
	?>
    

  
            <span style=" position:absolute; z-index:99; margin-top:-21px; margin-left:75px;">
				<?php
                if(empty($_GET['msgEdit']))
                {
            		$sid=$_SESSION['memberId'];
            		$name=$_SESSION['memberName'];
                
                ?>
                
                <span style=" float:left; margin-left:-220px; color: white; font-weight:600;">
                   <a href="chat/profile.php?profile=1&id=<?php echo $sid; ?>" style="text-decoration: none; color: white;"> <?php echo wordwrap($_SESSION['memberName'],30,"<br>\n", true); ?>
                </span>
                
                    <a href="chat/chatEdit.php?name='<?php echo $name; ?>'&msgEdit=1&sid=<?php echo $sid; ?>" style="margin-left:35px;" title="Delete chat">
                     <img src="chat/img/bin.png" height="15px" width="15px;">
                    </a>
            </span>
            
            <?php
			}
			?>
    
	<div style="background:rgba(109,34,247,1.00); position:absolute; width:305px; ">
    	<?php 
			if(empty($_GET['msgEdit']))
			{
			$memberObj3=new member;
			$memberObj3->statusCheck();

			$memberObj3->lastseen();
			
			}
		?>

	</div>
    <br>
    
    <?php
	if(isset($_GET['msgEdit']))
	{
	?>
  <div style="overflow-y:scroll; width:320px;;height:400px;margin-top:-40px; border-bottom:1px  solid rgba(119,119,119,1.00);"> 
	
    <?php
	}
	
	$msgObj=new message;
	$msgObj->checkMsgStatus();

	$q3="select * from message where conversationId='$conId' AND del1!='$_SESSION[myId]' AND del2!='$_SESSION[myId]'";
	 	 $result=mysqli_query($con,$q3);

	 	 while($row=mysqli_fetch_array($result))
	 	 	{
	 	 		if($_SESSION["myId"]==$row['senderId'])
	 			 	{
	 			 		?>
	 			 	<div id='sender'>
						<table border="0" width="245px" >
                        	<tr style="height: 20px;">
                            	<td>
                                	<?php
                                    	if(isset($_GET['msgEdit']))
										{
											?>
							<input type=checkbox class="checkbox" name="checkbox[]" value=<?php echo $row['id']; ?> >
							<input type=hidden class="checkbox" name="senderMsg[]" value=<?php echo $row['id']; ?> >
                            		
									<?php
										}
									?>
                                </td>
                                <td align="left">
                                    <b>
                                   	 <font color="gray" size="2">
                                		&nbsp; me:
                                   	 </font>
                                    </b>
                                </td>
                                <td align="right">
                                    <b>
                                     <i>
                                         <font color="gray" size="1">
                                            <?php echo $row['date']; ?>
                                         </font>
                                      </i>
                                    </b>  
                                </td>
                            </tr>
                            
                            <tr style="height:20px">
                            	<td colspan="3" align="left" >
                                	<div style="margin-left:5px;" >
										<?php echo wordwrap($row['message'],30,"<br>\n", true); ?>
                                     </div>
                                </td>
                            </tr>
                            
                            <tr style="height: 20px; ">
                            	<td colspan="3" align="right">
										<?php 
                                        if ($row['status']==0)
                                            {echo "<font color='white'><i>seen</i></font>";}
                                        ?>
                                </td>
                            </tr>
                        </table>
		 				


	 			 	</div>
	 			 	<?php
	 			 	}

	 			else 
	 				{
	 				?>	
	 				<div id='recv' style="" >

						<table border="0" width="245px" >
                        	<tr style="height: 20px;">
                                <td>
                                	<?php
                                    	if(isset($_GET['msgEdit']))
										{
											?>
							<input type=checkbox class="checkbox" name="checkbox[]" value=<?php echo $row['id']; ?> >
                            		
									<?php
										}
									?>
                                </td>
                            	<td align="left">
                                    <b>
                                   	 <font color="gray" size="2">
                                		&nbsp;<?php echo $row['senderName']; ?>
                                   	 </font>
                                    </b>
                                </td>
                                <td align="right">
                                    <b>
                                     <i>
                                         <font color="gray" size="1">
                                            <?php echo $row['date']; ?>
                                         </font>
                                      </i>
                                    </b> 
                                </td>
                            </tr>
                            
                            <tr style="height:20px">
                            	<td colspan="2" align="left" >
                                	<div style="margin-left:5px;" >
										<?php echo wordwrap($row['message'],30,"<br>\n", true); ?>
                                     </div>
                                </td>
                            </tr>
                            
                        </table>

	 				</div>
    
	 				<?php
	 				}
					?>
            		<?php
			}
			
   
	if(isset($_GET['msgEdit']))
	{
			
?>
</div>
<?php
	}


}
////////////////////////////////////////////




function deleteMsg()
{
if(isset($_REQUEST['delete']))
	{
	include 'db.php';
	if(isset($_REQUEST['checkbox']))
	{
	$checkbox = $_REQUEST['checkbox'];
	
	for($i=0;$i<count($checkbox);$i++)
		{
			$d=$checkbox[$i];

			echo $myId=$_SESSION['myId'];
	
			$u="select senderId from message where id='$d'";
			$uRun=mysqli_query($con, $u);
			
			$result=mysqli_fetch_array($uRun);
			
			$senderId=$result['senderId'];

				if($senderId==$myId)
				{
					$u1="update message set del1='$myId' where id='$d'";
					$u1Run=mysqli_query($con, $u1);	
				}
				else
				{
					$u2="update message set del2='$myId' where id='$d'";
					$u2Run=mysqli_query($con, $u2);		
				}
		
					$q="delete from message where del1!=0 AND del2!=0";
					$q1=mysqli_query($con,$q);
		}
	}
	$sid=$_SESSION['memberId'];
	$name=$_SESSION['memberName'];
	header("location:chatEdit.php?name=$name&msgEdit=1&sid=$sid&success=1");
	
	
	}
}

function checkMsgStatus()
{
	include 'db.php';
	$memberId=$_SESSION["memberId"];
	$myId=$_SESSION["myId"];

	 $u1="update message set status='0' where senderId='$memberId' AND recieverId='$myId'";
 	 $urun=mysqli_query($con,$u1);

 	
}

}
?>
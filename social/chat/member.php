<?php

$memberObj=new member;
$profilePicObj=new profilepic;

if(isset($_POST['submit']))
{
	$memberObj->login();
}

if(isset($_POST['update']))
{
	$memberObj->updateProfile();	
}

if(isset($_POST['updPwdF']))
{
	$memberObj->forgetPassword();
}

if(isset($_POST['picUpload']))
{
	$profilePicObj->picInsert();
}

if(isset($_POST['picChange']))
{
$profilePicObj->changeProfilePic();	
}

if(isset($_POST['delChange']))
{
	$profilePicObj->picDelete();
}

if(isset($_POST['addMember']))
{
	$memberObj->addMember();
}

if(isset($_POST['signup']))
{
	$memberObj->signup();
}

if(isset($_POST['changePwd']))
{
	$memberObj->changePassword();
}

if(isset($_POST['unblock']) OR isset($_POST['block']))
{
$memberObj->banMemeber();echo "hi";	
}


class member
{
public $id;
public $firstName;
public $lastName;
public $email;
public $phone;
public $password;
public $lastseen;
public $cnic;
public $dob;
public $gender;
public $position;
public $ban;
public $city;
public $department;	 
public $question;
public $answer;

function statusCheck()
{
	include 'db.php';
	$id=$_SESSION['memberId'];
	$q3="select lastseen from member where id=$id";
 	$result=mysqli_query($con,$q3);

 	  	 while($row=mysqli_fetch_array($result))
 	 {
 	 	$storetime=$row['lastseen'];
 	 }

 	 if(!empty($storetime))
 	 {
	 date_default_timezone_set('etc/gmt+7');
	 $time=date('h:i A j-m-y');
	 $strtime = strval($time);
 	 $check=strcmp($storetime,$strtime);
 	 if($check==0)
 	 {
 	 	echo "<font color=red>online</font>";
 	 }
 	 else
 	 	{echo "<font color=white>last seen at ".$storetime."</font>"; }
 	}
}
/////////////////////////////////////
function login()
{
		session_start();
		$user=$_POST['user'];
		$pwd=$_POST['pwd'];
		include 'db.php';
		$q8="select * from member where email='$user' AND password='$pwd' AND ban='0'";
		$result3=mysqli_query($con,$q8);
		while($row1=mysqli_fetch_array($result3))
		{
			$id=$row1['id'];
			$name=$row1['firstName'].' '.$row1['lastName'];
			$position=$row1['position'];
		}
		 if (mysqli_num_rows($result3)==null) 
		 {
			header("location:../login.php?msg=1");
		 }
	
	else{
		$_SESSION["myName"]=$name;
		$_SESSION["myUserName"]=$_POST['user'];
		$_SESSION["pwd"]=$_POST['pwd'];
		$_SESSION["myId"]=$id;
		$_SESSION["position"]=$position;
		header("location:../index.php");
		}
	
}
/////////////////////////////////////
function addMember()
{
include 'db.php';
$ch="select id from member where email='$_POST[email]'";
$chr=mysqli_query($con, $ch);

$ch2="select id from member where cnic='$_POST[cnic]'";
$chr2 =mysqli_query($con, $ch2);

$email=mysqli_num_rows($chr);
$cnic=mysqli_num_rows($chr2);

if($email==0 AND $cnic==0)
{
	$q="INSERT INTO `member` (`id`, `firstName`, `lastName`, `email`, `phone`, `password`, `lastseen`, `cnic`, `dob`, `gender`, `position`, `ban`, `department`, `city`, `securityQuestion`, `answer`) VALUES (NULL, '0', '0', '$_POST[email]', '0', '0', '0', '$_POST[cnic]', '0', '0', '$_POST[position]', '0', '0', '0', '0', '0')";

	$q2=mysqli_query($con,$q);
	if($q2)
	{
		header("location:userAddBlock.php?add=1&added=1");
	}
	else
		{header("location:userAddBlock.php?add=1&notadded=1");}
}

else
{
	if($email>0 AND $cnic>0)
	{header("location:userAddBlock.php?add=1&email=1&cnic=1");}
	
	elseif($cnic>0)
	{header("location:userAddBlock.php?add=1&cnic=1");}
	
	elseif($email>0)
	{header("location:userAddBlock.php?add=1&email=1");}
	
}

}
/////////////////////////////////////
function showMember($view)
{
	include 'db.php';
	
	$myid=$_SESSION["myId"];
	if($view=="Admin" OR $view=="Staff" OR $view=="Teacher" OR $view=="Student")
	 {
		$q3="select * from member where  id!=$myid AND password!='0' AND position='$view' order by firstName asc";
		$result=mysqli_query($con,$q3);
	 }
	 else
	 {
		$q3="select * from member where id!=$myid OR password!=0";
		$result=mysqli_query($con,$q3);
	 }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////list view 1 to contact////////////////////////////////////////////////

if($view=="Admin" OR $view=="Staff" OR $view=="Teacher" OR $view=="Student")
{
 	 ?>


<table border="0" id='contacts' class="" style="width:100%;">
 	 <?php
 	 // to count unread msg

 	 while($row=mysqli_fetch_array($result))
 	 {

		 	 $memberId=$row['id'];
		 	 $memberName=$row['firstName']." ".$row['lastName'];
		 	 $newsms=0;
		 	//if(isset($_POST['counter']))
		 	 {
	 	 	//echo $_POST['counter'];
		 	 $q4="select * from message where senderId=$memberId AND recieverId=$myid AND senderId!=$myid AND status=1";
		 	 $result1=mysqli_query($con,$q4);
		 	 $newsms=mysqli_num_rows($result1);
		 	 } 
		?>

	<?php

			 ?>
            <tr style="height:90px; border-bottom:4px solid white;">
            <td>
            	<div class="row" style="float:left;">
            		<span style="height:70px; width:70px; margin-left:30px; margin-top:20px;">
                    	<?php 
						$profilePicObj1=new profilepic;
						$profilePicObj1->picShow($memberId, '2');
						?>
                    </span>
                </div>	
		 	 <div class="row" style="background:; width:200px; float:right; margin-right:50px;">
             
    		 	<span class='col-md-12' style="float:left">

		 			<a href="chat/profile.php?id=<?php echo $memberId; ?> " style=" font-size:16px; font-weight:600; text-decoration: none; color: #3a5795;">
		 				<?php echo $row['firstName'].' '.$row['lastName']; ?>
		 			</a>
		 		</span>

                

                <span class='col-md-12'  style="height:10px; margin-bottom:10px;">
					<?php
                         if($newsms>0)
                 
                    {
                        ?>
                            
                                <Font color=red>(<?php echo $newsms; ?>) new msg </font> 
                            
                    <?php } ?>
                </span>

	  <span class="col-md-12" style="" >
        <input type=hidden value='<?php echo $myid; ?>' name='reciever' id='myId'>
         <input type=hidden value='<?php echo $memberId; ?>' name='sender' id='memberId'>
        <input type=hidden value='<?php echo $memberName; ?>' name='memberName' id='memberName<?php echo $memberId; ?>'>
         <input type=submit name=update value='start chat' class="btn btn-info chatbutton" id='<?php echo $memberId; ?>' >
      </span>
      </div>
      </td>
      </tr>
      
    <?php

 }
 
?>
</table>
<?php
}

//////////////////////////////////////////////////new msg///////////////////////////////////////////////////

if($view=="*")
{
 	 ?>


<table border="0" id='contacts' class="" style="width:100%;">
 	 <?php
 	 // to count unread msg

 	 while($row=mysqli_fetch_array($result))
 	 {

		 	 $memberId=$row['id'];
		 	 $memberName=$row['firstName']." ".$row['lastName'];
		 	 $newsms=0;

		 	 $q4="select DISTINCT status from message where senderId=$memberId AND recieverId=$myid AND senderId!=$myid AND status=1";
		 	 $result1=mysqli_query($con,$q4);
		 
		 	$q5="select  status from message where senderId=$memberId AND recieverId=$myid AND senderId!=$myid AND status=1";
			$q6=mysqli_query($con, $q5);
			
			 $newsms=mysqli_num_rows($q6);
			while($row5=mysqli_fetch_array($result1))
			{
		 
				$row5['status'];
				if($row5['status']==1)
				{
			
		?>
			
            <tr style="height:90px; border-bottom:4px solid white;">
            <td>
            	<div class="row" style="float:left;">
            		<span style="height:70px; width:70px; margin-left:30px; margin-top:20px;">
                    	<?php 
						$profilePicObj1=new profilepic;
						$profilePicObj1->picShow($memberId, '2');
						?>
                    </span>
                </div>	
		 	 <div class="row" style="background:; width:200px; float:right; margin-right:50px;">
             
    		 	<span class='col-md-12' style="float:left">

		 			<a href="chat/profile.php?id=<?php echo $memberId; ?> " style=" font-size:16px; font-weight:600; text-decoration: none; color: #3a5795;">
		 				<?php echo $row['firstName'].' '.$row['lastName']; ?>
		 			</a>
		 		</span>

                

                <span class='col-md-12'  style="height:10px; margin-bottom:10px;">
					<?php
                         if($newsms>0)
                 
                    {
                        ?>
                            
                                <Font color=red>(<?php echo $newsms; ?>) new msg </font> 
                            
                    <?php } ?>
                </span>

	  <span class="col-md-12" style="" >
        <input type=hidden value='<?php echo $myid; ?>' name='reciever' id='myId'>
         <input type=hidden value='<?php echo $memberId; ?>' name='sender' id='memberId'>
        <input type=hidden value='<?php echo $memberName; ?>' name='memberName' id='memberName<?php echo $memberId; ?>'>
         <input type=submit name=update value='start chat' class="btn btn-info chatbutton hidenew" id='<?php echo $memberId; ?>' >
      </span>
      </div>
      </td>
      </tr>
      
    <?php
				}
		}
		

 }
 
?>
</table>
<?php
}
?>
	       <script>
                 $('.chatbutton').click(function(){
				var element = $(this);
  				var memberId = element.attr("id");
				var myId= $('#myId').val(); 
				var memberName= $('#memberName'+memberId).val();
				$('#chatwin').show(500); 
				$('#member').hide();
				$('#memberHead').hide();
						
							$.ajax({
							url:'chat/conversationChatClasses.php',
							type:'POST',
							async:false,
							data:{
								'startConversation':1,
								'memberId':memberId,
								'myId':myId,
								'memberName':memberName
								},
							success:function (r){
								//alert("hi");
								$('#showMsg').html(r);
									}
						});
				//showdata(memberId,memberName);

			  });
			  </script>
<?php
}
/////////////////////////////////////
function lastseen()
{
	 //lastseen
	include 'db.php';
	date_default_timezone_set('etc/gmt+7');
 	$time=date('h:i A j-m-y');
	$recieverId=$_SESSION["myId"];
	$u2="update member set lastseen='$time' where id=$recieverId";
 	$urun1=mysqli_query($con,$u2);
	
}
///////////////////////////////////

function viewProfile($id)
{
	
	include 'db.php';
	$p="select * from member where id='$id'";
	$prun=mysqli_query($con, $p);
	$pResult=mysqli_fetch_array($prun);
	
	?>
<?php
	if($_SESSION['myId']==$id)
	{
?>
    <button id="editBtn" style="float:right; margin-top:10px; margin-bottom:10px;margin-left:10px" class="btn btn-primary">
    	Edit Profile	
    </button>
    
     <button id="PwdChg" style="float:right; margin-top:10px; margin-bottom:10px; margin-left:10px" class="btn btn-primary">
    	Change password	
    </button>
    
    <script>
	$("#editBtn").click(function(){
		
		$("#view").hide();
		$("#edit").show();
		$("#editBtn").hide();
		$("#PwdChg").hide();
		$("#pwdChanger").hide();
		$('#goBackprofile').hide();


		
		});
		
		$("#PwdChg").click(function(){
		
		$("#view").hide();
		$("#edit").hide();
		$("#PwdChg").hide();
		$("#pwdChanger").show();
		$("#editBtn").hide();
		
		});
		
	
	</script>
    <?php
	}
	$myId=$_SESSION['myId'];
	?>
<form action="member.php" method="post">    
<table class="table table-striped" style="display:none; margin-top:10px;" id="pwdChanger">
<tr><td><input type="password" name="oldPwd" class="form-control" placeholder="Enter old password"></td></tr>
<tr><td><input type="password" name="newPwd" class="form-control" placeholder="Enter new password"></td></tr>
<tr><td><input name="myId" class="form-control" type="hidden" value="<?php echo $myId; ?>"></td></tr>
<tr><td>
    <a id="goBack1" role="button" class="btn btn-default"> Go back</a>

    <input name="changePwd" type="submit" class="btn btn-success">
    </td></tr>

                <script>
					$("#goBack1").click(function(){
					$("#view").show();
					$("#edit").hide();
					$("#editBtn").show();
					$("#PwdChg").show();
					$("#pwdChanger").hide();

										
					});
				</script>
</table>
</form>
    
    <table width="500px" height="400px" style="background: #dbe0e2; margin-top:15px;" class="table table-striped" id="view">
    	<tr>
        	
            <td style="width:30%">
            	First Name
            </td>
            
            <td>
            	<?php echo $pResult['firstName']; ?>
            </td>
            
        </tr>
        
         <tr>
        	
            <td>
            	Last Name
            </td>
            
            <td>
            	<?php echo $pResult['lastName']; ?>
            </td>
            
        </tr>
    	
        <tr>
        	
            <td>
            	Email
            </td>
            
            <td>
            	<?php echo $pResult['email']; ?>
            </td>
            
        </tr>
            	<tr>
        	
            <td>
            	Date of Birth
            </td>
            
            <td>
            	<?php echo $pResult['dob']; ?>
            </td>
            
        </tr>
        <?php 
			if($_SESSION['myId']==$pResult['id'])
			{
		?>
           <tr>
        	
            <td>
            	Phone #
            </td>
            
            <td>
            	<?php echo $pResult['phone']; ?>
            </td>
            
        </tr>
        <?php
			}
			?>
       
           	<tr>
        	
            <td>
            	Gender
            </td>
            
            <td>
            	<?php echo $pResult['gender']; ?>
            </td>
            
        </tr>
        
        <tr>
        	
            <td>
            	Position
            </td>
            
            <td>
            	<?php echo $pResult['position']; ?>
            </td>
            
        </tr>
        
        <tr>
        	
            <td>
            	Department
            </td>
            
            <td>
            	<?php echo $pResult['department']; ?>
            </td>
            
        </tr>
                <tr>
        	
            <td>
            	City
            </td>
            
            <td>
            	<?php echo $pResult['city']; ?>
            </td>
            
        </tr>

        
    </table>
    
    <form action="member.php?id=<?php echo $id; ?>" method="post">
    
    <table width="500px" height="400px" style="background: #dbe0e2; margin-top:15px; display:none;" class="table table-striped" id="edit">
    	<tr>
        	
            <td style="width:30%">
            	First Name
            </td>
            
            <td>
            	<input value="<?php echo $pResult['firstName']; ?>" name="fname" required>
            </td>
            
        </tr>
        
         <tr>
        	
            <td>
            	Last Name
            </td>
            
            <td>
            	<input name='lname' value="<?php echo $pResult['lastName']; ?>" required>
            </td>
            
        </tr>
    	
        <tr>
        	
            <td>
            	Phone
            </td>
            
            <td>
        <input name='phone' value="<?php echo $pResult['phone']; ?>"  required>
            </td>
            
        </tr>
        
        <tr>
        	
            <td>
            	Date of Birth
            </td>
            
            <td>
            	<input name='dob' value="<?php echo $pResult['dob']; ?>" required>
            </td>
            
        </tr>
        
        <tr>
        	
            <td>
            	Gender
            </td>
            
            <td>
            	<input name='gender' value="<?php echo $pResult['gender']; ?>" required>
            </td>
            
        </tr>
        
        <tr>
        	
            <td>
            	Department
            </td>
            
            <td>
            	<input name='department' value="<?php echo $pResult['department']; ?>" required>
            </td>
            
        </tr>
                        <tr>
        	
            <td>
            	City
            </td>
            
            <td>
            	<input name="city" value="<?php echo $pResult['city']; ?>" required>
            </td>
            
        </tr>

        
        <tr>
            <td colspan="2" align="center">
                <a id="goBack" role="button" class="btn btn-default"> Go back</a>
            	<input type="submit" name="update" value="Update" class="btn btn-default">
                
                <script>
					$("#goBack").click(function(){
					$("#view").show();
					$("#edit").hide();
					$("#editBtn").show();
					$("#PwdChg").show();
					$("#pwdChanger").hide();

										
					});
				</script>
            </td>
        </tr>
        
    </table>
    </form>
 
    <?php
}


function updateProfile()
{
	include "db.php";
	if(isset($_POST['update']))
	{
		$u="update member set firstName='$_POST[fname]', lastName='$_POST[lname]', phone='$_POST[phone]', dob='$_POST[dob]', gender='$_POST[gender]', department='$_POST[department]', city='$_POST[city]' where id='$_GET[id]'";		
		$urun=mysqli_query($con, $u);
		if($urun)
		{
			$id=$_GET['id'];
			header("location:profile.php?id=$id&profSuccess=1");	
		}
		else "not";
	}	
	
}

function changePassword()
{
include 'db.php';
echo $oldpwd=$_POST['oldPwd'];
echo $newpwd=$_POST['newPwd'];
echo $myId=$_POST['myId'];

$q="select * from member where id='$myId'  AND password='$oldpwd'";
$q2=mysqli_query($con, $q);
if(mysqli_num_rows($q2)>0)
{
	$up="update member set password='$newpwd' where id='$myId'";
	$upRun=mysqli_query($con,$up);
	if($upRun)
	{
		header("location:profile.php?id=$myId&pwdChange=1");
	}
	else
	{
		header("location:profile.php?id=$myId&pwdFailed=1");
	}
}
else
{header("location:profile.php?id=$myId&pwdFailed=1");}


}

function forgetPassword()
{
	include 'db.php';
			echo $cnic=$_POST['cnic'];
			echo $question=$_POST['question'];
			echo $answer=$_POST['answer'];
			echo $password=$_POST['password'];
			
			$s="select * from member where securityQuestion='$question' AND answer='$answer' AND cnic='$cnic'";
			$srun=mysqli_query($con, $s);
			echo mysqli_num_rows($srun);
			if(mysqli_num_rows($srun)>0)
				{
				$u1="update member set password='$password' where cnic='$cnic'";
				$urun2=mysqli_query($con, $u1);
				if($urun2)
				{header("location:../login.php?changed");}
				else
				{header("location:../login.php?pfailed");}
				}
			else
				{header("location:../login.php?pfailed");}

}


function signup()
{

include 'db.php';
if($_POST['pwd']==$_POST['rpwd'])
{
	


$firstName=$_POST['fname'];
$lastName=$_POST['lname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=$_POST['pwd'];
$lastseen=0;
$cnic=$_POST['cnic'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$position=$_POST['position'];
$ban=0;
$city=$_POST['city'];
$session=$_POST['session'];
$department=$_POST['department'];	 
$question=$_POST['question'];
$answer=$_POST['answer'];

		$se="select id from member where cnic='$cnic' AND position='$position' AND email='$email' AND password=0";
		$seRun=mysqli_query($con, $se);
		$seResult=mysqli_fetch_array($seRun);
		if(mysqli_num_rows($seRun)>0)
		{
			$updU="update member set firstName='$firstName', lastName='$lastName', phone='$phone', password='$password', lastseen='$lastseen', dob='$dob', gender='$gender', ban='$ban', department='$department', city='$city', securityQuestion='$question', answer='$answer' WHERE cnic='$cnic' AND password=0";
			$updUrun=mysqli_query($con,$updU);
			if($updUrun)
			{header("location:../login.php?sSuccess");}
			else
			{header("location:../login.php?sFail");}
		}
	
		else
		{header("location:../login.php?sFail");}
}
else
	{
	header("location:../login.php?pnotmatch");
	}
}

function banMemeber()
{
	include 'db.php';
	
		$myid=$_SESSION['myId'];
		$q3="select * from member where id!=$myid order by firstName asc";
		$result=mysqli_query($con,$q3);
	?>
		<table border="0" id='contacts' class="" style="width:100%;">
 	<?php
 	 // to count unread msg

 	 while($row=mysqli_fetch_array($result))
 	 {

		 	 $memberId=$row['id'];
		 	 $memberName=$row['firstName']." ".$row['lastName'];

			 ?>
            <tr style="height:90px; border-bottom:4px solid #7058a3;">
            <td>
            	<div class="row" style="float:left;">
            		<span style="height:70px; width:70px; margin-left:30px; margin-top:20px;">
                    	<?php 
						$profilePicObj1=new profilepic;
						$profilePicObj1->picShow($memberId, '');
						?>
                    </span>
                </div>	
		 	 <div class="row" style="background:; width:200px; float:right; margin-right:50px;">
             
    		 	<span class='col-md-12' style="float:left">

		 			<a href="profile.php?id=<?php echo $memberId; ?> " style=" font-size:16px; font-weight:600; text-decoration: none; color: #3a5795;">
		 				<?php echo $row['firstName'].' '.$row['lastName']; ?>
		 			</a>
		 		</span>

                

		<?php
			if($row['ban']==0)
			{
		?>
	  <span class="col-md-12" style="" >
       <form action="member.php" method="post">
         <input type=hidden value='<?php echo $memberId; ?>' name='id' id='memberId'>
         <input type=submit name='block' value='Block' class="btn btn-default" style="background:#7058a3; color:white;"  >
       </form>
      </span>
      <?php } 
	  
		else
		{	  
	  ?>
     <span class="col-md-12" style="" >
     	<form action="member.php" method="post">
         <input type=hidden value='<?php echo $memberId; ?>' name='id' id='memberId'>
         <input type=submit name='unblock' value='UnBlock' class="btn btn-default"  >
        </form>
      </span>
      <?php }?>
      </div>
      </td>
      </tr>
      
    <?php

 }
 
?>
</table>
<?php

if(isset($_POST['block']))
{
	$b="update member set ban=1 where id='$_POST[id]'";
	$brun=mysqli_query($con, $b);
	if($brun)
	{header("location:userAddBlock.php?block=1&success=1");}
}

if(isset($_POST['unblock']))
{
	$b="update member set ban=0 where id='$_POST[id]'";
	$brun=mysqli_query($con, $b);
	if($brun)
	{header("location:userAddBlock.php?block=1&success=2");}
}


}

}



////////////////////////////////////////////////////
///////////////////////////////////////////////////

class profilepic
{
public $name;
public $picHolderId;	
public $date;
public $currentStatus;

function picInsert()
{
	include 'db.php';
	
	if(isset($_POST['picUpload']))
{
	session_start();
	include 'dateTime.php';
	$picHolderId=$_SESSION['myId'];
	$name=$_SESSION['myName'];
	$date=$time;
	
	 $targetfolder = "profilePic/";
 
	 $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
	 
	if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
	 {
		 $name=basename( $_FILES['file']['name']);
		 //echo "<img src='profilePic/$name' height='50px' width='50px' >";
		 //echo "The file ". basename( $_FILES['file']['name']). " is uploaded";
		 $p1="UPDATE `profilepic` SET `currentStatus` = 'inactive' WHERE `profilepic`.`picHolderId` = '$picHolderId'";
		 $p2=mysqli_query($con, $p1);


		 $i="INSERT INTO `profilepic` (`id`, `name`, `picHolderId`, `date`, `currentStatus`) VALUES (NULL, '$name', '$picHolderId', '$date', 'active')";
		 $irun=mysqli_query($con, $i);
		
		 if($irun)
		 {
			$id=$_GET['id'];
			header("location:profile.php?id=$id&picChanged=1");	 
		 }
		 else  echo "nit";
	 
	 }
	 
	 else 
	 {
	 echo "Problem uploading file";
	 }
}
}
////////////////////////////////////////////////////

function picDelete()
{
	include 'db.php';
	$id=$_GET['id'];
	$picId=$_POST['picId'];
	$name=$_POST['pname'];
	
	$dpic="delete from profilePic where picHolderId='$id' AND id='$picId'";
	$drun=mysqli_query($con, $dpic);
	if($drun)
	{
		unlink("profilePic/$name");
		header("location:profile.php?id=$id&delSuccess=1");
	}

}

///////////////////////////////////////////////////////

function picShow($pId, $vId)
{ 	
	
	include 'db.php';
	$pic="select * from profilePic where picHolderId='$pId' AND currentStatus='active'";
	$picResult=mysqli_query($con, $pic);
	$row=mysqli_fetch_array($picResult);
	if($vId==2)
	{
		if($row['name']=='')
		{
		echo "<img src='chat/profilePic/default.png' height='70px' width='70px' onClick=zoom('chat/profilePic/default.png',400,500);>";
		}
		else
		{
		echo "<img src='chat/profilePic/$row[name]' height='70px' width='70px' onClick=zoom('chat/profilePic/$row[name]',400,500);>";
		}

	}
	
	else
	{
		if($row['name']=='')
		{
		echo "<img src='profilePic/default.png' height='50px' width='50px' onClick=zoom('profilePic/default.png',400,500);>";
		}
		else
		{
		echo "<img src='profilePic/$row[name]' height='50px' width='50px' onClick=zoom('profilePic/$row[name]',400,500);>";

		}
	}
}

function changeProfilePic()
{
include 'db.php';

 if(isset($_POST['picChange']))
 {
	 $picId=$_POST['picId'];
	 $id=$_GET['id'];
	 
	$p1="update profilepic set currentStatus='inactive' where picHolderId='$id'";
	$p2=mysqli_query($con, $p1);
	 
	$picChange="update profilepic set currentStatus='active' where id=$picId";
	$changeRun=mysqli_query($con, $picChange);
	if($changeRun)
	{
		header("location:profile.php?id=$id&picChanged=1");
	}
	else "not";
 }	
}

}
?>
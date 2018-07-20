<?php
$likeObj=new like;

if (isset($_POST['like'])) 
{
	$likeObj->like();
}

if (isset($_POST['unlike'])) 
{
	$likeObj->unlike();
}

if (isset($_POST['likeCount'])) 
{
	$likeObj->likecount($_POST['pid']);
}


class like
{
		public	$likerId;
		public  $statusId;
		public  $likerName;

	function like()
	{
		if (isset($_POST['like'])) 
		{
			include 'db.php';
			$likerId=$_POST['likerId'];
			$statusId=$_POST['statusId'];
			$likerName=$_POST['likerName'];

			$check="select * from statuslike where likerId='$likerId' AND statusId='$statusId'";
			$check1=mysqli_query($con,$check);
			if(mysqli_num_rows($check1)==NULL)
			{
				
				$q="INSERT INTO `statuslike` (`id`, `statusId`, `likerId`, `likerName`, `likes`) VALUES (NULL,	'$statusId', '$likerId', '$likerName', '1')";
				$q2=mysqli_query($con,$q);
			}

		}	
	}

	function unlike()
	{
			include 'db.php';
			$likerId=$_POST['likerId'];
			$statusId=$_POST['statusId'];
			$likerName=$_POST['likerName'];	
			$ldel="delete from statuslike where likerId='$likerId' AND statusId='$statusId'";
			$ldelExe=mysqli_query($con,$ldel);	

	}
	

	function likeShow($sid)
	{
	
	include 'db.php';
	$l1="select * from statuslike where statusId=$sid";
	$l2=mysqli_query($con,$l1);
	?>
			
	<?php
	/*
	$l1="select * from likes where status_id=$sid";
	$l2=mysqli_query($con,$l1);*/
	?>
			
	<table class="table" id="table<?php echo $sid; ?>" style="display: none; width:900px;">
	<?php	 
	 while($lrow=mysqli_fetch_array($l2))
	 {
	?>
	<tr style="background:#E1DFDF; height:5px;">
	  <td>
      <a href="profile.php">
	   <?php echo "<font color=black>".$lrow['likerName']."</font>"?>
       </a>
	  </td>
	</tr>
	
	<?php } ?>
	</table>
	
	<?php 
	}
	
	function likecount($sid)
	{
	include 'db.php';

	//if(isset($_POST['pid']))
	{
	$l1="select * from statuslike where statusId='$sid'";
	$l2=mysqli_query($con,$l1);
	?>
	<a role='button' class="likeshow" id="<?php echo $sid;  ?> " onClick='showlikes(<?php echo $sid;  ?>)'>
	<?php 
	if(mysqli_num_rows($l2)<2)
	{echo "&nbsp&nbsp (".mysqli_num_rows($l2).") like";}
										
	else
	{
		echo "&nbsp&nbsp (".mysqli_num_rows($l2).") likes";}
	}
?>
</a>
<?php
	$likeObj1=new like;
	$likeObj1->likeShow($sid);
	?>
	
	

	
		<script type="text/javascript">
						/*
							var a=0;
							$('.likeshow').click(function(){
							var element = $(this);
							var pid = element.attr("id");
							$('#table'+pid).fadeToggle();

								
										});
						*/
						
						function showlikes(sid)
						{
							$('#table'+sid).fadeToggle();
						}
	
	</script>
<?php
	}
}

?>
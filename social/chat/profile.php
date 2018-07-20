<?php
session_start();

	$myId=$_SESSION["myId"];
	$myUserName=$_SESSION["myUserName"];
if ($_SESSION["myUserName"]=='' AND $_SESSION["pwd"]=='') {
  {
    header("location:../login.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  include 'title.php';
  ?>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="stylesheet/index1.css">
  <link rel="stylesheet" href="stylesheet/load.css">
    <link rel="stylesheet" href="stylesheet/members.css">
  <script src="javascript/jquery.min.js"></script>
  <script src="javascript/bootstrap.min.js"></script>
    <script type="text/javascript" src="javascript/java.js" ></script>
    <script src="javascript/bootstrap.min.js"></script>
    <script src="javascript/bootbox.min.js"></script>

    <?php
				include 'db.php';
				

	?>


  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>

</head>

<body onLoad="scroll()" >
<div class="container-fluid text-center">    

<div class="row content" id="header">
    <?php
		//include 'db.php';
     	include "header.php";
		include 'status.php';
		include 'like.php';
		include 'comment.php';
		include 'member.php';
		

    ?>
    <hr>
</div
></div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="../index.php">Home</a></li>
       
      <?php
	  $id=$_GET['id'];
	  
	if($_SESSION['myId']==$id)
	{
?>
        <li class="active"><a href=timeline.php?id=<?php echo $myId; ?>>My profile</a></li>
  <?php
	}?>
        <li><a href="chatEdit.php?name=&msgEdit=2&sid=">Message</a></li> 
        <li><a href="eventGallery.php?view=all">Event Gallery</a></li>
        <li><a href="eventAlert.php">Event Alert</a></li>
        <?php
	   if($_SESSION['position']=='Admin')
	   {
	   ?>
        <li><a href="userAddBlock.php?add=1">Add User</a></li>
        <li><a href="userAddBlock.php?block=1">Block user</a></li>
        <?php 
		} 
		?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li style="margin-top:5px; background:url(../profile/img/msg.ico) no-repeat center; height:40px; width:40px; background-size:40px 40px; margin-right:20px; padding-right:40px; " id="msgnoti" onclick="loadnewsms()"> 

            </li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  	<div class="row content" id="">
        <div class="col-sm-2 sidenav" style="height:580px; background:#f1f1f1;">
   
           	<span id="profilePic"style=" height:50px; width:50px; background:blue; float:left">
            		<?php 
						$profilePicObj->picShow($id, '');
					?>
            </span>
            
            <span style="float:left; margin-top:5px; margin-left:10px">
            	<a role="button" id="viewPhotos">View photos</a>	
            </span>
            <?php 
			if($_SESSION['myId']==$id)
			{
			?>

            
            <span style="float:left; margin-top:px; margin-left:10px">
            	<a role="button" id="changePic">Change Profile <br> Picture</a>
            </span>
            <?php
			}
			?>
            
            
            <script>
				$("#changePic").click(function(){
					
				$("#changePic").hide();
				$("#viewPhotos").hide();
				$("#profilePic").hide();
				$("#viewPhotos").hide();
				$("#proPicChange").show();
					
					})
					
				$("#viewPhotos").click(function(){
				$("#viewPhotos").hide();	
				$("#changePic").show();
				$('#profileView').hide();
				$("#picContainer").show();
				$('#goBackprofile').show();
				
					})
			</script>
               

            <ul style="background: white; color:#917eb9; border-radius:7px; float:left; display:none; margin-left:0px; padding-left:0px" id="proPicChange" type="none">
            	
            	<li id="existingPhoto" style=" border-bottom:1px solid #917eb9; padding:10px;">
                	<a role="button">select from existing photo</a>
                </li>
                
                <li style="padding:10px;">
                   	<a id="uploadNewPhoto" role="button">Upload new photo</a>
                </li>
                
            </ul>
            
                 <script>
					$('#uploadNewPhoto').click(function(){
						
						$('#newPhotoUploader').show();
						$('#profileView').hide();
						$('#proPicChange').hide();
						});
				</script>

<?php

?>
        </div>
        
        <div class="col-sm-7 text-left" style="height:580px; background:white; border-left:1px solid #B8B6B6;"> 
        <div id="newPhotoUploader" style="display:none; background:white; margin-top:10px" align="center">
           <table border="1" width="760px" >
           
                <form action="member.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <tr bgcolor="#7058a3" style="color:white; font-size:22px" ><td align="center">
                    <label  for="fileToUpload" >Select image to upload:</label>
                </td></tr>
                 <tr><td align="center">
                    <input type="file" name="file" id="fileToUpload" style="">
                 </td></tr>
                 <tr><td align="center">
                    <input type="submit" value="Upload" name="picUpload"  class="btn btn-success">
                 </td></tr>
                </form>
            </table>
            </div>
        
        
            <div id="profileView">
				<?php
                    
                    $memberObj->viewProfile($id);
                ?>
            </div>
            
                <div id="picContainer" style="height:450px; width:755px; background:; margin-top:10px; display:none; overflow:hidden; overflow-y:scroll; box-shadow:4px 4px 4px rgba(120,118,118,1.00); border-left:1px solid #D4CDCD; border-top:#D4CDCD 1px solid;" >
                     <?php
						$upic="select * from profilepic where picHolderId='$id'";
						$upicRun=mysqli_query($con, $upic);
						while($pics=mysqli_fetch_array($upicRun))
						{
					?>
                        <div style="float:left; width:170px; background:; margin-left:11px; margin-top:10px; padding-bottom:5px; box-shadow:rgba(120,118,118,1.00) 5px 5px 5px; border-left:1px solid #D4CDCD; border-top:#D4CDCD 1px solid;">
                        	<img src="profilePic/<?php echo $pics['name'];?>" height="100px" width="100px" style="float:left; margin-left:33px; margin-top:10px;" onClick=zoom('profilePic/<?php echo $pics['name'];?>',400,500);>
                     
                             <span style=" margin-left:20px; margin-top:5px; margin-bottom:5px; color:white; font-size:9px;">
       							uploaded at:<?php echo $pics['date']; ?>
				        	</span>
                     
                            <?php
                            if($id==$myId)
                            {
							?>
                            <form action="member.php?id=<?php echo $id; ?>" method="post" style="float: left; margin-left:5px; margin-top:10px; ">
                                    <input name="picId" value="<?php echo $pics['id']; ?>" type="hidden">
                                    <input type="submit" value="Use as profile picture" name="picChange" class="btn btn-success">
                            </form>

                            <form action="member.php?id=<?php echo $id; ?>" method="post" style="float: left; margin-left:20px; margin-top:5px; " id="picDel<?php echo $pics['id']; ?>">
                                    <input name="picId" value="<?php echo $pics['id']; ?>" type="hidden">
                                    <input name="pname" value="<?php echo $pics['name']; ?>" type="hidden">
                                    <input type="hidden" value="Delete Picture" name="delChange">
                                    <input type="button" value="Delete Picture" name="delChange" class="btn btn-danger" onClick="picDel(<?php echo $pics['id']; ?>)">
                            </form>
                            <?php
							}
							?>
                            
                    <script>
                    	function picDel(id)
						{
					bootbox.confirm("Are you sure you want to delete this?", function(result){if (result) {$('#picDel'+id).submit();}});
						
						}
                    </script>
                        </div>
                <?php
						}
						
						if(isset($_GET['delSuccess']))
						{
						echo "<script> 
						$('#viewPhotos').hide();	
						$('#changePic').hide();
						$('#profileView').hide();
						$('#picContainer').show();
						</script>";
						}
				?>
                    
                </div>
                <center>
                    <a role="button" class="btn btn-default" id="goBackprofile" style="margin-top:10px; display:none"> Go Back</a>
               </center>
                
                <script>
					$('#existingPhoto').click(function(){
						$('#profileView').hide();
						$('#picContainer').show();
						})
						
					$('#goBackprofile').click(function(){
						$('#viewPhotos').hide();	
						$('#changePic').show();
						$('#profileView').show();
						$('#picContainer').hide();
						$('#goBackprofile').hide();
						})
						
				</script>
            
        </div>
    
    
        <div class="col-sm-3 sidenav" style="height:580px; background:#f1f1f1; border-left:1px solid #B8B6B6">
         
            
        </div>
	</div>
</div>

<footer class="container-fluid text-center">
  <p>UMSIT social Network © 2016</p>
</footer>
<?php 

	if(isset($_GET['pwdFailed']))
{
	if($_GET['pwdFailed']==1)
	{
		?>
		<script> 
		bootbox.alert({
		 message: "Successfully Deleted",
	   size: 'small'
		}); 
		</script>
		<?php
	}
}

	if(isset($_GET['pwdChange']))
{
	if($_GET['pwdChange']==1)
	{
		?>
		<script> 
		bootbox.alert({
		 message: "Password successfully Changed",
	   size: 'small'
		}); 
		</script>
		<?php	}
}

	if(isset($_GET['picChanged']))
{
	if($_GET['picChanged']==1)
	{
		?>
		<script> 
		bootbox.alert({
		 message: "Profile Picture Successfully Changed",
	   size: 'small'
		}); 
		</script>
		<?php	}
}

	if(isset($_GET['delSuccess']))
{
	if($_GET['delSuccess']==1)
	{
		?>
		<script> 
		bootbox.alert({
		 message: "Successfully Deleted",
	   size: 'small'
		}); 
		</script>
		<?php	}
}
	if(isset($_GET['profSuccess']))
{
	if($_GET['profSuccess']==1)
	{
		?>
		<script> 
		bootbox.alert({
		 message: "Successfully Updated",
	   size: 'small'
		}); 
		</script>
		<?php	}
}

?>

</body>
</html>

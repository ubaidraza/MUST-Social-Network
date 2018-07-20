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
  <link rel="stylesheet" href="stylesheet/eventGallery.css">
    <script src="javascript/java.js"></script>
    <script src="stylesheet/jquery-latest.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
 <script src="javascript/bootbox.min.js"></script>
    
	<style>
    /* Prevents slides from flashing */
    #slides {
      display:none;
    }
  </style>
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
	
	#fileToUpload{
			
		}
  </style>

</head>

<body onLoad="scroll()" >
<div class="container-fluid text-center">    

<div class="row content" id="header">
    <?php
		//include 'db.php';
     	include "header.php";
		include 'eventGalleryClass.php';
		

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
        <li ><a href=timeline.php?profile=1&id=<?php echo $myId; ?>>My profile</a></li>
        <li><a href="chatEdit.php?name=&msgEdit=2&sid=">Message</a></li> 
        <li class="active"><a href="eventGallery.php?view=all">Event Gallery</a></li>
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
  <div class="row content" style="height:1090px;" id="firstDiv">
   
   
    <div class="col-sm-2 sidenav">
		
        <span class="section">
        	<a role="button" href="eventGallery.php?view=all" class="btn btn-default" id="eall">
            	 All Photo
            </a>
       	</span>
        <span class="section" >
            <a role="button" href="eventGallery.php?view=album" class="btn btn-default" id="ealbum">
        	     Albums
            </a>
        </span>
        <span class="section" >
            <a role="button" href="slider.php?view=slides" class="btn btn-default" id="eslides">
            	Slides
            </a>
        </span>
             <script> 
				document.getElementById('e<?php echo $_GET['view']; ?>').style.background='white';
				document.getElementById('e<?php echo $_GET['view']; ?>').style.color='orange';

			</script>
        
        
    </div>
    
    <div class="col-sm-7 text-left" style="background:#F7F5F5; height:1090px;" id="middleDiv"> 
    
    	
                    	<?php
				if(isset($_GET['view']))
				 {
					if($_GET['view']!='slides')
					{

        	   if($_SESSION['position']=='Admin' OR $_SESSION['position']=='Staff')
						   {
						   ?>
       						 <div style=" background:white; margin-top:10px; box-shadow:5px 5px 5px #D1CBCB">
            
            <span style=" width:100%; background:#7058a3; height:30px; color:white; float:left; font-size:20px; margin-bottom:10px; ">
                <span style=" margin-left:40%;"> Image Uploader</span>
            </span>
           
                <div style="padding:10px;">
     	         <form action="eventGalleryClass.php?photoUpload=1" method="post" enctype="multipart/form-data">
                    <label  for="fileToUpload" style="">Select image to upload:</label><font color="green"> Max Photos can select:10</font>
                    <input type="file" name="files[]" id="fileToUpload" class="file" multiple required accept="image/*">

                    <br>
                    Event Name: <input type="text" name="eventName" required class="form-control"><br>
                    <input type="submit" value="Upload" name="photoUpload" class="btn btn-success">
                </form>
                             
 
                                        <?php 
							if(isset($_GET['limit']))
							{
							?>
							 <font color="red"><i> Upload fail, please select 10 photo Only</i></font>
							<?php
							}
							?>

             </div>
         </div>
         	
         					<?php
						   }
					}
				}

///////////////////////////////////////////All photo////////////////////////////////////////////////////////////		 

		 	if(isset($_GET['view']))
			{
				if($_GET['view']=='all')
				{
		 ?>
         
         <div style=" background:white; margin-top:10px;  min-height:100px; max-height:; overflow:hidden; overflow-y:scroll; box-shadow:5px 5px 5px #ADADAD;" id="imagegallery">
             <span style=" width:100%; background:#7058a3; height:30px; color:white; float:left; font-size:20px;">
                <span style=" margin-left:45%;"> Gallery</span>
            </span>
				<?php
					$eventGalleryObj->photoShow();	
				?>
         </div>
         <div id="btnLine" style=" margin-top:10px;">
         <?php
		 	$checkpage="select * from eventgallery ORDER BY id DESC;";
			$pageRun=mysqli_query($con, $checkpage);
			$pages=ceil(mysqli_num_rows($pageRun)/12);
			
			for($i=1; $i<=$pages; $i++)
			{
		?>
            <a href='eventGallery.php?p=<?php echo $i; ?>&view=all'  role="button" class="btn btn-default" id="enable<?php echo $i; ?>" style="background:#7058a3; color:white;"><?php echo $i; ?></a>
            
		
		<?php
			
            }

         	if(isset($_GET['p']))
			{
			?>
             <script> 
				document.getElementById('enable<?php echo $_GET['p']; ?>').style.background='white';
				document.getElementById('enable<?php echo $_GET['p']; ?>').style.color='orange';
			</script>
         <?php 
		 	}
			else{
		?>
            <script> 
				document.getElementById('enable1').style.background='white';
				document.getElementById('enable1').style.color='orange';
			</script>
       	<?php 
				}
		?>
        </div>
      <?php
	  }
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 
	 if(isset($_GET['success']))
	 { 
	 if($_GET['success']==1)
	 	{
		?>
		<script> 
		bootbox.alert({
		 message: "Successfully Deleted",
	   size: 'small'
		}); 
		</script>;
		<?php
		 }
		 if($_GET['success']==2)
	 	{
		?>
		<script> 
		bootbox.alert({
		 message: "Successfully	Uploaded",
	   size: 'small'
		}); 
		</script>;
		<?php
		 }
	 }
	 
	  //////////////////////////////////////album view////////////////////////////////////////////////////
	
	
	 if(isset($_GET['view']))
	 {
		 if($_GET['view']=='album')
		 {
	?>
    <div style=" background:white; box-shadow:5px 5px 5px #D1CBCB; width:100%; margin-top:10px;  padding:10px; height:730px; overflow: hidden; overflow-y:scroll;">
		<?php

			 $eventGalleryObj->photoShow();
	  ?>
      	 </div>
	  <?php
		 }
	 }
	  
	  ///////////////////////////////////////view album photo
	  
	  	 if(isset($_GET['album']))
	 {
	  
	  ?>
      <div style=" background:white; margin-top:10px;  min-height:100px; max-height:; overflow:hidden; overflow-y:scroll; box-shadow:5px 5px 5px #ADADAD; padding-bottom:10px;">
		  <?php
          
          $eventGalleryObj->photoShow();
          
          ?>
      </div>
      
	  <div id="btnLine" style=" margin-top:10px;">
      
         <?php
		 	$eventName=$_GET['album'];
		 	
			$checkpage="select * from eventgallery where eventName='$eventName'";
			$pageRun=mysqli_query($con, $checkpage);
			$pages=ceil(mysqli_num_rows($pageRun)/12);
			
			for($i=1; $i<=$pages; $i++)
			{
		?>
            <a href='eventGallery.php?view=albums&album=<?php echo $eventName; ?>&p=<?php echo $i; ?>'  role="button" class="btn btn-info" id="enable<?php echo $i; ?>" style="background:#7058a3; color:white;">
				<?php echo $i; ?>
            </a>
            
		
		<?php
			
            }

         	if(isset($_GET['p']))
			{
			?>
             <script> 
				document.getElementById('enable<?php echo $_GET['p']; ?>').style.background='white';
				document.getElementById('enable<?php echo $_GET['p']; ?>').style.color='orange';
			</script>
         <?php 
		 	}
			else{
		?>
            <script> 
				document.getElementById('enable1').style.background='white';
				document.getElementById('enable1').style.color='orange';
			</script>
              <script>
    $(function(){
      $("#slides").slidesjs({
        width: 940,
        height: 528
      });
    });
  </script>
       	<?php 
				}
		?>
        </div>
        <?php
	 }
	 
	/////////////////////////////////////////////slides///////////////////////////////////////////////////////// 
	       

	?>  
      
      
    </div>
    
    <div class="col-sm-3 sidenav" style="height:1090px;">

        
    </div>

	

  </div>
</div>

<footer class="container-fluid text-center" style="">
  <p>UMSIT social Network © 2016</p>
</footer>

</body>
</html>





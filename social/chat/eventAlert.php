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


  <script src="javascript/jquery.min.js"></script>
  <script src="javascript/bootstrap.min.js"></script>
 <script src="javascript/bootbox.min.js"></script>

    

    <?php
				include 'db.php';
				include 'eventAlertClass.php';
				

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

<body>
<div class="container-fluid text-center">    

<div class="row content" id="header">
    <?php
		//include 'db.php';
     	include "header.php";
		

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
        <li ><a href="eventGallery.php?view=all">Event Gallery</a></li>
        <li class="active"><a href="eventAlert.php">Event Alert</a></li>
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
  <div class="row content" style="height:950px;" id="firstDiv">
    <div class="col-sm-2 sidenav">
		
	
    </div>
    
    <div class="col-sm-7 text-left" style="background:#F7F5F5; height:950px;" id="middleDiv"> 


    	<?php
        	   if($_SESSION['position']=='Admin' OR $_SESSION['position']=='Staff')
	   {
		   ?>
        <div style="background:white; padding:10px; margin-top:10px; box-shadow:5px 5px 5px #A79D9D;">
        	<div style="background:#7058a3; color: white; font-weight:800; height:30px; padding-top:5px; text-align:center; margin-bottom:5px;">
            	Alert Generator
            </div>


                <script type="text/javascript">
     function validateAlert() 
     { 
      var reciever=document.getElementById('alertReciever').value;
      if(reciever=='')
        {
          document.getElementById('alertShow').style.display="block";
          return false;
        }

    }
    </script>
            <form action='eventAlertClass.php' method="get" class="form" onSubmit="return validateAlert();">

                <input type="text" name="alert" class="form-control" id="alert" placeholder="Insert Event Here" required>
                <select name="alertReciever" class="form-control" style="margin-top:5px;" id="alertReciever">
                  <option value='' disabled selected>Select Event Reciepent</option>
                	<option value="*" >All</option>
                    <?php 
                        $q="select DISTINCT department from member where department!='0'";
                        $qrun=mysqli_query($con, $q);
                        while($row=mysqli_fetch_array($qrun))
                        {
                    
                    ?>
                    <option value="<?php echo $row['department'];?>" ><?php echo $row['department'];?></option>
                    
                    <?php
                        }
                    ?>
                  </select>
                  <span style="display: none;" id="alertShow">
                    <font color="red">
                        Please select alert reciever
                    </font>
                  </span>
                  <input type="submit" name="submitAlert" class="btn btn-success" style="margin-top:5px;">
             </form>
       </div>
       <?php } ?>
         
         <div style="max-height:750px; overflow:hidden; overflow-y:scroll;">
         	<?php 
			$eventAlertObj->showEvent();
			
			if(isset($_GET['deleted']))
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
            ?>
         </div>
    </div>
    
    <div class="col-sm-3 sidenav" style="height:950px;">

        
    </div>

	

  </div>
</div>

<footer class="container-fluid text-center" style="">
  <p>UMSIT social Network © 2016</p>
</footer>

</body>
</html>





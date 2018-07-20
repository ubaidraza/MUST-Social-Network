<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  include 'title.php';
  ?>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="stylesheet/index1.css">
  <link rel="stylesheet" href="stylesheet/eventGallery.css">
  <link rel="stylesheet" href="stylesheet/bootstrap.min.css">

<script src="javascript/jquery.min.js"></script>
  <script src="javascript/bootstrap.min.js"></script>
 <script src="javascript/bootbox.min.js"></script>

<?php
session_start();

	$myId=$_SESSION["myId"];
	$myUserName=$_SESSION["myUserName"];
	
if ($_SESSION["myUserName"]=='' AND $_SESSION["pwd"]=='') {
  {
    header("location:../login.php");
  }
  
}

  if($_SESSION["position"]!='Admin')
  {
	 header("location:../index.php");
	}
	

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
        <li ><a href="eventAlert.php">Event Alert</a></li>
        <li 	
        <?php
        if(isset($_GET['add']))
			{?>class="active" <?php }?>
	          ><a href="userAddBlock.php?add=1">Add User</a></li>
        <li 
		<?php
               if(isset($_GET['block']))
			{?>class="active" <?php }?> 
        ><a href="userAddBlock.php?block=1">Block user</a></li>
      
      
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
  <div class="row content" style="950px" id="firstDiv">
    <div class="col-sm-2 sidenav" style="height:950px">

	
    </div>
    
    <div class="col-sm-7 text-left" style="background:white;height:950px; " id="middleDiv"> 
    	
        
            <?php
	if(isset($_GET['add']))
			{?>
        <div style="padding:10px; box-shadow:5px 5px 5px #8F8787; border-left:1px solid #8F8787;margin-top:10px; background:white;">
        <div style="background:#7058a3; color: white; font-weight:800; height:30px; margin-top:-10px; text-align:center; margin-bottom:5px; margin-bottom:10px; margin-left:-10px; width:755px; padding-top:5px;">
        	Add user
        </div>
      
        <table align="center" cellspacing="7" id="addMember">
         <script>
      function validateForm()
 {
  var cnic=$('#cnic').val().length;

  if(cnic!=13)
  {
    document.getElementById('invalidCnic').style.display="block"; return false; 
  }

  var position=$('#positionSelector').val();
  if(position=='' || position==null)
  {

    document.getElementById('emptyPosition').style.display="block"; return false; 
  }
}
</script>
        <form action="member.php" method="post" onSubmit="return validateForm()">
        <tr><td>	
        	<label for="#eamil">
            	Email Address:
            </label>
         </td>
        
         <td>
            <input type="email" name="email" id="email" required class="form-control" placeholder="abc@gmail.com">
          </td></tr>
            
            <tr><td>
            <label for="#cnic">
            	CNIC:
             </label>
            </td>
            
           <td>
             <input type="number" name="cnic" id="cnic" placeholder="812021213434" required class="form-control">
             <span style=" display:none" id="invalidCnic">
             	<font color="red">invalide cnic, cnic must contain 13 digits</font>

             </span>
            </td></tr>
             
			<tr>
            <td>
            	<label>
	                Position
                </label>
            </td>
            
            <td>
      				<select name="position" style="width:200px; text-align:center; "  class="form-control" id="positionSelector">
                    	<option value="" selected disabled>select Your Position</option>
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Staff">Staff</option>
                    </select>
              <span style=" display:none" id="emptyPosition">
             	<font color="red">Please select position</font>
             </span>
             </td></tr>
             
             <tr><td align="center" colspan="2">
            <input type="submit" name="addMember" class="btn btn-success" style="margin-top:5px;">
            </td></tr>
            
        </form>
        </table>


        </div>
        <?php
        	}
		?>
        
            <?php
	if(isset($_GET['block']))
	{
		include 'member.php';
		?>
        <div class="col-sm-12" style=" height:930px; margin-top:10px; overflow:hidden; overflow-y:scroll;">
        <?php
		$memberObj->banMemeber();
		?>
        </div>
        <?php
	}
		?>
        
    </div>
    
    

    
    <div class="col-sm-3 sidenav" style="height:950px;">

        
    </div>

	

  </div>
</div>

<footer class="container-fluid text-center" >
  <p>UMSIT social Network © 2016</p>
</footer>


<?php
	if(isset($_GET['success']))
	{
		if($_GET['success']==1)
		{
		?>
		<script> 
		bootbox.alert({
		 message: "Successfully Blocked",
	   size: 'small'
		}); 
		</script>
		<?php
		}
	}
	
		if(isset($_GET['success']))
	{
		if($_GET['success']==2)
		{
		?>
		<script> 
		bootbox.alert({
		 message: "Successfully Unblocked",
	   size: 'small'
		}); 
		</script>
		<?php
		}
	}
	
			if(isset($_GET['email']))
	{
		if($_GET['email']==1)
		{
		?>
		<script> 
		bootbox.alert({
		 message: "Email address already exist",
	   size: 'small'
		}); 
		</script>
		<?php
		}
	}
	
				if(isset($_GET['cnic']))
	{
		if($_GET['cnic']==1)
		{
		?>
		<script> 
		bootbox.alert({
		 message: "Cnic already exist",
	   size: 'small'
		}); 
		</script>
		<?php
		}
	}
	
?>

</body>
</html>





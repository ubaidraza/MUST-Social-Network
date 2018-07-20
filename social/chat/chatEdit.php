<!doctype html>
<html>
<head>
	
    <meta charset="utf-8">
	<?php
	session_start();
	  $myId=$_SESSION["myId"];
  $myUserName=$_SESSION["myUserName"];
  
if ($_SESSION["myUserName"]=='' AND $_SESSION["pwd"]=='') {
  {
    header("location:../login.php");
  }
}

	 include 'title.php';
	?>
    
   <link rel="stylesheet" href="stylesheet/chat.css">
   <link rel="stylesheet" href="stylesheet/load.css">
   <link rel="stylesheet" href="stylesheet/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="stylesheet/index1.css">
   <link rel="stylesheet" type="text/css" href="stylesheet/members.css">
   
     <script src="javascript/jquerymin.js"></script>
 	 <script src="javascript/bootstrap.min.js"></script>
 	 <script src="javascript/bootbox.min.js"></script>
   
   <?php 
   	include 'conversationChatClasses.php';
	$convObj2=new conversation;
   ?>

   
    <script src="javascript/jquery.min.js"></script>
 	<script src="javascript/bootstrap.min.js"></script>
  	<script type="text/javascript">
				function checkall()
		{
				$('.checkbox').each(function(){
				this.checked = true;
				});
		}

			function uncheckall()
			{
				$('.checkbox').each(function(){
				this.checked = false;
				});
			}
	</script>
   
</head>

<body background="#f1f1f1">
	
    	
	<div class="row content" id="header" style="padding-left:15px;">
    <?php
     	include "header.php";
		
			 if(isset($_GET['success']))
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
       <li><a href=timeline.php?profile=1&id=<?php echo $_SESSION['myId']; ?>>My profile</a></li>
        <li class="active"><a href="chatEdit.php?name=&msgEdit=2&sid=">Message</a></li> 
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
    
                </li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          </ul>
        </div>
       </div>
    </nav>
    



<div class="container-fluid text-center">    
  <div class="row content"  style="margin-top:-19px;">

              <div class="col-sm-2 sidenav" style="background:white; height:500px; border-right:1px solid #928E8E;">

				</div>
            <div class="col-sm-3 sidenav" style="background:#F7F5F5; height:500px;border-right:1px solid #928E8E; overflow:hidden; overflow-y: scroll;">
                    <?php
                    $convObj2->showConversation();
                    ?>
            </div>
            
            <div class="col-sm-3 text-left" style="background:; height:500px;" > 
        		 <div style="height:440px; margin-left:-75px; float:left;">
               
                    <?php 
                     if(isset($_GET['name']))		
                     {
                         $name=$_GET['name'];
                        if($name!='')
                        {
                    ?>
                         <div style=" width:334px; height: 20px; background:blue; margin-left:60px;" >
                           <font color="white">
                           		<div style=" font-weight:600; margin-left:120px ">
									<?php 
                                        echo $name;
                                    ?>
                                </div>
                           </font>
        
                        </div>
                    <?php
                       
                     
                    
                    ?>
                    
                    <form action="conversationChatClasses.php" method="post">
            
                    <?php
         
                    $_SESSION['memberName']=$_GET['name'];
                    $_SESSION['memberId']=$_GET['sid'];
                    $edit=$_GET['msgEdit'];
                    
                    $senderId=$_SESSION['memberId'];
                    $recieverId=$_SESSION['myId'];
                    if($edit!=2)
                    {
                    $convObj2->checkConversation($senderId, $recieverId);
                    }
					 ?>
                    

                    
					 <?php
					 }
					 }
                    ?>
                </div>    
	    </div>
    
    	<div class="col-sm-2 sidenav" style="height:500px; background:#F7F5F5;border-right:1px solid #928E8E;">
			 <?php	
                    if($_GET['sid']!='')
                {
                    $convId=$_SESSION['convId'];	
                
                ?>
                    <span class="row" style="margin-bottom:5px;">
    
                      <input type="submit" name="delete" value="delete selected" class="btn btn-danger" />
                    </span>
                   
                   </form>
                   
                    <span class="row" style="margin-bottom:10px;"> 
                        <button id="checkAll" onclick="checkall()" class="btn btn-warning">Check All</button>
                    </span>
                    
                    <span class="row" style="margin-bottom:10px;">
                        <button id="uncheckAll" onclick="uncheckall()" class="btn btn-warning">Un Checkall</button>
                    </span>
                    
                    <?php
					if($_GET['sid']!='')
					{
					?>
				     <form action="conversationChatClasses.php" method="post" style="position:absolute; margin-left:-340px; margin-top:250px;">
                    	<input type="text" name="msgs" class="form-control" style="width:230px; float:left; margin-right:10px; margin-top:5px;">
                        <input type="submit" name="saverecord" class="btn btn-info" value="send" style="margin-top:5px;">
                    </form>
                    
                <?php
					}
                }
                ?>    
	    </div>

             <div class="col-sm-2 sidenav" style="background:white; height:500px;">

				</div>            

  </div>
</div>

<footer class="container-fluid text-center" style=" background:#808080; color:white; padding-top:10px;">
  <p>UMSIT social Network © 2016</p>
</footer>

</body>
</html>





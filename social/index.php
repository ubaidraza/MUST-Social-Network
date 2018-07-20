<?php
	include 'chat/conversationChatClasses.php';
		
	$myId=$_SESSION["myId"];
	$myUserName=$_SESSION["myUserName"];
if ($_SESSION["myUserName"]=='' AND $_SESSION["pwd"]=='') {
  {
    header("location:login.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  include 'chat/title.php';
  ?>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="chat/stylesheet/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="chat/stylesheet/index1.css">
  <link rel="stylesheet" href="chat/stylesheet/load.css">
    <link rel="stylesheet" href="chat/stylesheet/members.css">
  <script src="chat/javascript/jquery.min.js"></script>
  <script src="chat/javascript/bootstrap.min.js"></script>
  <script src="chat/javascript/bootbox.min.js"></script>
    <script type="text/javascript" src="chat/javascript/java.js" ></script>
    
    <?php
				include 'chat/db.php';

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
    
	.sidenav ul li{ border-bottom:1px solid #B0AEAE;}
	
	
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
	
	#arrowDown:hover {
		background:#89b95a;
		}
  </style>

</head>

<body onLoad="scroll()" >
<div class="container-fluid text-center">    

<div class="row content" id="header">
    <?php
     	include "chat/header.php";
		include 'chat/status.php';
		include 'chat/like.php';
		include 'chat/comment.php';
		include 'chat/member.php';
    ?>
    <hr>
</div
></div>

<nav class="navbar navbar-inverse" >
  <div class="container-fluid" >
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" >
        <li class="active"><a href="#">Home</a></li>
        <li><a href=chat/timeline.php?profile=1&id=<?php echo $myId; ?>>My profile</a></li>
        <li><a href="chat/chatEdit.php?name=&msgEdit=2&sid=">Message</a></li> 
        <li><a href="chat/eventGallery.php?view=all">Event Gallery</a></li>
        <li><a href="chat/eventAlert.php">Event Alert</a></li>
        <?php
	   if($_SESSION['position']=='Admin')
	   {
	   ?>
        <li><a href="chat/userAddBlock.php?add=1">Add User</a></li>
        <li><a href="chat/userAddBlock.php?block=1">Block user</a></li>
        <?php 
		} 
		?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li style="margin-top:5px; background:url(img/msg.ico) no-repeat center; height:40px; width:40px; background-size:40px 40px; margin-right:20px; padding-right:40px; padding-top:10px " id="msgnoti"> 
        		
                <span style=" margin-left:12px; ;">
					<?php
                    $count="select status from message where recieverId='$myId' AND status=1";
	                $countRun=mysqli_query($con, $count);
                    echo "<font color='red'>".mysqli_num_rows($countRun)."</font>";
                    ?>
      			</span>
      
        </li>
               <div id="newMsg" style="display:none; z-index:999999; height:px; width:340px; background:url(chat/img/nomsg.jpg); background-size:340px 90px; position:absolute; margin-left:-200px; margin-top:40px; min-height:90px; overflow:hidden; overflow-y:scroll; max-height:350px;">
				 <?php 
                 $view=0;
                 $memberObj->showMember('*'); 
				 
                 ?>		
        <script type="text/javascript">
			$('#msgnoti').click(function(){
			$('#newMsg').slideToggle("slow");
			});	
			
			$('.hidenew').click(function(){
				
				$('#newMsg').hide();	
				});
    	</script>
         </div>  
        <li><a href="chat/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content" id="first">
    <div class="col-sm-2 sidenav div1" >
	  <ul class="nav" style="margin-left:0; text-align:left; background:white; border-radius:10px;" id="sideNav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href=chat/timeline.php?profile=1&id=<?php echo $myId; ?>>My profile</a></li>
        <li><a href="chat/chatEdit.php?name=&msgEdit=2&sid=">Message</a></li> 
        <li><a href="chat/eventGallery.php?view=all">Event Gallery</a></li>
        <li style="border-bottom:0px none;"><a href="chat/eventAlert.php">Event Alert</a></li>
      </ul>
    <div style="background:white; margin-top:10px; height:350px; overflow:hidden;">
    <table >
    	<span style="background:#7058A3; padding:10px; color:white; font-weight:700; padding-left:0px; border-radius:5px 5px 0px 0px;" class=" col-sm-12">
    		Latest Events
   		 </span>
         <marquee direction="up" scrollamount="3>" style="height:300px; color:#337ab7;" onMouseOver="this.stop()" onMouseOut="this.start()">
    	<?php
			$event="select * from eventAlert ORDER BY id DESC limit 0,10 ";
			$eventShow=mysqli_query($con, $event);
			
			while($events=mysqli_fetch_array($eventShow))
			{
				?>
                <div style=" background:#917EB9;  margin-bottom:5px;">
                <a href="chat/eventAlert.php">
                <?php
				echo "<img src='chat/img/new.gif' height='20px' width='20px'><font color='white'>".wordwrap($events['event'],26,"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", true)."</font><br>";	
				?>
                </a>
                </div>
                <?php
			}
			
		?>
        </marquee>
        
    </table>
    </div>
    </div>
    

    <div class="col-sm-7 text-left div2"  id="centerDiv"> 
		
        	<div class="form-group" style="box-shadow:5px 5px 5px rgba(197,190,191,1.00); padding:10px; background:#7058A3;">
			  <form action="chat/status.php" method="post" role="form">
	            <input name="status" type="text" required="required" class="form-control" id="status" placeholder=" What's on your mind?" maxlength="255" multiple/>
	            <input type="submit" name="statusInsert" value="Post Status" class="btn btn-default" style="margin-top: 5px;" />             
	             <input type="hidden" name="indexDel" value="1"></input>


	          </form>
        	</div>
         
        <div id="statusbox" style="height:560px;" >

			<div id="statuses"  style="	overflow-y:scroll; overflow:hidden;">	
		<!-- ///////////////////////status///////////////////////-->
		<?php		
				
				$q3="select * from status ORDER BY id DESC";
				$result=mysqli_query($con,$q3);

				while($row=mysqli_fetch_array($result))
				{			
			?>
            <table style="background:white; box-shadow:5px 5px 5px rgba(197,190,191,1.00); margin-bottom:15px; border:1px solid #C4C4C4;" class="col-md-12"  >
            	<tr >		
 
					<td style="color:#338dcc; font-weight:bold; padding-top:10px;">
						<?php
						$status_posterid=$row['statusPosterId'];
	                    $status_poster=$row['posterName'];
	                    $status_date=$row['date'];
						$status=$row['status'];
						$statusId=$row['id'];

                        $statusObj->statusShow($status_posterid,$status_poster,$status_date,$status,$statusId);
                        ?>
                        

              <table class="statusTable" id="navDown<?php echo $statusId; ?>" border="1px" style=" position: absolute; margin-left:630px;display:none; background:#917eb9; color:white; margin-top:20px;" bordercolor="white" width="100px" align="right" >
                   <tr style="height:25px;" align="center"  >
                   	<td>
					<form action="chat/status.php" method="post" style="padding-left:-10px;" id="statusDel<?php echo $statusId; ?>">
                       <input  type="hidden" name="statusId" value="<?php echo $statusId; ?>">
                       <input type="hidden" name="statusDel">
                       <input type="button" name="statusDel" value="delete" style="border:0px; background:none; font-weight:normal; color:white;"  id="btnDel2" onClick="delStatus(<?php echo $statusId; ?>)">
                    </form>
                    <script>
						function delStatus(id)
						{
							bootbox.confirm("are you sure", function(done){if(done){$('#statusDel'+id).submit()}});
						}
						
					</script>
                    </td>
                   </tr>
                       
                        <tr id="editBtn<?php echo $statusId; ?>" style="height:25px; font-weight:normal;" align="center">
                          <td>
                          
                            <a role="button" onclick="showEditableStatus(<?php echo $statusId; ?>)" class="btnEdit" id="<?php echo $statusId; ?>" style="margin-left:-12px; text-decoration:none; color:white;">
                               
                                    edit 
                                
                            </a>
							</td>
                         </tr>
                    
               </table>
              
                    </td>
                 </tr>

                <tr>
                	<td id="td3" >
                    <!-----------------------------------like------------------------------------------>
                    	<span id="statustext3">


                <input type="hidden" value="<?php echo $row['id']; ?>" name="statusId" >

                <input type="hidden" value="<?php echo $myId; ?>" name="likerId" id="likerId<?php echo $row['id']; ?>">
                            	
                <input type="hidden" value="<?php echo $_SESSION["myName"]; ?>" name="likerName" id="likerName<?php echo $row['id']; ?>">
                     
                     
                        			<?php 
			
			$check="select * from statuslike where likerId='$myId' AND statusId='$row[id]'";
			$check1=mysqli_query($con,$check);
			if(mysqli_num_rows($check1)==NULL)
			{
				?>

                           	 <div style="float:left">	
                           	 	<span id="like<?php echo $row['id']; ?>" style="float:left">
&nbsp&nbsp&nbsp <input type="submit" name="like" class="btn-default btnlike" id="<?php echo $row['id']; ?>" value="like"  onClick="like(<?php echo $row['id']; ?>)"/><br>
								</span>
							</div>
                            
              <span id="unlike<?php echo $row['id']; ?>" style="float:left; display:none; margin-left:17px;">
               	<input type="submit" name="unlike" class="btn btnUnlike" id="<?php echo $row['id']; ?>" value="liked" style="color:white; background:#655190;" onClick="unlike(<?php echo $row['id']; ?>)" /><br>
               </span>

                                 
             <?php 
			} 

			 else{
              ?>    
          
               <span id="unlike<?php echo $row['id']; ?>" style="float:left; margin-left:17px;">
               	<input type="submit" name="unlike" class="btn btnUnlike" id="<?php echo $row['id']; ?>" value="liked" style="color:white; background:#655190;" onClick="unlike(<?php echo $row['id']; ?>)"/><br>
               </span>
               
               
               
                           	 <div style="float:left">	
                           	 	<span id="like<?php echo $row['id']; ?>" style="float:left; display:none;">
&nbsp&nbsp&nbsp <input type="submit" name="like" class="btn-default btnlike" id="<?php echo $row['id']; ?>" value="like"  onClick="like(<?php echo $row['id']; ?>)"/><br>
								</span>
							</div>
							
                 <?php
			 }
				 ?>
                      
                            
                            	<br><br>
                            	<div id="likes<?php echo $row['id']; ?>" style="margin-top:-7px; float:left; background:">
                             	<?php
										
									$likeObj->likecount($row['id']);
                              		?>
                                </div>

                              <!--comment-->

 			<div style="margin-top:-19px;">
                             <!-- //////-commentinsert////////////// -->
                <div id="commentShow<?php echo $row['id']; ?>" >
                                     
                </div>
              
           	 <div class="col-md-12" style="margin-top:5px;">                  
	            <input type="hidden" value="<?php echo $row['id']; ?>" name="statusId" id="statusId">
	            <input type="hidden" value="<?php echo $_SESSION['myId']; ?>" name="commenterId" id="commenterId<?php echo $row['id']; ?>" >
	            <input type="hidden" value="<?php echo $_SESSION["myName"]; ?>" name="commenterName" id="commenterName<?php echo $row['id']; ?>" >
	            <input type="text" name="comment" style="width: 80%; float: left; margin-bottom: 5	 px; margin-right: 5px;" class="form-control" id="commentBox<?php echo $row['id']; ?>"/>
	            <input type="submit" onClick="commentInsert(<?php echo $row['id'];?>)" name="btnComment" class="btnComment btn btn-default" id="cmt<?php echo $row['id']; ?>" value="Comment"/>
            </div>
                                
                           <div id="Comment<?php echo $row['id']; ?>" style="margin-top:-10px;"> 
                              <?php
                              	//$comObj->commentCount($row['id']);
                              	$comObj->commentShow($row['id']);
                              ?>
                            </div>             
                                
			</div>
                                
                    <script type="text/javascript">

				/////////////////////insertinglike/////////////////////////////

function like(pid)
{
				var likerId= $('#likerId'+pid).val(); 
					var likerName= $('#likerName'+pid).val(); 
					
						$.ajax({
							url:'chat/like.php',
							type:'POST',
							async:false,
							data:{
								'like':1,
								'statusId':pid,
								'likerId':likerId,
								'likerName':likerName								
								 },
								success:function(r){
									//$('#likeShow'+pid).html(l);
									//alert('hi');
									//$('#likes'+pid).hide();
									$('#likeShow'+pid).hide();
									$('#like'+pid).hide();
									$('#unlike'+pid).show();
									}

								});
								
							
					$.ajax({
							url:'chat/like.php',
							type:'POST',
							async:false,
							data:{
								'pid': pid,
								'likeCount':1 

								},
							success:function (l){
								//alert("hi");
								$('#likes'+pid).html(l);
								//$('#likecount'+pid).html(l);

									}
							});
								
							
															
			}
					
				//////////////////////////////unlike////////////////////////////
				
				function unlike(pid)
				{


				var likerId= $('#likerId'+pid).val(); 
					var likerName= $('#likerName'+pid).val(); 
					
						$.ajax({
							url:'chat/like.php',
							type:'POST',
							async:false,
							data:{
								'unlike':1,
								'statusId':pid,
								'likerId':likerId,
								'likerName':likerName								
								 },
								success:function(r){
									//$('#likeShow'+pid).html(l);
									//alert('hi');
									//$('#likes'+pid).hide();
									$('#likeShow'+pid).hide();
									$('#unlike'+pid).hide();
									$('#like'+pid).show();
									}


								});
								
							
					$.ajax({
							url:'chat/like.php',
							type:'POST',
							async:false,
							data:{
								'pid': pid,
								'likeCount':1 

								},
							success:function (l){
								//alert("hi");
								//$('#likecount'+pid).html(l);
								$('#likes'+pid).html(l);

									}
							});
								
							
															
					}

					////////////////////likeshow////////////////////////////////

					
					//show comment
						$('.btnshow').click(function(){
						var element = $(this);
						var pid = element.attr("id");
							
					$.ajax({
							url:'chat/comment.php',
							type:'POST',
							async:false,
							data:{
								'pid': pid 

								},
							success:function (c){
								//alert("hi");
								//$('#Comment'+pid).hide();
								//$('#commentShow'+pid).html(c);
								
									}
							});
							
							
									});
									
					////////////////////////delete comment///////////////////////////
									
									
						function del(commentId, statusId)
					{
							bootbox.confirm("Are you sure you want to delete this?", function(result){if (result) 	
							{
							var sid=statusId;
							//alert(commentId);
						$.ajax({
							url:'chat/comment.php',
							type:'POST',
							async:false,
							data:{
								'commentDel':1,
								'commentId':commentId
								 },
								success:function(r){
								
								bootbox.alert({ message: "Successfully Deleted", size: 'small'}); 
								
								$('#Comment'+sid).load('index.php #Comment'+sid);
									
									}

								});
							} });
					}	
					////////////////////////////////////comment edit///////////////////////////////////////

				function cmtUpdate(sid,cmtId)
					{
					cmt=$('#newCmt'+cmtId).val();
					$.ajax({
							url:'chat/comment.php',
							type:'POST',
							async:false,
							data:{
								'edit':1,
								'cid':cmtId,
								'cmt':cmt
								 },
								success:function(r){
								$('#Comment'+sid).load('index.php #Comment'+sid);
								
									}

								});
								

					}
						

					</script>
                                

                         </span>
                    </td>
                </tr>
            </table>

            <?php
				}
			?>
         		</div>

          </div>
  
    </div>
    
    <div class="col-sm-3 sidenav" id="middle">
      <div id="chatwin" >

            
           <div style="background:blue; width:305px; float:left;">
           
    	        <span style=" float:right; margin-right:5px;" id="closeChatwin" >
	                <a role="button" style="color:white; background:red; padding-left:3px; padding-right:3px;" title="Close chat">
                    X
                    </a>
        	    </span>

           </div>

			<script>
                $('#closeChatwin').click(function(){
                    $('#chatwin').hide(300);
					$('#member').show();
					$('#memberHead').show();
                    })
            </script>

                <div class="" id="showMsg" style="width:320px; background:url(img/logo2.png) center no-repeat; background-size: 250px 250px; background-color:white; height:370px; overflow-y:scroll; overflow-x:hidden;">
                
                </div>
		
		<div style="width:300px; ">
			<textarea type=text name="msgs"  class='form-control' id="input" onkeyup="check(event, this)" cols="40" rows="5"  required style="height:40px;"></textarea>
            
			<button name="insert"   onClick="insertd()" style=" height:40px; width:50px; background:url(img/send.png) no-repeat center; background-size:30px 30px; border-radius: 8px; background-color:rgba(27,168,254,1.00)"></button>
		</div>
    </div>      	

 
		<div style="background:#ff9f3a; padding:8px 10px; color:white; border-bottom:4px solid white; border-radius:5px 5px 0px 0px; margin-left:-15px" id="memberHead">
		 	&nbsp;	Members	
        </div>        
      <div id="member" class="row" style=" height:635px; overflow:hidden; overflow-y:scroll;">


        <div style="margin-bottom:4px; width:100%; background:#7058A3; color:white; font-weight:700;" id="admin" class="btn">
				Admin	
         </div>
         
        <div id="adminList" style="display:none;">
				 <?php 
                 $view=0;
                 $memberObj->showMember("Admin"); 
                 ?>		
         </div>
         
         <div id="staff" style="margin-bottom:4px; width:100%;background:#7058A3; color:white; font-weight:700;" class="btn">
                	Staff
         </div>
                <div id="staffList" style="display:none;">
				 <?php 
                 $view=0;
                 $memberObj->showMember("Staff"); 
                 ?>		
		         </div>

          
        <div id="teacher" style=" margin-bottom:4px; background:#7058A3; color:white; font-weight:700 ; width:100%" class="btn" >
				Teacher
         </div> 
         	<div id="teacherList" style="display:none">
				 <?php 
                 $view=0;
                 $memberObj->showMember("Teacher"); 
                 ?>		
            </div>
         <div style=" width:100%; background:#7058A3; color:white; font-weight:700;" id="student" class="btn">
				Student
         </div>
         <div id="studentList" style="display:none">
				 <?php 
                 $view=0;
                 $memberObj->showMember("Student"); 
                 ?>		
         </div>
         
         <script>
		 	$("#admin").click(function(){
				$("#adminList").slideToggle("slow");
				});
				
			$("#staff").click(function(){
				$("#staffList").slideToggle("slow");
			});

			$("#teacher").click(function(){
				$("#teacherList").slideToggle("slow");
			});

			$("#student").click(function(){
				$("#studentList").slideToggle("slow");
			});
		 </script>
       </table>
       
      </div>
        
    </div>

	

</div>

<footer class="container-fluid text-center">
  <p>UMSIT social Network © 2016</p>
</footer>

<?php
	if(isset($_GET['statusDeleted']))
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
?>
</body>
</html>

<script src="javascript/jquery.js"></script>

<?php
$comObj=new comment;

if(isset($_POST['btnComment']))
{
	$statusId=$_POST['statusId'];
	$commenterId=$_POST['commenterId'];
	$commenterName=$_POST['commenterName'];
	$comment=$_POST['comment'];
	
	$comObj->commentInsert($statusId, $commenterId, $commenterName,$comment);
}

if(isset($_POST['pid']))
{
	$comObj->commentShow($_POST['pid']);

}

if(isset($_POST['commentDel']))
{
	$cid1=$_POST['commentId'];
	$comObj->commentDelete($cid1);
}

if(isset($_POST['edit']))
{

	$cid=$_POST['cid'];
	$comment=$_POST['cmt'];
	$comObj->commentUpdate($cid,$comment);
}

class comment
{
	private $commentId;
	private $commenterId;
	private $comment;
	private $statusId;
	private $commenterName;
	private $date;
	
	function commentInsert($statusId, $commenterId, $commenterName, $comment)
	{
			include 'db.php';
			include "dateTime.php";	
			
		$q="INSERT INTO `statuscomment` (`id`, `statusId`, `commenterId`, `commenterName`, `comment`, `date`) VALUES (NULL, '$statusId', '$commenterId', '$commenterName', '$comment','$time')";
		$q2=mysqli_query($con,$q);

	
	}
	
	function commentCount($sid)
	{
	?>
		
         <?php
         	include 'db.php';
			$c1="select * from statuscomment where statusId=$sid";
			$c2=mysqli_query($con,$c1);
		 ?>
           <a  class="btnshow" id="<?php echo $sid; ?>" >
		 <?php 
			if(mysqli_num_rows($c2)<2)
			{echo "&nbsp&nbsp  (".mysqli_num_rows($c2).") comment";}
									
			else
			{echo "&nbsp&nbsp  (".mysqli_num_rows($c2).") comments";}

		 ?>
                            
            </a><br>
			
					

<?php	
	}
	
	function commentShow($sid)
	{
		if(isset($_POST['commenterId']))
		{
			session_start();

		}
		
	 include 'db.php';
	 $pc1="select * from statuscomment where statusId=$sid";
	 $pc2=mysqli_query($con,$pc1);
	 ?>
      <a  class="" id="" >
		<div style="float:left;">
		<?php 
		
			if(mysqli_num_rows($pc2)<2)
				{echo "&nbsp&nbsp (".mysqli_num_rows($pc2).") comment";}
									
			else
				{echo "&nbsp&nbsp (".mysqli_num_rows($pc2).") comments";}

		
		?>
		</div>
                            
       </a><br>
       
       <div style="max-height:200px; overflow-x:hidden; overflow-y:scroll; width:98%" id="internalComment<?php echo $sid; ?>">                     

		<?php
									
			$c1="select * from statuscomment where statusId=$sid ORDER BY id DESC";
			$c2=mysqli_query($con,$c1);
		?>
                                    
		<table border="0px" width="100%" style="background:white; margin-left:10px;" cellpadding="8"> 

		<?php	 
			while($crow=mysqli_fetch_array($c2))
				{
		?>
        
            <tr align="left" id="comment<?php echo $crow['id']; ?>">
               <td style="border-bottom:4px solid white; padding-left:20px;" >
                 <div id="top"> 
                  <?php 
					$cid=$crow['commenterId'];
					$commentId=$crow['id'];
					?>

				<div class="row">
				  <div class="col-md-8" style="margin-left: -15px;" >
				  <?php
					echo "<a href=chat/profile.php?id=$cid><font color='blue'><b>&nbsp&nbsp".$crow['commenterName']."</a>:  </b></font>";
					?>				  
				  </div>
				  <div class="col-md-4" >
				  	<span style="float:right" id="date<?php echo $crow['id']; ?>">
					   <?php	
                        echo $crow['date'];
                       ?>
				    </span>
				  </div>
                 </div>
                 
                    
                    <div id="commentTxt<?php echo $crow['id']; ?>" style="margin-left:1px;" class="row">
                    	<?php 
							echo wordwrap($crow['comment'],80,"<br>\n", true);
						?>
                    </div>
				  
				</div>
              	<div id="bottom" class="row" >
	            	
	            	<!--//////////////////////comment edit//////////////////////-->

	            	<div style="display: none;" id="CommentUpdate<?php echo $commentId; ?>">

                 <input  value="<?php echo $crow['comment']; ?>" name="comment" id="newCmt<?php echo $commentId; ?>" class="cmtInput form-control"></input>
      			 <input type="submit" class="btn btn-default" value="update" name="update"  onClick="cmtUpdate(<?php echo $sid; ?>, <?php echo $commentId; ?>)"></input>
  
	            	</div>
                    
                    <?php
                    $commenterId=$crow['commenterId'];
					if($crow['commenterId']==$_SESSION['myId'])
					{
					?>
						<div style="border-bottom:1px solid #89b95a; color:white; padding-bottom:5PX; padding-top:5px;">
                        <a role='button' class="btnEdit btn btn-default " id='<?php echo $commentId; ?>'  style="float:left; margin-left:10px; " onClick="cmtEdit(<?php echo $commentId; ?>)">
                    		 edit
                		</a>  
                        
                    <?php
                    }
                    ?>    
                        
                                        		<!--//////////////////////comment delete//////////////////////-->          
 				<?php
				
					$commenterId=$crow['commenterId'];
					
					if($crow['commenterId']==$_SESSION['myId'])
					{
						if(isset($_GET['profile']))
						{
				?>

			             <input type="submit" name="commentDel" value="delete" style="color:; " onClick="del(<?php echo $commentId; ?>, <?php echo $sid; ?>)" class='cmtDel btn btn-default'>

                     <?php
						}
						else
						{
					 ?>
			             <a class='cmtDel btn btn-default' id='<?php echo $commentId; ?>'  name="commentDel" value="delete" style="border:; color:black; " onClick="del(<?php echo $commentId; ?>, <?php echo $sid; ?>)"> delete</a>

                       </div>
                  <?php
						}
					}
					?>

               </div>


               </td>

            </tr>
		</div>
       <?php 
	   			}
	   ?>
       </table>

                      <script>
				
	function cmtEdit(cid)
	{
				$('#CommentUpdate'+cid).show();
				$('#commentTxt'+cid).hide();
				$('#date'+cid).hide();
	}
	
							
						
					  </script>  
<?php
	}
	
	function commentDelete($cid)
	{
		
		include 'db.php';
		$commentId=$cid;
		$s1="DELETE FROM `statuscomment` WHERE `id` = '$commentId'";
		$s2=mysqli_query($con,$s1);

	}
	
	function commentUpdate($cid,$comment)
	{
	 include 'db.php';

	 $q="UPDATE statuscomment SET comment='$comment' WHERE id='$cid'";
	 $q1=mysqli_query($con,$q);

	}
	
	
}
?>


<?php
if(isset($_GET['sid']))
{
	echo $sid=$_GET['sid'];

echo "  
<script>
  function scroll()
  {
	 	window.location.hash = '#statusScroll'+$sid;
				
  }
  </script>";	
}



$statusObj=new status;

if (isset($_POST['btnUpd'])) 
{
	$statusObj->statusUpdate($_POST['statusId'],$_POST['statusText']);
}

if (isset($_POST['statusDel'])) 
{
	$statusObj->statusDelete();
}

if (isset($_POST['statusInsert'])) 
{
	$statusObj->statusInsert();
}

class status
{
	public $posterName;
	public $posterId;
	public $status;
	public $date;

	function statusInsert()
	{
		session_start();
		include 'db.php';
		include "dateTime.php";
		
		$posterId=$_SESSION["myId"];
		$posterName=$_SESSION["myName"];
		$status=$_POST['status'];

	
		$q="INSERT INTO `status` (`id`, `status`, `statusPosterId`, `posterName`, `date`) VALUES (NULL, '$status', '$posterId', '$posterName', '$time')";
		
		$q2=mysqli_query($con,$q);
		
				if($q2)
		{
			if (isset($_GET['profile']))
			{
				header("location:timeline.php?profile=1&id=$posterId");
			}
			else
			{
				header("location:../index.php");
			}
		}


		
	}
	
	
	
	
	function statusShow($id,$poster,$date,$status,$statusID)
	{
	 ?>
     
     <div class="col-md-12">
     <script>
	 function statusScroll(sid)
	 {
		 alert('ho');
	 	window.location.hash = '#statusScroll'+sid;
	 }
	 </script>

     <div id="statusScroll<?php echo $statusID; ?>" class="col-md-12">
        <div class="row">
         <span id="statustext<?php echo $statusID; ?>">
         	
             <span class="col-md-7" style="background:white;">
                 <a href=chat/profile.php?id=<?php echo $id; ?> style="margin-left: -14px;">
                    <?php echo $poster; ?>
                 </a>
             </span>                   
              <span style="color:gray; font-weight:normal;" class="col-md-4">
                <i style="margin-left:10px">
                    Posted at:<?php echo $date; ?>
                </i>
               </span>
               
                                      <?php
					    if($id==$_SESSION['myId'])
						{
						if(isset($_GET['profile']))
					    
						{?>
                        
               <a role="button" id="arrowDown<?php echo $statusID; ?>">
                   <span class="btnNavDown" id="<?php echo $statusID; ?>" style="float:right;" class="col-md-1">
                        <img src="img/arrow-down.png" height="10px" width="10px" style="margin-left:30px">
                   </span>
               </a>
               
                <a role="button" id="arrowUp<?php echo $statusID; ?>" style="display:none;">
                   <span class="btnNavUp" id="<?php echo $statusID; ?>" style="float:right; " class="col-md-1">
                        <img src="img/arrow-up.png" height="10px" width="10px" style="margin-left:30px">
                   </span>
               </a>
               <?php
			   	
						}
						else{
			   ?>
                              <a role="button" id="arrowDown<?php echo $statusID; ?>">
                   <span class="btnNavDown" id="<?php echo $statusID; ?>" style="float:right;" class="col-md-1">
                        <img src="chat/img/arrow-down.png" height="10px" width="10px" style="margin-left:30px">
                   </span>
               </a>
               
                <a role="button" id="arrowUp<?php echo $statusID; ?>" style="display:none;">
                   <span class="btnNavUp" id="<?php echo $statusID; ?>" style="float:right; " class="col-md-1">
                        <img src="chat/img/arrow-up.png" height="10px" width="10px" style="margin-left:30px; background-color:#917eb9;">
                   </span>
               </a>
               <?php 
						}}
			   ?>
               
               <script>
			   	$('.btnNavDown').click(function(){
				 var element = $(this);
  				 var statusId = element.attr("id");  				
				 $('#navDown'+statusId).slideDown();
				 $('#arrowDown'+statusId).hide();
				 $('#arrowUp'+statusId).show();
				 
									
								});
								
								
				$('.btnNavUp').click(function(){
				 var element = $(this);
  				 var statusId = element.attr("id");  				
				 $('#navDown'+statusId).slideUp();
				 $('#arrowDown'+statusId).show();
				 $('#arrowUp'+statusId).hide();

				 
									
								});
			   </script>
                       
                               
               
          </span>
         </div>
			
			<br>
          <div class="row">	
            <div class="col-md-12" style="margin-top:-15px; margin-left:-5px;">
                <span id="statusText<?php echo $statusID; ?>" >
                    <?php echo wordwrap($status,50,"<br>\n", true); ?>
                </span><br>
                
                    <span id="statusUpdate<?php echo $statusID; ?>" style="display: none;">
                        <input name='statusText' id='Status<?php echo $statusID; ?>' value="<?php echo $status; ?>" class="form-control"></input>
                        <input type="submit" value="update" class="updStatus btn btn-success" style="margin-top: 5px;" id="<?php echo $statusID; ?>" ></input>
                    </span>
    

               </div>
           </div>     
                
<script type="text/javascript">

	function showEditableStatus(statusId)			 
		{
				 $('#statusText'+statusId).hide();
			//	 $('#editBtn'+statusId).hide();
				 $('#statusUpdate'+statusId).show();
				 $('#navDown'+statusId).slideUp();
				 $('#arrowDown'+statusId).show();
				 $('#arrowUp'+statusId).hide();
				 
		}							


						$('.updStatus').click(function(){
				 var element = $(this);
  				 var statusId = element.attr("id");  				
				 var statusText=$('#Status'+statusId).val();
					
						$.ajax({
							<?php 
							if(isset($_GET['profile']))
							{
							?>
								url:'status.php',
							<?php 
							} 
							else
							{
							?>
								url:'chat/status.php',
							<?php
							}
							?>
							
							type:'POST',
							async:false,
							data:{
								'btnUpd':1,
								'statusText':statusText,
								'statusId':statusId								
								 },
								success:function(r){
									$('#statusUpdate'+statusId).hide();
									$('#statusText'+statusId).html(statusText);
									$('#statusText'+statusId).show();
				 
									}

								});
									
								});

	            </script> 
	</div>

	           
      </div>
            
<?php	
	}

	function statusUpdate($statusId, $statustext)
	{
		include 'db.php';
		$us="UPDATE `status` SET `status` = '$statustext' WHERE `status`.`id`=$statusId";
		$usRun=mysqli_query($con,$us);
	}

	function statusDelete()
	{
		session_start();
		echo $posterId=$_SESSION["myId"];
		echo "<br>".$_POST['statusId'];
		include 'db.php';
		$s1="delete from status where id='$_POST[statusId]' AND statusPosterId=$posterId";
		$s2=mysqli_query($con,$s1);
		if($s2)
		{
			
			if (isset($_GET['profile']))
			{
				header("location:timeline.php?profile=1&id=$posterId&statusDeleted");
			}
			else
			{
				header("location:../index.php?statusDeleted");
			}

		}
	}
}
?>

<?php


?>
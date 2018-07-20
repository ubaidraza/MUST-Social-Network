<?php
$eventGalleryObj=new eventgallery;


if(isset($_POST['photoUpload']))
{
	$eventGalleryObj->photoInsert();
}



if(isset($_POST['deletePhoto']))
{
 $eventGalleryObj->photoDelete();
}


class eventgallery
{
public $eventName;	
public $photoName;
public $photoUploaderId;
public $date;

function photoInsert()
{
	include 'db.php';
	include"dateTime.php";
	session_start();
	$photoUploaderId=$_SESSION['myId'];
	$name=$_SESSION['myName'];
	
	echo $eventName=$_POST['eventName'];
$count=count(array_filter($_FILES['files']['name']));

if($count<11)
	{
		 foreach($_FILES['files']['name'] as $key=>$value)
	
		{
				echo $filename = $_FILES['files']['name'][$key];
				
				if(move_uploaded_file($_FILES['files']['tmp_name'][$key], 'eventGallery/'. $filename))
				
				{
					$p="INSERT INTO `eventgallery` (`id`, `eventName`, `photoName`, `photoUploaderId`, `date`) VALUES (NULL, '$eventName', '$filename', '$photoUploaderId', '$time')";
				
				$prun=mysqli_query($con, $p);
				if($prun)
					header('location:eventGallery.php?success=2&view=all');
				}
		}
	}
	else
	{
		header('location:eventGallery.php?view=all&limit=1');
	}
}

function photoShow()
{
     include 'db.php';
	
if(isset($_GET['view']))
{
  if($_GET['view']=='all')
   {
	 if(isset($_GET['p']))
	 {
		$page=$_GET['p'];
				
		$page=($page*12)-12;
	}
	else
	{
	$page=0;
	}
	
	$photo="select * from eventgallery ORDER BY id DESC limit $page,12;";
	$photoRun=mysqli_query($con, $photo);
	while($photos=mysqli_fetch_array($photoRun))
	{
		$name=$photos['photoName'];
		$photoId=$photos['id'];
		$date=$photos['date'];
	?>
    <div style=" margin-left:10px; margin-top:10px; margin-bottom:10px;float:left; width:170px; background:#FCF9F9; box-shadow:5px 5px 5px #ADADAD;">
       <span style="float:left; margin-left:5px; margin-top:5px; margin-bottom:5px;">
       		<img src="eventGallery/<?php echo $name; ?>" height="160px" width="160px" onClick=zoom('eventGallery/<?php echo $name; ?>',400,500); role="button"> 
		</span>

        <span style=" margin-left:20px; margin-top:5px; margin-bottom:5px; color:gray; font-size:9px;">
       		uploaded at:<?php echo $date; ?>
        </span>
        
	      <?php
        if($_SESSION['position']=='Admin' OR $_SESSION['position']=='Staff')
	   {
		   ?>
        <span style=" margin-left:50px; float:left; margin-top:5px; margin-bottom:5px;">
    	<form action="eventGalleryClass.php" method="post" id="delPhoto<?php echo $photoId; ?>">
        	<input type="hidden" name="photoId" value="<?php echo $photoId; ?>">
            <input type="hidden" name="photoName" value="<?php echo $name; ?>">
            <input type="hidden" value="delete" name="deletePhoto">
            <input type="button" value="delete" name="deletePhoto" class="btn btn-default" onClick="delNotif(<?php echo $photoId; ?>)">
        </form>
    	</span>
        
                     <script>
                    	function delNotif(id)
						{
					bootbox.confirm("Are you sure you want to delete this?", function(result){if (result) {$('#delPhoto'+id).submit();}});
						
						}
                    </script>
       <?php
	   }
	   ?>
        

    </div>

   <?php
	}
   }
}
?>


		<?php
		////////////////////////////////ALbum Name/////////////////////////////////////////
		
        if(isset($_GET['view']))
            {
                if($_GET['view']=='album')
                 {
                     
                     $view2="select DISTINCT eventName from eventgallery ";
                     $viewRun=mysqli_query($con, $view2);
                     if($viewRun)
                     while($views=mysqli_fetch_array($viewRun))
                     {
						?>
                        <div style=" margin-left:10px; float:left; margin-top:10px;">
                        	<a href="eventGallery.php?view=albums&album=<?php echo $views['eventName'];?>" role="button" class="btn btn-success"> 
								<?php echo $views['eventName'];?>
                            </a>
                        </div>
                        <?php
                     }
                  }
             }
			 
       ////////////////////////////////////////////Album view///////////////////////////////////////////////////////// 
	   
	           if(isset($_GET['album']))
            {
					$eventName=$_GET['album'];
		
					 	 if(isset($_GET['p']))
							 {
								$page=$_GET['p'];
										
								$page=($page*12)-12;
							}
							else
							{
							$page=0;
							}
		
			   	 	 $albView2="select * from eventgallery where eventName='$eventName' ORDER BY id DESC limit $page,12";
                     $albViewRun2=mysqli_query($con, $albView2);
		
					 while($albVw=mysqli_fetch_array($albViewRun2))
					 {
						 $pName=$albVw['photoName'];
						 $pId=$albVw['id'];
						 $photoDate=$albVw['date'];
					?>
                  <div style=" margin-left:10px; margin-top:10px; float:left; width:170px; background:#FCF9F9; box-shadow:5px 5px 5px #ADADAD;">
                   <span style="float:left; margin-left:5px; margin-top:5px;">
                        <img src="eventGallery/<?php echo $pName; ?>" height="160px" width="160px" onClick=zoom('eventGallery/<?php echo $pName; ?>',400,500); role="button"> 
                    </span>
 
                    <span style=" margin-left:20px; margin-top:5px; margin-bottom:5px; color:gray; font-size:9px;">
	                    uploaded at:<?php echo $photoDate; ?>
                    </span>
                                
                <?php
        	   if($_SESSION['position']=='Admin' OR $_SESSION['position']=='Staff')
	   			{
		   		?>
                    <span style=" margin-left:50px; float:left; margin-top:5px; margin-bottom:5px;">
                    <form action="eventGalleryClass.php" method="post" id="photoDel<?php echo $pId; ?>">
                        <input type="hidden" name="photoId" value="<?php echo $pId; ?>">
                        <input type="hidden" value="delete" name="deletePhoto">
                        <input type="button" value="delete" name="deletePhoto" class="btn btn-default" onClick="delNoti(<?php echo $pId; ?>)">
                    </form>
                    
                    <script>
                    	function delNoti(id)
						{
					bootbox.confirm("Are you sure you want to delete this?", function(result){if (result) {$('#photoDel'+id).submit();}});
						
						}
                    </script>
                    </span>
                <?php
				}
				?>    
                </div>	
				
				<?php
					}
			}
		
		//////////////////////////////////////////////////////slides////////////////////////////
		      	 if(isset($_GET['view']))
	 {
		 if($_GET['view']=='slides')
		 {
			$count=0;
			$slide="select * from eventgallery ORDER BY id DESC";
			$slider=mysqli_query($con, $slide);
			while($sliderview=mysqli_fetch_array($slider))
			{
				$slideName=$sliderview['photoName'];
			++$count;
			?>
					<img src="eventGallery/<?php echo $slideName; ?>" height="200px" width="200px"  role="button"> 
				<?php
			}
		 }
	 }
		?>
<?php
}

function photoDelete()
{
	include 'db.php';
	$name=$_POST['photoName'];
 	$photo="delete from eventGallery where id='$_POST[photoId]'";
	$delPhoto=mysqli_query($con, $photo);
	if($delPhoto)
	unlink("eventGallery/$name");
	{header("location:eventGallery.php?view=all&success=1");}
}

function slider()
{}


}
?>
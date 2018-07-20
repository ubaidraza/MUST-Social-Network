<div class="container-fluid text-center">    
  <div class="row content" style="height:950px;" id="firstDiv">
    <div class="col-sm-2 sidenav">
		
        <span class="section">
        	<a role="button" href="eventGallery.php?view=all" class="btn btn-info" id="eall">
            	 All Photo
            </a>
       	</span>
        <span class="section" >
            <a role="button" href="eventGallery.php?view=album" class="btn btn-info" id="ealbum">
        	     Albums
            </a>
        </span>
        <span class="section" >
            <a role="button" href="eventGallery.php?view=slides" class="btn btn-info" id="eslides">
            	Slides
            </a>
        </span>
             <script> 
				document.getElementById('e<?php echo $_GET['view']; ?>').style.background='white';
				document.getElementById('e<?php echo $_GET['view']; ?>').style.color='orange';

			</script>
        
        
    </div>
    
    <div class="col-sm-7 text-left" style="background:#F7F5F5; height:950px;" id="middleDiv"> 
    
    	
                    	<?php
				if(isset($_GET['view']))
				 {
					if($_GET['view']!='slides')
					{
				?>
        <div style=" background:white; margin-top:10px; box-shadow:5px 5px 5px #D1CBCB">
            
            <span style=" width:100%; background:#38DDF1; height:30px; color:white; float:left; font-size:20px; margin-bottom:10px; ">
                <span style=" margin-left:40%;"> Image Uploader</span>
            </span>
           
                <div style="padding:10px;">
     	         <form action="eventGalleryClass.php?photoUpload=1" method="post" enctype="multipart/form-data">
                    <label  for="fileToUpload" style="">Select image to upload:</label><font color="green"> Max Photos can select:10</font>
                    <input type="file" name="files[]" id="fileToUpload" multiple required accept="image/*">

                    <br>
                    Event Name: <input type="text" name="eventName" required><br>
                    <input type="submit" value="Upload" name="photoUpload">
                </form>
                                        <?php 
							if(isset($_GET['limit']))
							{
							?>
							 <font color="red"><i> Upload fail, please select 10 photo Only</i></font>
							<?php
							}
							?>

                <?php
					if(isset($_GET['success']))
					{
						echo "<font color='green'>Successfully uploaded</font>";
					}
				?>
             </div>
         </div>
         	
         <?php
			}
			}

///////////////////////////////////////////All photo////////////////////////////////////////////////////////////		 

		 	if(isset($_GET['view']))
			{
				if($_GET['view']=='all')
				{
		 ?>
         
         <div style=" background:white; margin-top:10px;  min-height:100px; max-height:; overflow:hidden; overflow-y:scroll; box-shadow:5px 5px 5px #ADADAD;" id="imagegallery">
             <span style=" width:100%; background:#38DDF1; height:30px; color:white; float:left; font-size:20px;">
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
            <a href='eventGallery.php?p=<?php echo $i; ?>&view=all'  role="button" class="btn btn-info" id="enable<?php echo $i; ?>"><?php echo $i; ?></a>
            
		
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
		 echo "<script> alert('successfully deleted');</script>";
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
            <a href='eventGallery.php?view=albums&album=<?php echo $eventName; ?>&p=<?php echo $i; ?>'  role="button" class="btn btn-info" id="enable<?php echo $i; ?>">
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
	       
      	 if(isset($_GET['view']))
	 {
		 if($_GET['view']=='slides')
		 {
    ?>
    

		<div id="">
		<?php
		//	$eventGalleryObj->photoShow();            
        ?>
		</div>

    <?php
		}
	 }
	?>  
      
      
    </div>
    
    <div class="col-sm-3 sidenav" style="height:950px;">

        
    </div>

	

  </div>
</div>
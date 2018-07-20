    <div style=" background:; border-right:1px rgba(159,153,153,1.00) solid; border-right:1px rgba(159,153,153,1.00) solid" class="col-md-3">
    
    	<div style="height:480px;">	
        

			            
            
			<?php
			$convObj2->showConversation();
			?>
		</div>	
	
    </div>

	<div style=" height:460px; margin-left:-10px; padding-left:10px; width:350px; background:;" class="col-md-3" >
    
       <div style="height:440px; margin-left:-75px;">
       
       		<?php 
			 if(isset($_GET['name']))		
			 {
				 $name=$_GET['name'];
				if($name!=0 AND $name!='')
				{
			?>
                <div style=" width:80%; height: 20px; background:blue; margin-left:75px;" >
                   <font color="white">
                   <div style=" font-weight:600; margin-left:120px ">
                       
                        <?php 
                            echo $name;
                        ?>
                      </div>
                   </font>

                </div>
            <?php
				}
			 }
			
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
  
	</div>    

        </div>
             <div class="col-md-1" style=" margin-left:10px; height:400px;">
    <?php	
                if(isset($_SESSION['convId']))
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
                
                <span class="row" >
                    <form action="conversationChatClasses.php?msgEdit=2" method="post">
                    	<input type="hidden" name="conId" value="<?php  echo $convId; ?>"/>
	                    <input type="submit" name="delChat" Value="Delete Chat" class="btn btn-danger"/>
                    </form>
                </span>
            <?php
			}
			?>
        	</div>


    <footer class="container-fluid text-center" style="width:100%; float:left; background:#555555; height:50px; color:white;">
  	<br>	<p>UMSIT social Network © 2016</p>
	</footer>
</body>
</html>
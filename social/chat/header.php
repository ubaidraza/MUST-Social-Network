<?php
//session_start();
?>


 <div id="siteheader" class="row content" >

         <div class="col-sm-9 text-left" id="left">
            <span id="logo" style="margin-left:20px;">
                <img src="img/logo.png" height="90px" width="90px" id="img">
            </span>

            <span id="heading">
                Must Social Media
            </span>
        </div>
        
        <div class="col-sm-3 text-left" id="right" style="margin-left:-10px; margin-top:15px;">

       		login as
       		<span id="loginas" style="width:200px;">
	 	   		<?php echo "<br><font color=orange size=5>".$_SESSION["myName"]."</font><br>";?>
	 	  	</span>



        </div>
</div>
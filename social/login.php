<?php
    session_start();
    if(empty($_SESSION["myId"]))
    {}
    else
    {header("location:index.php");}
    

include 'chat/db.php';


?>

<!DOCTYPE html>
<html >
  <head>
  <script>
function confirm()
{
var a=document.getElementById('pwd').value;
var b=document.getElementById('rpwd').value;

if(a!=b)
{
    document.getElementById('rpwd').style.border="1px solid red";   
}
else
{
        document.getElementById('rpwd').style.border="1px solid green"; 

}

}

function confirm1()
{
var a=document.getElementById('pwd').value;
var b=document.getElementById('rpwd').value;

if(a!=b)
{
    document.getElementById('rpwd').style.border="1px solid red";
    document.getElementById('invalidMsg').style.display="block";    
}
else
{
        document.getElementById('rpwd').style.border="1px solid green"; 
        document.getElementById('invalidMsg').style.display="none";

}

}
</script>
    <meta charset="UTF-8">
    <?php include 'chat/title.php'; ?>
            <link rel="stylesheet" href="login-content/css/style.css">
            <link rel="stylesheet" href="chat/stylesheet/bootstrap.min.css">

  </head>

  <body>


<center>
<div class="box">
<form method="post" action="chat/member.php" >
<table width="301">
<tr>
<td width="310" align="center">
<h1>MUST Social Network Login</h1>
</td></tr>
<tr>
<td align="center">
<?php
if(isset($_GET['msg']))
{
echo "<font color=".'red'.">email/password invalid</font>"; 
}
?>
</td></tr>

<tr>
<td align="center">
<input type="email" name="user" value="email" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />
  </td></tr>
  <tr>
  <td align="center" >
<input type="password" placeholder="password" name="pwd"  onFocus="field_focus(this, 'password');" onblur="field_blur(this, 'password');" class="email" id="pwdshow" />
</td></tr>
<tr>
<td align="right">
    <div style="margin-right:10px;"> show password<input type="checkbox" onClick="showPwd()"></div>
</td></tr>

<tr>
<td><input type="submit" class="btn" value=" Sign In" name="submit" >  <!-- End Btn -->

<a href="#"><div class='btn btn-info' onClick="signUpForm()"><center>Sign Up</center></div></a> <!-- End Btn2 -->
</td>
  </tr></table>
</form>
<p>Forgot your password? <a  href='' role="button" style="color:#f1c40f;" id="forget" onClick="forgetShow()">Click Here!</a></p>

</div> <!-- End Box -->

                <script>
                var a=0;
                    function showPwd()          
                    {
                        if(a==0)    
                        {
                        document.getElementById('pwdshow').setAttribute('type','text'); 
                        a++;
                        }
                        
                        else
                        {
                        document.getElementById('pwdshow').setAttribute('type','password'); 
                        a=0;
                            
                        }
                    }
                    
                    function forgetShow()
                    {
                        $('.box').slideUp('slow');  
                        $('.box3').slideDown('slow');
                    }
                    
                    function signUpForm()
                    {
                        $('.box2').slideDown('slow');
                        $('.box').slideUp('slow');  
                        $('.box3').SlideUp('slow');                         
                    }
                    
                    function showLogin()
                    {
                        $('.box').slideDown('slow');
                        $('.box2').slideUp('slow'); 
                        $('.box3').slideUp('slow');     
                    }
                </script>


<div class="box2" style="display:none;">
         <a href="" style="color:white; background:red; text-decoration:none; float:right; padding:6px;" onClick="showLogin()" role="button">
            x
        </a>
 <h1>Sign Up</h1>
 <script>
 function validateForm()
 {
    var cnic=$('.cnic').val().length;

    if(cnic!=13)
    {
        document.getElementById('invalidCnic').style.display="block"; return false; 
    }
    
    var phone=$('.phone').val().length;  
        if(phone!=12)
    {
        document.getElementById('invalidNo').style.display="block"; return false;   
    }

}
 </script>
            <form action="chat/member.php" method="post" name="signupForm" onsubmit="return validateForm()">
                <table id="rmain1">

                    <tr><td><input type="text" name=fname id="input" placeholder=" Enter First Name" required class="email" pattern="[A-Za-z]*" title="Enter Alphatbets only"></td>
                    

                   <td><input type="text" name=lname id="input" placeholder=" Enter Last Name" required class="email" pattern="[A-Za-z]*" title="Enter Alphatbets only"></td></tr>
                     
                    <tr><td><input type="number" name=cnic id="input" placeholder=" Enter CNIC" required  minlength="13" maxlength="13" class="email cnic">
                    <span style="color:red; display:none;" id="invalidCnic">CNIC must contain 13 digits</span>
                    </td>

                    <td><input type="email" name=email id="input" placeholder=" Enter Email Address" required class="email"></td></tr>

                    <tr><td><input type="text" name=city id="input" placeholder=" Enter City Name" required class="email" ></td>

                    <td><input type="number" name=phone id="input" placeholder="Enter Cell no. 9234100000123" required maxlength="13" min="13" class="email phone">
                    <span style="color:red; display:none;" id="invalidNo">Phone number must contain 12 digits</span>
                    </td></tr>

                    
                    <tr><td><input type="password" name=pwd class="input email"  id="pwd" placeholder=" Enter Password" minlength="6" required ></td>
                    
                    <td><input type="password" name=rpwd class="input email" id="rpwd" placeholder=" Re-Enter Password" required onKeyUp="confirm()" onChange="confirm1()" > <span style="color:red; display:none;" id="invalidMsg">password not match</span></td></tr> 
                    

                    
                    <tr><td>
                    <select name="department" style="width:200px; text-align:center; " id="input" required class="email">
                        <option selected disabled>select department</option>
                        <option value="CS & IT">CS & IT</option>
                        <option value="Banking">Banking</option>
                        <option value="Business">Business</option>
                        <option value="Math">Math</option>
                    </select>
                    </td>
                    
                    <td>
                        <input type="date" name=dob id="input" placeholder="eg: 17/03/1990" class="email">
                    </td>  

                    </tr>
                    
                    <tr>
                    <td>
                    <select name="question" style="width:200px; text-align:center; " id="input" required class="email">
                        <option selected disabled>select security question</option>
                        <option value="Place of Birth?">Place of Birth?</option>
                        <option value="Favourite Movie">Favourite Movie?</option>
                        <option value="Favourite Place?">Favourite Place?</option>
                        <option value="First Pet Name?">First Pet Name?</option>

                    </select>
                    </td>
                     <td>
                <input type="text" name="answer" placeholder="Enter your answer" id="input" class="email" required>

                    </td>
                    </tr>

                    <tr>
                    <td>
                    <select name="position" style="width:200px; text-align:center; " id="input" required class="email">
                        <option selected disabled>select Your Position</option>
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Staff">Staff</option>
                    </select>
                    </td>                        
                    </tr>

                    
                    <tr><td>Gender</td></tr>
                    <tr><td>&nbsp&nbsp Male<input type="radio" name=gender value="male" id="gender" required >
                    &nbsp&nbsp Female<input type="radio" name=gender value="female" id="gender" required></td></tr>
                    
                    <tr><td><input type="submit" value="Sign Up" id="button" name="signup" class="btn"></td></tr>
                </table>
            </form> 
            
   </div>      
               
     <div style=" display:none;" id="forgetForm" class="box3">
         <a href="" style="color:white; background:red; text-decoration:none; float:right; padding:6px;" onClick="showLogin()" role="button">
            x
        </a>
            <table>
            
            <form action="chat/member.php" method="post" autocomplete="false">
                <h1>Reset Password</h1>
                <tr>
                <td>
                <input type='number' name="cnic" placeholder="Enter CNIC" id="input" class="email" >
                </td>
                </tr>
                <tr>
                <td>
                <select name="question" style="width:200px; text-align:center; " id="input" required class="email">
                    <option selected disabled>select security question</option>
                    <option value="Place of Birth?">Place of Birth?</option>
                    <option value="Favourite Movie">Favourite Movie?</option>
                    <option value="Favourite Place?">Favourite Place?</option>
                    <option value="First Pet Name?">First Pet Name?</option>
                </select>
                </td>
                </tr>
                
                <tr>
                <td>
                <input type="text" name="answer" placeholder="Enter your answer" id="input" class="email">
                </td>
                </tr>
                
                <tr>
                <td>
                <input type="password" name="password" placeholder="Enter new Password" onFocus="field_focus(this, 'new password');" onblur="field_blur(this, 'new password');" id="input" class="email">
                </td>
                </tr>
                
                <tr>
                <td>
                <input type="submit" name="updPwdF" value="Change Password" class="btn3 btn-success" style="margin-top:5px;" id="submitSgn">        
                <tr>
                <td>
            </form>
            </table>
        </div>
            


</center>


  
<script src="chat/javascript/jquery.min.js" type="text/javascript"></script>    
<script src="login-content/js/index.js"></script>
 <script src="chat/javascript/bootstrap.min.js"></script>
 <script src="chat/javascript/bootbox.min.js"></script>

 <?php
 if(isset($_GET['pfailed']))
{
echo "<script>             
            bootbox.alert({
               message: 'Fail to change password',
               size: 'small'
                }); 
    </script>";     
}



if(isset($_GET['changed']))
{
echo "<script>             
            bootbox.alert({
               message: 'Password Successfully Changed',
               size: 'small'
                }); 
    </script>"; 
}

if(isset($_GET['sFail']))
{
echo "<script>             
            bootbox.alert({
               message: 'Sign Up fail, Please provide valid information',
               size: 'small'
                }); 
    </script>";  
}

if(isset($_GET['pnotmatch']))
{
echo "<script>             
            bootbox.alert({
               message: 'Password Not match, signup fail',
               size: 'small'
                }); 
    </script>"; 
}

if(isset($_GET['sSuccess']))
{
echo "<script>             
            bootbox.alert({
               message: 'Successfully SignUp',
               size: 'small'
                }); 
    </script>"; }

?>   
    
    
  </body>
</html>


						 
function check(e, textarea)
{
var code = (e.keyCode ? e.keyCode : e.which);
if(code == 13) 
{ 
insertd();
}
}



function loadnewsms()
{
	document.getElementById("people").src=document.getElementById("people").src;
}





//showdata();

				function insertd(){
				
					var msgs=$('#input').val();  
						document.getElementById("input").value=""; 
						if(msgs!="")
						{
						$.ajax({
						
							url:'chat/conversationChatClasses.php',
							type:'POST',
							async:false,
							data:{
								'saverecord':1,
								'msgs': msgs
								 },
							success:function(re){
								$("#showMsg").animate({ scrollTop: $("#showMsg")[0].scrollHeight}, 1000);
								$('#photo').html(re);
												}
	
							});
						}	
									}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////



						function showdata(memberId,memberName)
					{
				/*	
				  var xhttp; 
				  xhttp = new XMLHttpRequest();
				  xhttp.onreadystatechange = function() {
				    if (xhttp.readyState == 4 && xhttp.status == 200) {
				    document.getElementById("showMsg").innerHTML = xhttp.responseText;
				    }
				  };
				  xhttp.open("GET", "chat/conversionChatClasses.php", true);
				  xhttp.send();
						
						
						

						$.ajax({
							url:'chat/conversationChatClasses.php',
							type:'POST',
							async:false,
							data:{
								'startConversation':1,
								'memberId':memberId,
								'memberName':memberName
								},
							success:function (r){
								//alert("hi");
								$('#showMsg').html(r);
									}
						});
*/
					}


					function scrolldown()
					{
						$("#chatdata").animate({ scrollTop: $("#chatdata")[0].scrollHeight}, 1000);
					}
					
					
					setInterval(showdata2,800);
					function showdata2()
					{

				
						//document.getElementById("input").value=""; 
						
						$.ajax({
							url:'chat/conversationChatClasses.php',
							type:'POST',
							async:false,
							data:{
								'show':1
								},
							success:function (r){
								//alert("hi");
								$('#showMsg').html(r);
									}
						});

					}
					

						
						

						function commentInsert(statusId)
	{
		//alert(statusId);
		
					var comment=$('#commentBox'+statusId).val();
					var commenterId= $('#commenterId'+statusId).val(); 
					var commenterName= $('#commenterName'+statusId).val(); 

						document.getElementById("commentBox"+statusId).value=""; 
						if(comment!='')
						{						
						$.ajax({
							url:'chat/comment.php',
							type:'POST',
							async:false,
							data:{
								'btnComment':1,
								'comment':comment,
								'statusId':statusId,
								'commenterId':commenterId,
								'commenterName':commenterName								
								 },
								success:function(r){
									
									$('#Comment'+statusId).load('index.php #Comment'+statusId);

									}

								});
								
	}
	}
	
	
	function commentInsert2(statusId)
	{
		//alert(statusId);
		
					var comment=$('#commentBox'+statusId).val();
					var commenterId= $('#commenterId'+statusId).val(); 
					var commenterName= $('#commenterName'+statusId).val(); 

						document.getElementById("commentBox"+statusId).value=""; 
						if(comment!='')
						{						
						$.ajax({
							url:'comment.php',
							type:'POST',
							async:false,
							data:{
								'btnComment':1,
								'comment':comment,
								'statusId':statusId,
								'commenterId':commenterId,
								'commenterName':commenterName								
								 },
								success:function(r){
									
									$('#Comment'+statusId).load('timeline.php?profile=1 #Comment'+statusId);
									//$('#internalComment'+statusId).animate({ scrollTop: $('#internalComment'+statusId).prop('scrollHeight')}, 800);
									//$('#Comment'+pid).html(r);
									//alert('i');
								
									}

								});
								
					}
					}
	
	
	
	
	function zoom(photo, title,w,h) 
{
    var left = (screen.width/2)-(w/2);

    var top = (screen.height/2)-(h/2);

    var targetWin = window.open (photo, title, 'titlebar=0, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
	
	
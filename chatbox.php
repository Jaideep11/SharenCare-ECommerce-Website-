<?php
include 'session_check_user.php';
if(isset($_SESSION) && $_SERVER['HTTP_REFERER'])
{
    ?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Snippet - BBBootstrap</title>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="Cs/chatbox.css">
        <script type="text/javascript">
        	
        $(document).ready(function(){
			loadChat();
		});
	

       $(document).ready(function(){
        	$('#message').keyup(function(e){
        		var message=$(this).val();
        		if(e.which==13)
        		{
        			var raid='<?php echo $receiver_id; ?>';
        		
        			$.post('handlers/ajax.php?action=SendMessage&raid='+raid+'&message='+message, function(response){
        				
						loadChat();
					    
					});
					
				
					$('#message').val('');

				}
        	});
        	

        	});
	
    		function loadChat()
			{
				$.post('handlers/ajax.php?action=getChat&raid='+'<?php echo $receiver_id; ?>', function(response){
				// alert(response);
					$('.chathistory').html(response);

				});
			}
			
		
setInterval(function(){
			loadChat();
		}, 2000);

		</script>

<script type="text/javascript">
	























</script>


<style>
</style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
</head>
<section class="chatbox">
<body oncontextmenu='return false' class='snippet-body'>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card card-bordered">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Chat</strong></h4> 
                    </div>



                    
                    <div class="ps-container ps-theme-default ps-active-y chathistory" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">
                        <!-- <section style="float: right;">
                        	
                        </section> -->

                             <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                            <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                        </div>
                    </div>

                    

                <div class="publisher bt-1 border-light"> 
                	<img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="..."> 
                	<input id="message" name="message" autocomplete="off"  class="publisher-input" type="text" placeholder="Write something"> 

                	<span class="publisher-btn file-group"> <i class="fa fa-paperclip file-browser"></i> <input type="file"> </span> <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a> <a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a> </div>

                </div>
            </div>
        </div>
    </div>
</div>
                            </body>
                            </section>
                        </html>



                        <style type="text/css">
                        	
                        </style>

<?php
}
else
{
    header('location: index.php');
    exit();
}
?>

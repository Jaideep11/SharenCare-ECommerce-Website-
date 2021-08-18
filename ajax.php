<?php

include'../session_check_user.php';
include("../includes/dbh.inc.php");
function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}


$raid=$_REQUEST['raid'];  //reciever account id
$_SESSION['raid']=$raid;
if( isset($_REQUEST['action']) && $_SESSION["email"] )
{

	$said=$_SESSION["accountid"]; //sender account id

	switch( $_REQUEST['action'] )
	{

		case "SendMessage":
			$msg=$_REQUEST['message'];

			$msg = my_simple_crypt( $msg ,'e');

			$sql = "SELECT chat_id from chats where sender_id=$said AND receiver_id=$raid";
			$result=$conn->query($sql);
			if($result->num_rows  > 0 )
			{
				$row = $result->fetch_assoc(); 
				$chat_id=$row['chat_id'];
			}
			else
			{
				echo "Inserting new chat";
				$sql = "INSERT into chats(sender_id,receiver_id) values ($said,$raid)";
				// $result = $conn->query($sql);
				if(mysqli_query($conn, $sql))
				{

					$sql = "SELECT chat_id from chats where sender_id=$said AND receiver_id=$raid";
					$result=$conn->query($sql);
					if($result->num_rows  > 0)
		    		{	
						$row = $result->fetch_assoc(); 
						$chat_id=$row['chat_id'];
					}
					else
					{
						echo "Error getting chat id: " . mysqli_error($conn);
						exit();
						
					}

				}
				else
				{
					echo "New Chat could not be created: " . mysqli_error($conn);
					exit();
				}
			}

		$sql="INSERT into chat_messages(mchat_id,message) values ($chat_id,'$msg')";
			if(mysqli_query($conn, $sql))
		    {
		    	echo "Chat Message Is Sent";
		        // header('location: ../show_all_products.php?update=success');
		        exit();
		    } 
		    else
		    {
		      echo "Error Sneding Messgae: " . mysqli_error($conn);
		      // header('location: ../show_all_products.php?update=failed');
		        
		        exit();
		    }

			echo 1;


		break;

		case "getChat":
		
		$sql="SELECT 
		    msg_date,
		    DATE_FORMAT(msg_date , '%d-%m-%Y %T') as date_order, 
		    TO_DAYS(msg_date) as days,
		    TIME_TO_SEC(TIME(msg_date)) as seconds,
		    chat_id,message,sender_id,receiver_id
		FROM 
		    chats,chat_messages
		WHERE 
		 chat_id=mchat_id AND (sender_id=$said AND receiver_id=$raid) OR (sender_id=$raid AND receiver_id=$said ) AND chat_id=mchat_id 
				ORDER BY 
		      msg_date ASC,  days ASC, seconds ASC";

	
					$chat = '';
				    $result = $conn->query($sql);
				    if ($result->num_rows > 0) 
		    		{	 
		    			while($row = $result->fetch_array())
      					{
      						$currmsg=$row['message'];
      						$currmsg = my_simple_crypt( $currmsg,'d' );
      						$timestamp = strtotime($row['msg_date']);	// time of msg
							$msg_date = date('n.j.Y', $timestamp); // d.m.YYYY
							$msg_time = date('H:i', $timestamp); // HH:ss

							// if (date('Y-m-d',strtotime(NOW())) == date('Y-m-d', $timestamp) 
							// 	$msg_date="Today";
    
      						if($row["sender_id"]==$_SESSION["accountid"])
      						{
      							$chat .='
      								<div class="media media-chat" style="
									   padding-right: 64px;
									    margin-bottom: 0;

									   ">
      								
                            <div class="media-body" >
                                <p style="

                                 position: relative;
							    padding: 6px 8px;
							    margin: 4px 0;
							    background-color: #f5f6f7;
							    border-radius: 3px

                                ">'.$currmsg.'</p>
                                <p class="meta"><time datetime="'.$msg_date.'">'.$msg_time.'</time></p>
                            </div>
                        </div>

      								';
      						}
      						
      						if($row["receiver_id"]==$_SESSION['accountid'])
      						{
      							$chat.='
      							
      							
      					<div class="media media-chat media-chat-reverse" style="

      					  padding-right: 12px;
					    padding-left: 64px;
					    -webkit-box-orient: horizontal;
					    -webkit-box-direction: reverse;
					    flex-direction: row-reverse;

      					">



      					 <img class="avatar" src="img/administrator-male2.png" alt="...">
                            <div class="media-body ">
                                <p style=" float: right;
							    clear: right;
							    background-color: #48b0f7;
							    color: #fff;

    ">'.$currmsg.'</p>
                                <p class="meta"><time datetime="'.$msg_date.'">'.$msg_time.'</time></p>
                            </div>
                        </div>


      					';
      						}
      						


						 } 
					}
					else
					{
						echo "Chat Not Started Yet" . mysqli_error($conn);
						exit();
						
					}
					echo $chat;

		break;



	}


}
mysqli_close($conn);


?>
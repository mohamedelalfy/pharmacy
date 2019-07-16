<?php 
	/*
	==================================================
	==	Members Page
	==================================================
	*/
ob_start(); // Output Buffering Start
session_start();
$pageTitle = "Message";

if(isset($_SESSION['Username']))
{
	include "init.php";
    $action = isset($_GET['action']) ? $_GET['action']  : 'Manage' ;

    if($action == 'Manage'){
    // Start Message page 
	$stmt = $con->prepare("SELECT private_message.*, 
                                    users.UserName AS Username
                                From 
                                    private_message
                                INNER JOIN 
                                    users
                                ON
                                    users.UserID = private_message.User_ID");
        // Execute The Statement

        $stmt->execute();
        // Assign To Variable
        $messages = $stmt->fetchAll();
	if(! empty($messages)){
	?>
		<h1 class="text-center">messages Members</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-bordered">
					<tr>
                        <td>Username</td>
                        <td>Image</td>
						<td>Subject</td>
						<td>Message</td>
						<td>Date</td>
						<td>Control</td>
					<tr>
					<?php
					foreach($messages as $message){
                        echo "<tr>";
                            echo "<td>".$message['Username']."</td>";
							echo "<td>";
								if(empty($message['Images'])){

									echo "No Photo Sent";
								}else{
									echo "<img src='uploads/image/PrivateMessage/" . $message['Images'] . "' alt='image'>";
								}
							echo "</td>";

							echo "<td>".$message['Subject']."</td>";
							echo "<td>".$message['Message']."</td>";
							echo "<td>".$message['Date']."</td>";
							echo "<td>
                                <a href='Message.php?action=Delete&M_ID=". $message['M_ID']."'' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>
                                <a href='Message.php?action=repaly&user_ID=". $message['User_ID']."'' class='btn btn-info'><i class='fa fa-plus'></i> Replay</a>";
							echo "</td>";
						echo "</tr>";
					}
					?>
				</table>
			</div>
		</div>
	<?php
    }else{
        echo "<div class='container'>";
            echo "<div class='empty'>There's No Message To Show </div>";
        echo "</div>";
    }
}elseif($action == 'Delete'){
              
    echo "<div class='container'> ";

    // Check If Get Request userid  Is numeric & Get The Integer Value Of It

    $M_ID = isset($_GET['M_ID']) && is_numeric($_GET['M_ID']) ? intval($_GET['M_ID']) : 0;

    // Select All Data Depend On This ID

    $check = checkItem('M_ID', 'private_message', $M_ID);

    // If There's Such ID Show The Form

    if ($check > 0) {

        $stmt = $con->prepare("DELETE FROM private_message WHERE M_ID = :zmid");

        $stmt->bindParam(":zmid", $M_ID);

        $stmt->execute();
        
        $theMsg = "<div class='alert alert-success'>Message Deleted</div>";
        redirectHome($theMsg, 'back','2');

    } else{

        $theMsg = "<div class='alert alert-danger'>This ID Is Not Exist</div>";
        redirectHome($theMsg, 'back','2');

    }
        echo "</div>";
    }elseif($action == 'repaly'){ ?>
        <!-- Start Section Contact Us -->
        <section class="contact-us text-center">
        <div class="fields">
            <div class="container">
                <div class="row">
                    <i class="fa fa-weixin fa-5x"></i>
                    <h2 class="h1" id="private"> Private Message </h2>
                    <!-- Start Contact Form -->
                    <form role="form" action='?action=Insert' method="POST">
                        <div class="col-md-6" >
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control input-lg" placeholder="subject" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type='submit' class='btn btn-primary btn-lg btn-block' value='send message'>
                            </div>
                        </div>
                        <div class="col-md-6 " >
                            <div class="form-group">
                                <textarea  name="message" class="form-control input-lg" placeholder="Your Message"></textarea>
                            </div>
                        </div>
                    </form>
                    <!-- End Contact Form -->
                </div>
            </div>
        </div>
        </section>
<!-- End Section Contact Us -->
   <?php } elseif($action == 'Insert'){

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $stmt=$con->prepare('SELECT UserID FROM users');
            $stmt->execute();
            $user = $stmt->fetch();

            $subject 	= $_POST['subject'];
            $message    = $_POST['message'];
            $id         = $user['UserID'];
    
            //Insert User Info In Database 

            $stmt = $con->prepare("INSERT INTO 
                                    private_message(Subject, Message, Date, User_ID) 
                                  VALUES(:xsubject, :xmessage, now(), :xuserid)");
                    
            $stmt->execute(array(
                'xsubject'  =>	$subject,
                'xmessage'	=>	$message,
                'xuserid'    =>  $id
            ));		

            //Echo Success Message

            $theMsg = "<div class='alert alert-success'> The message was sent successfully and I waited for the reply from the Admin</div>";

            redirectHome($theMsg , 'back');
        }else{
            echo 'noo';
        }
   }
}
?>
<?php include $tpl.'footer.php'; 
 ob_end_flush();
?>
<?php 
ob_start(); // Output Buffering Start
session_start();
include 'init.php'; 

    $action = isset($_GET['action']) ? $_GET['action'] : 'Manage' ;

    $noNavbar = '';

    $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?");

    $stmt->execute(array($sessionuid));

    $user = $stmt->fetch();

    $count = $stmt->rowCount();

    if($count > 0){ ?>

<h1 class="text-center profile-name">Profile <?php echo $sessionUser ?></h1>
<div class="container">
    <div class="profile">
        <div class="row">
            <div class="col-md-6">
            <?php 
                if(empty($user['Images'])){
                    echo "<img src='layout/images/UserImage/Avatar.png' alt='User-img'>";
                }else{
                    echo '<img class="Profile-img img-responsive" src="admin/uploads/image/UserImage/'.$usre['Images'].'" style="max-height: 714px"  alt="user-img" />';
    
                }
            ?>
            </div>
            <div class="col-md-6">
                <form class="form-horizontal" action=<?php echo $_SERVER['PHP_SELF'] ?> method="POST" enctype= "multipart/form-data">
                    <input type="hidden" name="userid" value="<?php echo $sessionuid ?>">
                    <!-- Start Username Field -->
                        <div class="form-group form-group-lg">
                            <div calss="row">
                                <label class="lab">Name</label>
                                <div class="col-sm-10 col-md-12">
                                    <input type="text" name="username" class="form-control" autocomplete="off" required="required" placeholder="Username To Login Into Pharmacy" value="<?php echo $user['UserName'] ?>">
                                </div>
                            </div>
                        </div>
                    <!-- End Username Field -->
                    <!-- Start Fullname Field -->
                    <div calss="row">
                        <div class="form-group form-group-lg">
                            <label class="lab">Fullname</label>
                            <div class="col-sm-10 col-md-12">
                                <input type="text" name="full" class="form-control" autocomplete="off" required="required" placeholder="Full name To Login Into Pharmacy"  value="<?php echo $user['FullName'] ?>">
                            </div>
                        </div>
                    </div>
                    <!-- End Fullname Field -->
                    <!-- Start Password Field -->
                    <div calss="row">
                        <div class="form-group form-group-lg">
                            <label class="lab">New Password</label>
                            <div class="col-sm-10 col-md-12">
                                <input type="hidden" name="oldpassword" value="<?php echo $user['Password']?>" >
                                <input type="password" name="password" class="form-control" autocomplete="new-password"  placeholder="Password Must Be Hard & Complex">
                            </div>
                        </div>
                    </div>
                    <!-- End Password Field -->
                    <!-- Start Password Field -->
                    <div calss="row">
                        <div class="form-group form-group-lg">
                            <label class="lab">ReEnter-Password</label>
                            <div class="col-sm-10 col-md-12">
                                <input type="password" name="retpassword" class="form-control" autocomplete="new-password"  placeholder="repeat the same Password">
                            </div>
                        </div>
                    </div>
                    <!-- End Password Field -->
                    <!-- Start Email Field -->
                    <div calss="row">
                        <div class="form-group form-group-lg">
                            <label class="lab">Email</label>
                            <div class="col-sm-10 col-md-12">
                                <input type="text" name="email" class="form-control"  required="required" placeholder="Email Must Be Valid" value="<?php echo $user['Email'] ?>">
                            </div>
                        </div>
                    </div>
                    <!-- End Email Field -->
                    <!-- Start user-img Field -->
                    <div class="row">
                        <div class="form-group form-group-lg">
                            <label class="lab">User-image</label>
                            <div class="col-sm-10 col-md-12">
                                <input type="file" name="Images" class="form-control"  >
                            </div>
                        </div>
                    </div>
                    <!-- End user-img Field -->
                    <!-- Start Submit Field -->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-10">
                            <input type="submit"  value="Save Change" class="btn btn-primary">
                        </div>
                    </div>
                    <!-- End Submit Field -->
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="container">
    <h3 class="text-center">My Message</h3>
    <?php 
        $messages = getAllFrom("*","private_message","WHERE User_ID= {$sessionuid}",'', 'M_ID');
    ?>
    <div class='message'>
    <?php
        foreach($messages as $message){ ?>
            <table class='main-table text-center table table-bordered'>
                <tr>
                    <td>Subject</td>
                    <td>Message</td>
                    <td>Date</td>
                    <td>Delete</td>
                <tr>
                <tr>
                    <td><?php echo $message['Subject'] ?></td>
                    <td><?php echo $message['Message'] ?></td>
                    <td><?php echo $message['Date'] ?></td>
                    <td><a href='profile.php?action=Delete&M_ID=<?php echo $message['M_ID'] ?> ' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a></td>
                </tr>
            </table>
        <?php }
    
    ?>
    </div> 
</div>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

		// Upload Variablse
        $imageName = $_FILES['Images']['name'];
        $imageSize = $_FILES['Images']['size'];
        $imageTmp =  $_FILES['Images']['tmp_name'];
        $imageType = $_FILES['Images']['type'];

        // List Of Allowed File Typed To Upload

        $imageAllowedExtension = array("jpeg","jpg", "png", "gif");

        // Get image Extension

        $imageExtension = strtolower(end(explode('.' , $imageName))); 	


		//Get Variables From The Form

		$id 	 = $_POST['userid'];
		$name 	 = $_POST['username'];
		$fName   = $_POST['full'];
		$email 	 = $_POST['email'];
		$pass1	 = $_POST['password'];
		$pass2	 = $_POST['retpassword'];
		
		$pass = '';

		if(empty($_POST['password'])){

			$pass = $_POST['oldpassword'];
		}else{

			$pass = sha1($_POST['password']);
		}

		// Validate The Form
		$formErrors = array();

		if(strlen($name) < 4){

			$formErrors[] = 'Username Can\'t Be Less Than<strong> 4 Characters </strong>';
		}

		if(strlen($name) > 20){

			$formErrors[] = 'Username Can\'t Be More Than <strong>20 Characters</strong>';
		}

		if(empty($name)){

			$formErrors[] = 'Username Can\'t Be <strong>Empty</strong>';
		}

		if (empty($fName)) {
			$formErrors[] = 'Full Name Can\'t Be <strong>Empty</strong>';
		}

		if (empty($email)) {

			$formErrors[] = 'Email Can\'t Be <strong>Empty</strong>';
		}

		if($pass1 != $pass2){
			$formErrors[] = 'Is Not The Same Password';
        }
        
		if (! empty($imageName) && ! in_array($imageExtension, $imageAllowedExtension)){

			$formErrors[] = 'This Extension Is Not <strong>Allowed</strong>';
		}

		if ($imageSize > 4194304){

			$formErrors[] = 'Image Can\'t Be Larger Than<strong> 4MB</strong>';
		}

		//	Loop Into Errors Array And Echo It

		foreach ($formErrors as $error) {

			echo '<div class="alert alert-danger">' . $error . '</div>';
		}
        // Check If There's No Error Proceed The Update Operation
        
		if(empty($formErrors))
        {
            if(! empty($imageName)){

            $image = rand(0, 1000000000) . '_' . $imageName ;
            move_uploaded_file($imageTmp , "admin\uploads\image\UserImage\\" .$image);	

            } else{
                $image = '' ;	
            }
    
            $stmt = $con->prepare("SELECT * FROM users WHERE UserName = ? AND UserID != ?");

            $stmt->execute(array($name, $id ));

            $count = $stmt->rowCount();

            if ($count == 1) {

                $theMsg = "<div class='alert alert-danger'>Sorry This User Is  Exist</div>";
                redirectHome($theMsg , 'back','2');		

            } else {

            //Update The Database With This Info

            $stmt = $con->prepare("UPDATE  users SET UserName = ?, FullName = ?, Password = ?, Email = ?, Images = ? WHERE UserID = ?");
            $stmt->execute(array($name, $fName, $pass , $email, $image, $id));
            //Echo Success Message

            $theMsg =  "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Updated' . "</div>";
            redirectHome($theMsg, 'back' ,'2');
            }
        }
        
    }
    if($action == 'Delete'){
            
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
    }
?>
<?php } ?>
<?php include $tpl.'footer.php'; 
 ob_end_flush();
?>
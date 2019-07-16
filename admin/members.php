<?php 
	/*
	==================================================
	==	Members Page
	==================================================
	*/
ob_start(); // Output Buffering Start
session_start();
$pageTitle = "Members";

if(isset($_SESSION['Username']))
{
	include "init.php";
	$action = isset($_GET['action']) ? $_GET['action']  : 'Manage' ;

if($action == 'Manage'){
	// Start manage page 
	//Pending member
	$query = '';  // Get The Pending Members

	if (isset($_GET['page']) && $_GET['page'] == 'Pending') {

		$query = 'AND RegStatus = 0';
	}
	// get all users except Admin
		
	$members = getAllFrom("*", "users", 'WHERE GroupID != 1',"{$query}", "UserID");
	if(! empty($members)){
	?>
		<h1 class="text-center">Manage Members</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-bordered">
					<tr>
						<td>User Image</td>
						<td>ID</td>
						<td>Username</td>
						<td>Email</td>
						<td>Full Name</td>
						<td>RegStatus</td>
						<td>Date</td>
						<td>Control</td>
					<tr>
					<?php
					foreach($members as $member){
						echo "<tr>";
							echo "<td>";
								if(empty($member['Images'])){

									echo "<img src='layout/images/UserImage/Avatar.png' alt='User-img'>";
								}else{
									echo "<img src='uploads/image/UserImage/" . $member['Images'] . "' alt='image'>";
								}
							echo "</td>";
							echo "<td>".$member['UserID']."</td>";
							echo "<td>".$member['UserName']."</td>";
							echo "<td>".$member['Email']."</td>";
							echo "<td>".$member['FullName']."</td>";
							echo "<td>".$member['RegStatus']."</td>";
							echo "<td>".$member['Date']."</td>";
							echo "<td>
								<a href='members.php?action=Edit&userid=". $member['UserID']."'' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
								<a href='members.php?action=Delete&userid=". $member['UserID']."'' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>";
								if ($member['RegStatus'] == 0) {

									echo "<a href='members.php?action=Activate&userid=". $member['UserID']."'' class='btn btn-info activate'><i class='fa fa-check'></i> Activate</a>";
									
								}
							echo "</td>";
						echo "</tr>";
					}
					?>
				</table>
			</div>
			<a href='members.php?action=Add' class='btn btn-primary'><i calss='fa fa-plus'></i> Add New Member </a>
		</div>
	<?php
		}else{
			echo "<div class='container'>";
            echo "<div class='empty'>There's No Items To Show </div>";
            echo "<a href='members.php?action=Add' class='btn btn-primary'><i calss='fa fa-plus'></i> Add New Member </a>";
            echo "</div>";
		}

}elseif($action == 'Add'){ // Add member page ?>

	<h1 class="text-center">Add New Member</h1>
	<div class="container">
	<form class="form-horizontal" action="?action=Insert" method="POST" enctype= "multipart/form-data">
		<!-- Start Username Field -->
			<div class="form-group form-group-lg">
				<div calss="row">
					<label class="col-sm-2 ">Name</label>
                    <div class="col-sm-10 col-md-6">
						<input type="text" name="username" class="form-control" autocomplete="off" required="required" placeholder="Username To Login Into Pharmacy">
					</div>
				</div>
			</div>
		<!-- End Username Field -->
		<!-- Start Fullname Field -->
		<div calss="row">
			<div class="form-group form-group-lg">
				<label class="col-sm-2 ">Fullname</label>
				<div class="col-sm-10 col-md-6">
					<input type="text" name="full" class="form-control" autocomplete="off" required="required" placeholder="Full name To Login Into Pharmacy">
				</div>
			</div>
		</div>
		<!-- End Fullname Field -->
		<!-- Start Password Field -->
		<div calss="row">
			<div class="form-group form-group-lg">
				<label class="col-sm-2 ">Password</label>
				<div class="col-sm-10 col-md-6">
					<input type="password" name="password" class="form-control" autocomplete="new-password" required="required" placeholder="Password Must Be Hard & Complex">
				</div>
			</div>
		</div>
		<!-- End Password Field -->
		<!-- Start Password Field -->
		<div calss="row">
			<div class="form-group form-group-lg">
				<label class="col-sm-2 ">Repeat-Password</label>
				<div class="col-sm-10 col-md-6">
					<input type="password" name="retpassword" class="form-control" autocomplete="new-password" required="required" placeholder="repeat the same Password">
				</div>
			</div>
		</div>
		<!-- End Password Field -->
		<!-- Start Email Field -->
		<div calss="row">
			<div class="form-group form-group-lg">
				<label class="col-sm-2 ">Email</label>
				<div class="col-sm-10 col-md-6">
					<input type="text" name="email" class="form-control"  required="required" placeholder="Email Must Be Valid">
				</div>
			</div>
		</div>
		<!-- End Email Field -->
      <!-- Start user-img Field -->
	  <div class="row">
            <div class="form-group form-group-lg">
                <label class="col-sm-2">User-image</label>
                <div class="col-sm-10 col-md-6">
                    <input type="file" name="Images" class="form-control"  >
                </div>
            </div>
        </div>
        <!-- End user-img Field -->
		<!-- Start Submit Field -->
		<div class="form-group form-group-lg">
            <div class="col-sm-10">
                <input type="submit"  value="Add User" class="btn btn-primary">
            </div>
        </div>
        <!-- End Submit Field -->
		</form>
	</div>
	<?php
}elseif($action == 'Insert'){

//Insert Members Page

if ($_SERVER['REQUEST_METHOD'] == 'POST')

	{
		// Upload Variablse
		$imageName = $_FILES['Images']['name'];
		$imageSize = $_FILES['Images']['size'];
		$imageTmp = $_FILES['Images']['tmp_name'];
		$imageType = $_FILES['Images']['type'];

		// List Of Allowed File Typed To Upload

		$imageAllowedExtension = array("jpeg","jpg", "png", "gif");

		// Get image Extension

		$imageExtension = strtolower(end(explode('.' , $imageName))); 	

		//Get Variables From The Form

		$name 	 = $_POST['username'];
		$fName   = $_POST['full'];
		$pass 	 = $_POST['password'];
		$retPass = $_POST['retpassword'];
		$email 	 = $_POST['email'];
		
		$hashPass = sha1($_POST['password']);

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
		if (empty($pass)) {

			$formErrors[] = 'Password Can\'t Be <strong>Empty</strong>';
		}
		if($pass != $retPass){
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

		if(empty($formErrors)){

			if(! empty($imageName)){

				$image = rand(0, 1000000000) . '_' . $imageName ;
				move_uploaded_file($imageTmp , "uploads\Image\UserImage\\" .$image);	
			} else{
				$image = '' ;	
			}
		

		// Check If User Exist In Database

		$check =  checkItem("UserName", "users", $name);

			if ($check == 1) 
		{
			$theMsg = "<div class='alert alert-danger'>Sorry This User Is  Exist</div>";

			redirectHome($theMsg , 'back');		

		}else{

			//Insert User Info In Database 

			$stmt = $con->prepare("INSERT INTO 
									users(UserName, FullName, Password, Email, RegStatus, Date, Images) 
									VALUES(:xuser, :xfName, :xpass, :xemail, 1, now(), :ximage)");
			$stmt->execute(array(
				'xuser'	 	=>	$name,
				'xfName'	=>	$fName,
				'xpass'	 	=>	$hashPass,
				'xemail'	=>	$email,
				'ximage' 	=>	$image

			));		

			//Echo Success Message

			$theMsg = "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Inserted' . "</div>";

			redirectHome($theMsg , 'back');
		}

		}

	} else{

		$theMsg = "<div class='alert alert-danger'>Sorry You Cant Borwse This Page Directly</div>";

		redirectHome($theMsg);
	}

}elseif($action == 'Delete'){ /////////////////// Delete User //////////////////////

        // Check If Get Request catid  Is numeric & Get The Integer Value Of It
        
		$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

		// Select All User Depend On This ID

		$check = checkItem('UserID', "users", $userid) ;

		// If There's Such ID Show The Form

		if($check > 0)
		{
			$stmt = $con->prepare("DELETE FROM users WHERE UserID = :xuser");
			$stmt ->bindParam(":xuser", $userid);
            $stmt->execute();
            
			$theMsg = "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Deleted' . "</div>";
			redirectHome($theMsg, 'back');
        }
}elseif($action == "Edit"){ 

 // Check If Get Request catid  Is numeric & Get The Integer Value Of It

$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

// Select All Data Depend On Thid ID

$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?");

$stmt->execute(array($userid));

$user = $stmt->fetch();

$count = $stmt->rowCount();

if($count > 0){ ?>

<h1 class="text-center">Edit Member</h1>
	<div class="container">
	<form class="form-horizontal" action="?action=Update" method="POST" enctype= "multipart/form-data">
	<input type="hidden" name="userid" value="<?php echo $userid ?>">
		<!-- Start Username Field -->
			<div class="form-group form-group-lg">
				<div calss="row">
					<label class="col-sm-2 ">Name</label>
                    <div class="col-sm-10 col-md-6">
						<input type="text" name="username" class="form-control" autocomplete="off" required="required" placeholder="Username To Login Into Pharmacy" value="<?php echo $user['UserName'] ?>">
					</div>
				</div>
			</div>
		<!-- End Username Field -->
		<!-- Start Fullname Field -->
		<div calss="row">
			<div class="form-group form-group-lg">
				<label class="col-sm-2 ">Fullname</label>
				<div class="col-sm-10 col-md-6">
					<input type="text" name="full" class="form-control" autocomplete="off" required="required" placeholder="Full name To Login Into Pharmacy"  value="<?php echo $user['FullName'] ?>">
				</div>
			</div>
		</div>
		<!-- End Fullname Field -->
		<!-- Start Password Field -->
		<div calss="row">
			<div class="form-group form-group-lg">
				<label class="col-sm-2 ">New Password</label>
				<div class="col-sm-10 col-md-6">
					<input type="hidden" name="oldpassword" value="<?php echo $user['Password']?>" >
					<input type="password" name="password" class="form-control" autocomplete="new-password"  placeholder="Password Must Be Hard & Complex">
				</div>
			</div>
		</div>
		<!-- End Password Field -->
		<!-- Start Password Field -->
		<div calss="row">
			<div class="form-group form-group-lg">
				<label class="col-sm-2 ">Repeat-Password</label>
				<div class="col-sm-10 col-md-6">
					<input type="password" name="retpassword" class="form-control" autocomplete="new-password"  placeholder="repeat the same Password">
				</div>
			</div>
		</div>
		<!-- End Password Field -->
		<!-- Start RegStatus Field -->
		<div class='row'>
			<div class="form-group form-group-lg">
				<label class="col-sm-2">Activate[0/1]</label>
				<div class="col-sm-10 col-md-6">
					<input type="text" name="regstatus" class="form-control" placeholder=" 0->No 1->Yes " value="<?php echo $user['RegStatus'] ?>">
				</div>
			</div>
		</div>
		<!-- End RegStatus Field -->
		<!-- Start Email Field -->
		<div calss="row">
			<div class="form-group form-group-lg">
				<label class="col-sm-2 ">Email</label>
				<div class="col-sm-10 col-md-6">
					<input type="text" name="email" class="form-control"  required="required" placeholder="Email Must Be Valid" value="<?php echo $user['Email'] ?>">
				</div>
			</div>
		</div>
		<!-- End Email Field -->
      <!-- Start user-img Field -->
	  <div class="row">
            <div class="form-group form-group-lg">
                <label class="col-sm-2">User-image</label>
                <div class="col-sm-10 col-md-6">
                    <input type="file" name="Images" class="form-control"  >
                </div>
            </div>
        </div>
        <!-- End user-img Field -->
		<!-- Start Submit Field -->
		<div class="form-group form-group-lg">
            <div class="col-sm-10">
                <input type="submit"  value="Add User" class="btn btn-primary">
            </div>
        </div>
        <!-- End Submit Field -->
		</form>
	</div>
<?php }else{
	// If There's No Such ID Show Error Message
        
	$theMsg = "<div class='alert alert-danger'>Theres No Such ID</div>";

	redirectHome($theMsg);
}
}elseif($action == 'Update'){
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
		$active  = $_POST['regstatus'];
		
		$pass 	= '';
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
		if($active > 1 || $active < 0){
			$formErrors[] = 'You Cane Write Only 0->No 1->yes';
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
            move_uploaded_file($imageTmp , "uploads\Image\UserImage\\" .$image);	

            } else{
                $image = '' ;	
            }
    
    
            $stmt = $con->prepare("SELECT * FROM users WHERE UserName = ? AND UserID != ?");

            $stmt->execute(array($name, $id ));

            $count = $stmt->rowCount();

            if ($count == 1) {

                $theMsg = "<div class='alert alert-danger'>Sorry This User Is  Exist</div>";
                redirectHome($theMsg , 'back');		

            } else {

            //Update The Database With This Info

            $stmt = $con->prepare(" UPDATE  users SET UserName = ?, FullName = ?, Password = ?, Email = ?, RegStatus = ?, Images = ? WHERE UserID = ?");
            $stmt->execute(array($name, $fName, $pass , $email, $active , $image, $id));
            //Echo Success Message

            $theMsg =  "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Updated' . "</div>";
            redirectHome($theMsg, 'back');
            }
        }
	}else{

        $theMsg = "<div class='alert alert-danger'>Sorry You Cant Borwse This Page Directly</div>";
        redirectHome($theMsg);
    }
}elseif($action == 'Activate'){
	echo "<div class='container'> ";

		// Check If Get Request userid  Is numeric & Get The Integer Value Of It

		$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
		// Select All Data Depend On This ID

		$check = checkItem('UserID', 'users', $userid);

		// If There's Such ID Show The Form

		if ($check > 0) {

			$stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");

			$stmt->execute(array($userid));
			
			$theMsg = "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Activated' . "</div>";

			redirectHome($theMsg);

		} else{

			$theMsg = "<div class='alert alert-danger'>This ID Is Not Exist</div>";

			redirectHome($theMsg);
		}
	echo "</div>";


}

    include $tpl.'footer.php';
} else {
    header('Location:index.php');   // Redirect To Index Page
    exit();
}
 ob_end_flush();
?>
<?php 
	/*
	==================================================
	==	Category Page
	==================================================
	*/
ob_start(); // Output Buffering Start
session_start();
$pageTitle = "Categories";

if(isset($_SESSION['Username']))
{
	include 'init.php';
	
	$action= isset($_GET['action']) ? $_GET['action'] : 'Manage' ;
	//  Start Manage Category
	
	if($action == 'Manage')
	{
		$sort = 'asc';

		$sort_Array= array("desc","asc");

		if (isset($_GET["sort"]) && in_array($_GET['sort'], $sort_Array))
		{
			$sort=$_GET['sort'];
		}

		$cats=getAllFrom("*","categories","","","Ordering","{$sort}");
		
		if(!empty($cats)){ 
		?>
			<div class="container-fluid">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						<i class="fa fa-edit"></i> Manage Categories 
						<div class="option pull-right">
							<i class="fa fa-sort"></i> Ordering:[
							<a class="<?php if($sort == 'asc'){echo 'choose' ;} ?>" href="?sort=asc">ASC</a> |
							<a class="<?php if($sort == 'desc'){echo 'choose' ;} ?>" href="?sort=desc">DESC</a>]
						</div>					
					</div>
					<div class="panel panel-body">
						<?php
						foreach($cats as $cat){
							echo '<div class="col-sm-12 col-md-6 col-lg-4"/>';
								echo '<div class="thumbnail cat-box">';
								if($cat['Sales'] == 1){echo "<span class='sales'></i>Sales</span>";}
								echo '<span class ="catName">'.$cat['Name'].'</span>';
								echo '<textarea class="form-control desc" rows="5" >';
									if($cat['Description'] == ''){
										echo "No Description";
									}else{
										echo $cat['Description'];
									}
								echo '</textarea>';
								if ($cat['Visibility'] == 1)
								{
									echo "<span class='visibility'><i class='fa fa-eye-slash'></i>Hidden</span>";
								}else{
									echo "<span class='visibility'><i class='fa fa-eye'></i>Visible</span>";
								}
								echo '<div class="form-group">';
									echo "<a href='categories.php?action=Edit&catid=".$cat['ID']."' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit</a>";
									echo "<a href='categories.php?action=Delet&catid=".$cat['ID']."' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i> Delete</a>";
								echo '</div>';
								echo '</div>';
							echo '</div>';
						}
						?>
					</div>
					<a href='categories.php?action=Add' class='btn btn-primary add-cat'><i class='fa fa-plus'></i> Add New Category</a>
				</div>
			</div>
		<?php
		}else{
			echo "<div class='container'>";
			echo "<div class='empty'>There's No Category To Show</div>";
			echo "</div>";
			echo "<a href='categories.php?action=Add' class='btn btn-primary'><i class='fa fa-plus'></i> Add Category</a>";
		}?>
	<?php
	}elseif($action == 'Add') {?>
		<h1 class='text-center title'>Add New Category</h1>
		<div class='container'>
			<form calss='form-horizontal' action='?action=Add' method='POST'>
				<!-- Start Name Field -->
				<div class='row'>
					<div class="form-group form-group-lg">
						<label class="col-sm-2 ">Name</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="name" class="form-control" autocomplete="off" required="required" placeholder="Name Of The Category">
						</div>
					</div>
				</div>
				<!-- End Name Field -->
				<!-- Start Description Field -->
				<div class='row'>
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="description" class="form-control" autocomplete="off"   placeholder="Describe The Category">
						</div>
					</div>
				</div>
				<!-- End Description Field -->
				<!-- Start Ordering Field -->
				<div class='row'>
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Ordering</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="ordering" class="form-control" placeholder="Number To Arrange The Categories">
						</div>
					</div>
				</div>
				<!-- End Ordering Field -->
				<!-- Start Visibility Field -->
				<div class="row">
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Visible</label>
						<div class="col-sm-10 col-md-6">
							<div>
								<input id="vis-yes" type="radio" name="visibility" value="0" checked />
								<label for="vis-yes">Yes</label>
							</div>
							<div>
								<input id="vis-no" type="radio" name="visibility" value="1" />
								<label for="vis-no">No</label>
							</div>
						</div>
					</div>
				</div>
				<!-- End Visibility Field -->
				<!-- Start Sales Field -->
				<div class="row">
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Sales</label>
						<div class="col-sm-10 col-md-6">
							<div>
								<input id="vis-yes" type="radio" name="sales" value="1" checked />
								<label for="vis-yes">Yes</label>
							</div>
							<div>
								<input id="vis-no" type="radio" name="sales" value="0" />
								<label for="vis-no">No</label>
							</div>
						</div>
					</div>
				</div>
				<!-- End Sales Field -->
				<!-- Start Submit Field -->
				<div class="form-group form-group-lg">
					<div class="col-sm-10">
						<input type="submit" value="Add Category" class="btn btn-primary btn-lg">
					</div>
				</div>
				<!-- End Submit Field -->
			</form>
		</div>

		<!-- Start The Insert Data -->
		<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			//Get Variables From The Form
			$name 		=	$_POST['name'];
			$desc		=	$_POST['description'];
			$order 		= 	$_POST['ordering'];
			$visible	= 	$_POST['visibility'];
			$sales		=	$_POST['sales'];

			// Check If Category Exist In Database

			$check = checkItem("Name", "categories" ,$name);
			if($check == 1){
				
				$theMsg = "<div class='alert alert-danger'>Sorry This Category Is  Exist</div>";	
				redirectHome($theMsg,'back');
			}else{
				//Insert Category Info In Database 
				
				$stmt = $con->prepare("INSERT INTO
										categories(Name, Description, Ordering, Visibility, Sales)
										VALUE(:xname, :xdesc, :xorder, :xvisible, :xsales)");
				$stmt->execute(array(
					'xname'		=>  $name ,
					'xdesc' 	=>  $desc ,
					'xorder' 	=>  $order,
					'xvisible' 	=>  $visible,
					'xsales'	=>  $sales
				));

				//Echo Success Message

				$theMsg = "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Inserted' . "</div>";

				redirectHome($theMsg,'back');
			}
		}
		?>
		<!-- End The Insert Data -->

	<?php }elseif($action == 'Delet'){ /////////////////// Delete Category //////////////////////

		// Check If Get Request catid  Is numeric & Get The Integer Value Of It
		$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

		// Select All Data Depend On This ID

		$check = checkItem('ID', "categories", $catid) ;

		// If There's Such ID Show The Form

		if($check > 0)
		{
			$stmt = $con->prepare("DELETE FROM categories WHERE ID = :xid");
			$stmt ->bindParam(":xid", $catid);
			$stmt->execute();

			$theMsg = "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Deleted' . "</div>";
			redirectHome($theMsg, 'back');
		}	
	}elseif($action == 'Edit'){ //////// Edit Category Page ////////

		// Check If Get Request catid  Is numeric & Get The Integer Value Of It
		$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

		// Select All Data Depend On Thid ID

		$stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
		$stmt->execute(array($catid));
		$cat = $stmt->fetch();
		$count = $stmt->rowCount();

		if($count > 0){ ?>
			<h1 class='text-center title'>Edit Category</h1>
				<div class='container'>
					<form calss='form-horizontal' action='?action=Update' method='POST'>
						<input type="hidden" name="catid" value="<?php echo $catid ?>">
						<!-- Start Name Field -->
						<div class='row'>
							<div class="form-group form-group-lg">
								<label class="col-sm-2 ">Name</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="name" class="form-control" autocomplete="off" required="required" placeholder="Name Of The Category" value="<?php echo $cat['Name'] ?>">
								</div>
							</div>
						</div>
						<!-- End Name Field -->
						<!-- Start Description Field -->
						<div class='row'>
							<div class="form-group form-group-lg">
								<label class="col-sm-2 control-label">Description</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="description" class="form-control" placeholder="Describe The Category" value="<?php echo $cat['Description'] ?>">
								</div>
							</div>
						</div>
						<!-- End Description Field -->
						<!-- Start Ordering Field -->
						<div class='row'>
							<div class="form-group form-group-lg">
								<label class="col-sm-2 control-label">Ordering</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="ordering" class="form-control" placeholder="Number To Arrange The Categories" value="<?php echo $cat['Ordering'] ?>">
								</div>
							</div>
						</div>
						<!-- End Ordering Field -->
						<!-- Start Visibility Field -->
						<div class="row">
							<div class="form-group form-group-lg">
								<label class="col-sm-2 control-label">Visible</label>
								<div class="col-sm-10 col-md-6">
									<div>
										<input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['Visibility'] == 0){echo 'checked' ;} ?> />
										<label for="vis-yes">Yes</label>
									</div>
									<div>
										<input id="vis-no" type="radio" name="visibility" value="1" <?php if($cat['Visibility'] == 1){echo 'checked' ;} ?> />
										<label for="vis-no">No</label>
									</div>
								</div>
							</div>
						</div>
						<!-- End Visibility Field -->
						<!-- Start Sales Field -->
						<div class="row">
							<div class="form-group form-group-lg">
								<label class="col-sm-2 control-label">Sales</label>
								<div class="col-sm-10 col-md-6">
									<div>
										<input id="vis-yes" type="radio" name="sales" value="1" <?php if($cat['Sales'] == 1){echo 'checked' ;} ?> />
										<label for="vis-yes">Yes</label>
									</div>
									<div>
										<input id="vis-no" type="radio" name="sales" value="0" <?php if($cat['Sales'] == 0){echo 'checked' ;} ?> />
										<label for="vis-no">No</label>
									</div>
								</div>
							</div>
						</div>
						<!-- End Sales Field -->
						<!-- Start Submit Field -->
						<div class="form-group form-group-lg">
							<div class="col-sm-10">
								<input type="submit" value="Update Category" class="btn btn-primary">
							</div>
						</div>
						<!-- End Submit Field -->
					</form>
				</div>
		<?php
		}else{

			$theMsg = "<div class='alert alert-danger'>Theres No Such ID</div>";
			redirectHome($theMsg,"back");
		}
	}elseif($action == 'Update'){

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			//Get Variables From The Form
			$id 		=	$_POST['catid'];
			$name 		=	$_POST['name'];
			$desc		=	$_POST['description'];
			$order 		= 	$_POST['ordering'];
			$visible	= 	$_POST['visibility'];
			$sales		=	$_POST['sales'];

			$stmt = $con->prepare("SELECT * FROM categories WHERE Name = ? AND ID != ?");
			$stmt->execute(array($name, $id));
			$count = $stmt->rowCount();

			if ($count == 1) {

				$theMsg = "<div class='alert alert-danger'>Sorry This Category Is  Exist</div>";
				redirectHome($theMsg , 'back');		

			} else {

				//Update The Database With This Info

				$stmt = $con->prepare(" UPDATE 
										categories 
										SET
											Name= ?, Description = ?, Ordering = ?, Visibility = ?, Sales = ?
										WHERE ID = ?");
				$stmt->execute(array($name, $desc, $order, $visible, $sales, $id )) ;

				//Echo Success Message

				$theMsg =  "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Updated' . "</div>";
				redirectHome($theMsg, 'back');

			}
		}else{

			$theMsg = "<div class='alert alert-danger'>Sorry You Cant Borwse This Page Directly</div>";
			redirectHome($theMsg);
		}
	}
	?>
<?php
    include $tpl.'footer.php';
} else {
    header('Location:index.php');   // Redirect To Index Page
    exit();
}
 ob_end_flush();
?>
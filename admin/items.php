<?php 
	/*
	==================================================
	==	Items Page
	==================================================
	*/
ob_start(); // Output Buffering Start
session_start();

$pageTitle = "Items";

if(isset($_SESSION['Username'])){

    include 'init.php';
    $action = isset($_GET['action']) ? $_GET['action']  : 'Manage' ;

    //Start Manage Items

    if($action == 'Manage'){

        $stmt = $con->prepare("SELECT items.*, 
                                    categories.Name AS Category_Name
                                From 
                                    items
                                INNER JOIN 
                                    categories
                                ON
                                    categories.ID = items.Cat_ID");
        // Execute The Statement

        $stmt->execute();

        // Assign To Variable
        $items = $stmt->fetchAll();

        if(! empty($items)){
        ?>
            <h1 class='text-center'>Manage Items</h1>
            <div class='container'>
                <div class='table-responsive'>
                    <table class='main-table text-center table table-bordered'>
                        <tr>
                            <td>Images</td>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Price</td>
                            <td>Producing_Date</td>
                            <td>Expiration_Date</td>
                            <td>Sales</td>
                            <td>Category</td>
                            <td>Control</td>
                        </tr>
                        <?php

                          foreach($items as $item){
                            echo "<tr>";
                                echo "<td>";
                                    if(empty($item['Images']) && $item['Images'] == '' ){

                                        echo "<img src='layout/images/drug.png' alt='drug-img'>";
                                    }else{
                                        echo "<img src='uploads/image/" . $item['Images'] . "' alt='image'>";
                                    }
                                echo "</td>";
                                echo "<td>".$item['ID']."</td>";
                                echo "<td>".$item['Name']."</td>";
                                echo "<td><textarea class='desc'>".$item['Description']."</textarea></td>";
                                echo "<td>".$item['Price']."</td>";
                                echo "<td>".$item['Producing_Date']."</td>";
                                echo "<td>".$item['Expiration_Date']."</td>";
                                echo "<td>".$item['Sales']."</td>";
                                echo "<td>".$item['Category_Name']."</td>";
                                echo "<td>";
                                    echo "<a href='items.php?action=Edit&itemid=". $item['ID']."'' class='btn btn-info'><i class='fa fa-edit'></i> Edit</a>
									      <a href='items.php?action=Delete&itemid=". $item['ID']."'' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>";
                                echo "</td>";
                            echo "</tr>";
                          }      
                        ?>
                    </table>
                </div>
                <a href='items.php?action=Add' class='btn btn-primary'><i calss='fa fa-plus'></i> Add New Items </a>
            </div>
        <?php }else{
            echo "<div class='container'>";
            echo "<div class='empty'>There's No Items To Show </div>";
            echo "<a href='items.php?action=Add' class='btn btn-primary'><i calss='fa fa-plus'></i> Add New Items </a>";
            echo "</div>";
        }?>

        <!-- Start Add Items -->

   <?php }elseif($action == 'Add'){ ?>
    <h1 class='text-center'>Add New Items</h1>
    <div calss='container'>
        <form calss='form-horizontal' action='?action=Insert' method='POST' enctype= "multipart/form-data">
            <!-- Start Name Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 ">Name</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="name" class="form-control" autocomplete="off" required placeholder="Name Of The Item">
                    </div>
                </div>
            </div>
            <!-- End Name Field -->
            <!-- Start Description Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="description" class="form-control" placeholder="Describe The Item" required autocomplete="off">
                    </div>
                </div>
            </div>
            <!-- End Description Field -->
            <!-- Start Price Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="price" class="form-control" placeholder="Price The Item" required>
                    </div>
                </div>
            </div>
            <!-- End Price Field -->
         <!-- Start Producing_Date Field -->
         <div class='row'>
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Producing_Date</label>
                <div class="col-sm-10 col-md-6">
                    <input type="date" name="proDate" class="form-control" placeholder="Enter the Producing Date" required>
                </div>
            </div>
        </div>
        <!-- End Producing_Date Field -->
         <!-- Start Expiration_Date Field -->
         <div class='row'>
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Expiration_Date</label>
                <div class="col-sm-10 col-md-6">
                    <input type="date" name="exDate" class="form-control" placeholder="Enter the Expiration_Date" required>
                </div>
            </div>
        </div>
        <!-- End Expiration_Date Field -->
        <!-- Start item-img Field -->
        <div class='row'>
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">item-image</label>
                <div class="col-sm-10 col-md-6">
                    <input type="file" name="Images" class="form-control" requireed >
                </div>
            </div>
        </div>
        <!-- End item-img Field -->
         <!-- Start Sales Field -->
         <div class='row'>
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Sales</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text" name="sales" class="form-control" placeholder="Enter the Sales ">
                </div>
            </div>
        </div>
        <!-- End Sales Field -->
        <!-- Start Categories Field -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10 col-md-6">
                <select  name="category">
                    <option value="0">...</option>
                    <?php
                        $cats = getAllFrom("*", "categories","","","ID", "ASC");
                        foreach($cats as $cat){
                            echo "<option value='" . $cat['ID'] . "'>". $cat['Name'] ."</option>";   
                        }
                    ?>
                </select>
            </div>
        </div>
        <!-- End Categories Field -->
        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class="col-sm-10">
                <input type="submit"  value="Add Item" class="btn btn-primary btn-lg">
            </div>
        </div>
        <!-- End Submit Field -->
        </form>       

        <!-- Start The Insert Data -->
   </div>

  <?php } elseif($action =='Insert'){

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
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
        $name       = $_POST['name'];
        $desc       = $_POST['description'];
        $price      = $_POST['price'];
        $proDate    = $_POST['proDate'];
        $exDate     = $_POST['exDate'];
        $sales      = $_POST['sales'];
        $category   = $_POST['category'];

        // Validate The Form

        $formErrors = array();

        if(empty($name)){

            $formErrors[] = 'Name Can\'t Be <strong>Empty</strong>';
        }

        if(empty($desc)){

            $formErrors[] = 'Description Can\'t Be <strong>Empty</strong>';
        }
        if(empty($price)){

            $formErrors[] = 'Price Can\'t Be <strong>Empty</strong>';
        }

        if(empty($proDate)){

            $formErrors[] = 'Producing_Date Can\'t Be <strong>Empty</strong>';
        }

        if(empty($exDate)){

            $formErrors[] = 'Expiration_Date Can\'t Be <strong>Empty</strong>';
        }
        if (! empty($imageName) && ! in_array($imageExtension, $imageAllowedExtension)){

            $formErrors[] = 'This Extension Is Not <strong>Allowed</strong>';
        }

        if (empty($imageName)){

            $formErrors[] = 'item Image Is <strong>Required</strong>';
        }

        if ($imageSize > 4194304){

            $formErrors[] = 'Image Can\'t Be Larger Than<strong> 4MB</strong>';
        }
        
        if ($category == 0) {

            $formErrors[] = 'You Must Choose The <strong>Category</strong>';
        }

        //	Loop Into Errors Array And Echo It

        foreach ($formErrors as $error) {

            echo '<div class="alert alert-danger">' . $error . '</div>';
            
        }

        // Check If There's No Error Proceed The Update Operation

        if(empty($formErrors)){

            $image = rand(0, 1000000000) . '_' . $imageName ;
            move_uploaded_file($imageTmp , "uploads\Image\\" .$image);	

            //Insert Items Info In Database 

            $stmt = $con->prepare("INSERT INTO 
                                items(Name, Description, Price, Producing_Date, Expiration_Date,Images, Sales, Cat_ID) 
                                VALUES(:xname, :xdesc, :xprice, :xproDate, :xexDate,:ximage, :xsales, :xcatID)");
            $stmt->execute(array(
                'xname'		=>	$name,
                'xdesc'		=>	$desc,
                'xprice'	=>	$price,
                'xproDate'	=>	$proDate,
                'xexDate'	=>	$exDate,
                'ximage'    =>  $image,
                'xsales' 	=> $sales,
                'xcatID' 	=> $category,
            ));
            //Echo Success Message
            $theMsg = "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Inserted' . "</div>";
            redirectHome($theMsg , 'back');

        }

    }else{

        $theMsg = "<div class='alert alert-danger'>Sorry You Cant Borwse This Page Directly</div>";

        redirectHome($theMsg);
    }

  }elseif($action == 'Edit'){

    // Check If Get Request catid  Is numeric & Get The Integer Value Of It

    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    // Select All Data Depend On Thid ID

    $stmt = $con->prepare("SELECT * FROM items WHERE ID = ?");

    $stmt->execute(array($itemid));

    $item = $stmt->fetch();

    $count = $stmt->rowCount();

    if($count > 0){ ?>

    <h1 class='text-center'>Edit Items</h1>
    <div calss='container'>
        <form calss='form-horizontal' action='?action=Update' method='POST' enctype= "multipart/form-data">
        <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
            <!-- Start Name Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 ">Name</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="name" class="form-control" autocomplete="off" required placeholder="Name Of The Item" value="<?php echo $item['Name'] ?>" >
                    </div>
                </div>
            </div>
            <!-- End Name Field -->
            <!-- Start Description Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="description" class="form-control" placeholder="Describe The Item" required autocomplete="off" value="<?php echo $item['Description'] ?>">
                    </div>
                </div>
            </div>
            <!-- End Description Field -->
            <!-- Start Price Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="price" class="form-control" placeholder="Price The Item" required value="<?php echo $item['Price'] ?>">
                    </div>
                </div>
            </div>
            <!-- End Price Field -->
            <!-- Start Producing_Date Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Producing_Date</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="date" name="proDate" class="form-control" placeholder="Enter the Producing Date" required value="<?php echo $item['Producing_Date'] ?>">
                    </div>
                </div>
            </div>
            <!-- End Producing_Date Field -->
            <!-- Start Expiration_Date Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Expiration_Date</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="date" name="exDate" class="form-control" placeholder="Enter the Expiration_Date" required value="<?php echo $item['Expiration_Date'] ?>">
                    </div>
                </div>
            </div>
            <!-- End Expiration_Date Field -->
            <!-- Start item-img Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">item-image</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="file" name="Images" class="form-control" requireed placeholder="Add item image" >
                    </div>
                </div>
            </div>
            <!-- End item-img Field -->
            <!-- Start Sales Field -->
            <div class='row'>
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Sales</label>
                    <div class="col-sm-10 col-md-6">
                        <input type="text" name="sales" class="form-control" placeholder="Enter the Sales" value="<?php echo $item['Sales'] ?>">
                    </div>
                </div>
            </div>
            <!-- End Sales Field -->
            <!-- Start Categories Field -->
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10 col-md-6">
                    <select  name="category">
                        <?php
                            $stmt2 = $con->prepare("SELECT * From categories");
                            $stmt2->execute();
                            $cats = $stmt2->fetchAll();
                            foreach($cats as $cat){
                                echo "<option value='" . $cat['ID'] . "'";
                                if($item['ID'] == $cat['ID']) { echo 'selected'; }
                                echo ">". $cat['Name'] ."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <!-- End Categories Field -->
            <!-- Start Submit Field -->
            <div class="form-group form-group-lg">
                <div class="col-sm-10">
                    <input type="submit" value="Edit Item" class="btn btn-primary btn-lg">
                </div>
            </div>
            <!-- End Submit Field -->
        </form>
    </div>
   

    <?php } else{  // If There's No Such ID Show Error Message
        
			$theMsg = "<div class='alert alert-danger'>Theres No Such ID</div>";

			redirectHome($theMsg);
    }
  }elseif($action == 'Update')
  {
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
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
        $itemid     = $_POST['itemid'];
        $name       = $_POST['name'];
        $desc       = $_POST['description'];
        $price      = $_POST['price'];
        $proDate    = $_POST['proDate'];
        $exDate     = $_POST['exDate'];
        $sales      = $_POST['sales'];
        $category   = $_POST['category'];

        // Validate The Form

        $formErrors = array();

        if(empty($name)){

            $formErrors[] = 'Name Can\'t Be <strong>Empty</strong>';
        }

        if(empty($desc)){

            $formErrors[] = 'Description Can\'t Be <strong>Empty</strong>';
        }
        if(empty($price)){

            $formErrors[] = 'Price Can\'t Be <strong>Empty</strong>';
        }

        if(empty($proDate)){

            $formErrors[] = 'Producing_Date Can\'t Be <strong>Empty</strong>';
        }

        if(empty($exDate)){

            $formErrors[] = 'Expiration_Date Can\'t Be <strong>Empty</strong>';
        }
        if (! empty($imageName) && ! in_array($imageExtension, $imageAllowedExtension)){

            $formErrors[] = 'This Extension Is Not <strong>Allowed</strong>';
        }

        if (empty($imageName)){

            $formErrors[] = 'item Image Is <strong>Required</strong>';
        }

        if ($imageSize > 4194304){

            $formErrors[] = 'Image Can\'t Be Larger Than<strong> 4MB</strong>';
        }
        
        if ($category == 0) {

            $formErrors[] = 'You Must Choose The <strong>Category</strong>';
        }

        //	Loop Into Errors Array And Echo It

        foreach ($formErrors as $error)
        {

            echo '<div class="alert alert-danger">' . $error . '</div>';

        }

        // Check If There's No Error Proceed The Update Operation

        if(empty($formErrors))
        {
            if(! empty($imageName)){

            $image = rand(0, 1000000000) . '_' . $imageName ;
            move_uploaded_file($imageTmp , "uploads\Image\\" .$image);	

            } else{
                $image = '' ;	
            }
    
            $stmt = $con->prepare("SELECT * FROM items WHERE Name = ? AND ID != ?");

            $stmt->execute(array($name, $itemid));

            $count = $stmt->rowCount();

            if ($count == 1) {

                $theMsg = "<div class='alert alert-danger'>Sorry This item Is  Exist</div>";
                redirectHome($theMsg , 'back');		

            } else {

                //Update The Database With This Info

            $stmt = $con->prepare(" UPDATE 
                                        items 
                                    SET
                                        Name = ?,
                                        Description = ?,
                                        Price = ?,
                                        Producing_Date = ?,
                                        Expiration_Date = ?,
                                        Sales = ?,
                                        Images = ?,
                                        Cat_ID = ?
                                    WHERE 
                                        ID = ?");
            $stmt->execute(array($name, $desc, $price , $proDate, $exDate , $sales , $image , $category , $itemid ));
            //Echo Success Message

            $theMsg =  "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Updated' . "</div>";
            redirectHome($theMsg, 'back');
            }
        }
    }else{

        $theMsg = "<div class='alert alert-danger'>Sorry You Cant Borwse This Page Directly</div>";
        redirectHome($theMsg);
    }

  }elseif($action == 'Delete'){ /////////////////// Delete Item //////////////////////

        // Check If Get Request catid  Is numeric & Get The Integer Value Of It
        
		$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

		// Select All Data Depend On This ID

		$check = checkItem('ID', "items", $itemid) ;

		// If There's Such ID Show The Form

		if($check > 0)
		{
			$stmt = $con->prepare("DELETE FROM items WHERE ID = :xitem");
			$stmt ->bindParam(":xitem", $itemid);
            $stmt->execute();
            

			$theMsg = "<div class='alert alert-success'>". $stmt->rowCount() . ' Record Deleted' . "</div>";
			redirectHome($theMsg, 'back');
        }	
        
  } ?>
<?php
    include $tpl.'footer.php';
} else {
    header('Location:index.php');   // Redirect To Index Page
    exit();
}
 ob_end_flush();
?>
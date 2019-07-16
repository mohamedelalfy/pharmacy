<?php 
	/*
	==================================================
	==	Home Page
	==================================================
	*/
ob_start(); // Output Buffering Start
session_start();

$pageTitle = "Home";

if(isset($_SESSION['Username'])){
    include 'init.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 show">
                <div class="data">
                    <h3 class="text-center">Number Of Category</h3> 
                    <p ><i class="fa fa-align-left"></i><?php echo "<span>".countItems('ID','categories'). "</span>" ?></p>
                </div>
                <a href="categories.php" class="btn btn-primary">Open  <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="col-md-4 col-sm-12 show">
                <div class="data">
                    <h3 class="text-center">Number Of Items</h3> 
                    <p ><i class="fa fa-tags"></i><?php echo "<span>".countItems('ID','items'). "</span>" ?></p>
                </div>
                <a href="items.php" class="btn btn-primary">Open  <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="col-md-4 col-sm-12 show">
                <div class="data">
                    <h3 class="text-center">Number Of Members</h3> 
                    <p ><i class="fa fa-users"></i><?php echo "<span>".countItems('UserID','users'). "</span>" ?></p>
                </div>
                <a href="members.php" class="btn btn-primary">Open  <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12 show">
                <div class="data">
                    <h3 class="text-center">pending</h3> 
                    <p ><i class="fa fa-users"></i><?php echo "<span>".checkItem('RegStatus','users','0'). "</span>" ?></p>
                </div>
                <a href="members.php?action=Manage&page=Pending" class="btn btn-primary">Open  <i class="fa fa-arrow-right"></i></a>
            </div>


        </div>
    </div>
    <?php
    include $tpl.'footer.php';
} 
 ob_end_flush();
?>
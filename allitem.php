<?php 
ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Homepage';
include 'init.php'; ?>

<!-- the medicine section -->
<div id="medicine">
    <div class="container">
        <h2>medication section </h2>
      <div class="row">
        <div class="medicine-items">
            <?php
            $allItems =  getAllFrom("*", "items", "", "", "ID", "DESC");
            foreach($allItems as $item ){
               echo '<div class="col-sm-6 col-md-3 col-lg-3">';
                echo '<div class="image-all-together effect">';
                    echo '<a href="details.php?itemid='.$item['ID'].'" class="btn btn-primary">Details</a>';
                    if($item['Sales'] > 0){
                      echo "<span class='sales'>Off " . $item['Sales'];
                      echo "%</span>";
                    }
                    echo '<img src="admin/uploads/image/'.$item['Images'].'" width="713px" height="490px" alt="img" />';
                    echo "<div class='information'>";
                      echo "<span class='name'>". $item['Name']."</span>";
                      echo "<span class='price'>".$item['Price']."&pound;</span>";
                    echo "</div>";
                    echo '<span class="one"></span>
                    <span class="two"></span>
                    <span class="three"></span>
                    <span class="four"></span>';
                echo '</div>';
            echo '</div>';
            }
            ?>
        </div>
      </div>
    </div>
  </div>
<!-- end the medicine section -->

<?php
include $tpl.'footer.php'; 
ob_end_flush(); 
?>
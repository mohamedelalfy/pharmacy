<?php 
session_start();
include 'init.php'; ?>
<div id="medicine">
    <div class="container">
        <h2>medication section </h2>
      <div class="row">
        <div class="medicine-items">
    <?php
    if(isset($_GET['pageid']) && is_numeric($_GET['pageid'])) {
        $category = intval($_GET['pageid']);
        $getItems = getAllFrom("*", "items", "where Cat_ID = {$category}","", "ID");
        foreach($getItems as $item){
            echo '<div class="col-sm-6 col-md-3 col-lg-3">';
                echo '<div class="image-all-together effect">';
                    echo '<a href="details.php?itemid='.$item['ID'].'" class="btn btn-primary">Details</a>';
                    if($item['Sales'] > 0){
                        echo "<span class='sales'>Off " . $item['Sales'];
                        echo "%</span>";
                      }
                    echo '<img src="admin/uploads/image/'.$item['Images'].'" alt="img" />';
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
    }else{
        echo "<div class='alert alert-danger text-center'>You Must Add Page ID</div>";
    }
    ?>
          
          <div class="clearfix"></div>

        </div>
      </div>
    </div>
  </div>
<?php include $tpl.'footer.php'; ?>
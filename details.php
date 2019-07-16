<?php 
ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Homepage';
include 'init.php';

if(isset($_SESSION['user'])){
 // Check If Get Request Items  Is numeric & Get The Integer Value Of It
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    // Select All Data Depend On This ID
    $stmt = $con->prepare("SELECT 
                                items.*,
                                categories.Name AS category_name
                            FROM
                                items 
                            INNER JOIN 
                                categories
                            ON
                                categories.ID = items.Cat_ID

                            WHERE items.ID = ? ");

        // Execute Query 
    $stmt->execute(array($itemid));
    $count = $stmt->rowCount();

    if($count > 0)
    {
    // Fetch The Data
    $item =$stmt->fetch();

?>
<h1 class="text-center itemname"><?php echo $item['Name'] ?></h1>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 dt">
            <img src="admin/uploads/image/<?php echo $item['Images'] ?>" class="img-responsive img-thumbnail img-left" alt="img"  width="100%" height="100%"/>
            <a href="shopping.php?ToCart=<?php echo $item['ID'] ?>" class="btn btn-success cart"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="information dt">
                <ul class="list-unstyled">
                    <li> 
                        <i class="fa fa-user"></i>
                        <span>Name :</span> <?php echo $item['Name'] ?>
                    </li>
                    <li> 
                        <i class="fa fa-date"></i>
                        <span>Producing_Date :</span> <?php echo $item['Producing_Date'] ?>
                    </li>
                    <li> 
                        <i class="fa fa-clock"></i>
                        <span>Expiration_Date :</span> <?php echo $item['Expiration_Date'] ?>
                    </li>
                    <li> 
                        <i class="fa fa-tags"></i>
                        <span>Category Name :</span> <?php echo $item['category_name'] ?>
                    </li>
                    <li>
                        <i class="fa fa-arow-right"></i>
                        <span>Price :</span> <?php echo $item['Price'] ?>
                    </li>
                    <?php
                    if($item['Sales'] > 0) {?>
                        <li> 
                            <span>Sales </span> :<?php echo $item['Sales'] ?> %
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="description dt">
                <h3 class="text-center">Description</h3>
                <p class="lead"> <?php echo $item['Description'] ?></p>
            </div>
        </div>
    </div>
<hr>
    <div class="same-category">
    <?php
              $stmt = $con->prepare("SELECT * FROM items ORDER BY ID DESC LIMIT 4");
              $stmt->execute();
              $getItems = $stmt->fetchAll();
            foreach($getItems as $item ){
               echo '<div class="col-sm-6 col-md-3 col-lg-3">';
                echo '<div class="image-all-together effect">';
                    echo '<a href="details.php?itemid='.$item['ID'].'" class="btn btn-primary">Details</a>';
                    if($item['Sales'] > 0){
                        echo "<span class='sales'>Off " . $item['Sales'];
                        echo "%</span>";
                      }
                    echo '<img class="img-responsive img-thumbnail " src="admin/uploads/image/'.$item['Images'].'" width="100%" height="100%" alt="img" />';
                    echo "<div class='information-details'>";
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
<?php 
    }else{
      
        echo "<div class='container alert alert-danger'> There's No Such ID Or This Item</div>";
    }
}else{
    header('Location:login.php');
}
include $tpl.'footer.php'; 
ob_end_flush(); 
?>
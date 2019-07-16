<?php 
ob_start(); // Output Buffering Start
session_start();
include 'init.php'; 
$noNavbar = '';

            $id = $_GET['ToCart'];
            $stmt = $con->prepare("INSERT INTO 
                                    ordering(User_ID, Item_ID) 
                                  VALUES(:userid, :itemid)");
        $stmt->execute(array(
            'userid'  =>	$sessionuid,
            'itemid'	=>	$id
        ));

//////////////////////////////////


  $stmt = $con->prepare("SELECT ordering.*,items.*
                                From ordering 
                                INNER JOIN items ON items.ID = ordering.Item_ID");
        // Execute The Statement
        $stmt->execute();
        // Assign To Variable
        $orders = $stmt->fetchAll();
	if(! empty($orders)){
	?>
		<h1 class="text-center">Your Shopping</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-bordered">
					<tr>
                        <td>Image</td>
						<td>Item-Name</td>
						<td>Price</td>
						<td>Control</td>
					<tr>
					<?php
					foreach($orders as $order){
                        echo "<tr>";
							echo "<td>";
									echo "<img src='admin/uploads/image/".$order['Images']."' alt='image'>";
							echo "</td>";

							echo "<td>".$order['Name']."</td>";
							echo "<td>".$order['Price']."</td>";
							echo "<td>
                                <a href='shopping.php?action=Delete&order_id=". $order['Oreder_ID']."'' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>";
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

?>

<?php include $tpl.'footer.php'; 
 ob_end_flush();
?>
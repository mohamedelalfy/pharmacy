<?php
	/*
	** Get All Function V3.0 
	** Function To Get All Records From Any Database Table
	*/

	function getAllFrom($field, $table, $where = NULL, $and = NULL, $orderField, $ordering = "DESC"){

		global $con;
		
		$getAll = $con->prepare(" SELECT $field FROM $table  $where $and ORDER BY $orderField $ordering ");

		$getAll->execute();

		$all = $getAll->fetchAll();

		return $all;
	}

	/*
	** Title Function 
	*/
	function getTitle(){
        global $pageTitle;

        if(isset( $pageTitle)){
            echo $pageTitle;
        }else{
            echo "Pharmacy";
        }
}

/*
	** Check Items Function 
	*/

function checkItem($select, $table ,$value ){

	global $con ;

	$statment = $con->prepare("SELECT $select FROM $table WHERE $select = ?");

	$statment->execute(array($value));

	$count = $statment->rowCount();

	return $count;
}

	/*
	** Count Number Of Items Function V1.0
	**	Function To Count Number Of Items Rows
	*/

	function countItems($item, $table) {

		global $con;

		$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

		$stmt2->execute();

		return $stmt2->fetchColumn();

	}

/*
	** Home Redirect Function
	*/

	function redirectHome($theMsg, $url = null , $seconds = 3){

		if($url === null) {

			$url = 'index.php';
			$link = 'HomePage';

		}else {

			$url= isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ? $_SERVER['HTTP_REFERER'] : 'index.php';
			
			$link = 'Previous Page';
		}
		
		echo "<div class='container'>";

			echo $theMsg;

			echo "<div class='alert alert-info'>You Will Be Redirected To $link After $seconds Seconds. </div>";

			header("refresh:$seconds;url=$url");

			exit();

		echo "</div>";

	}


	

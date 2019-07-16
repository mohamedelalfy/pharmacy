<?php
    session_start();
    $noNavbar = '';
    $pageTitle = "Login";
    if(isset($_SESSION['Username'])){
        header('location:dashboard.php'); // Redirect To Dashboard Page
    }
	include 'init.php';
    
    // Check If Users Coming From HTTP Post Requst

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $username = $_POST['user'];
        $password = $_POST['password'];
        $hashedPass = sha1($password);

        // Check If The Users Exist In Database
        $stmt = $con->prepare("SELECT
                                    UserID,UserName,Password
                                FROM
                                    users
                                WHERE 
                                    UserName = ? 
                                AND
                                    Password = ?
                                AND
                                    GroupID = 1
                                Limit 1");
        $stmt->execute(array($username,$hashedPass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count > 0 ){
            
            $_SESSION['Username'] = $username;  // Register Session Name
            $_SESSION['ID'] = $row['UserID'];   // Register Session ID 
            header('location:dashboard.php');   // Redirect To Dashboard Page
            exit();
        }
    }
?>

<div class="shap"></div>
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class= "row">
            <div class = "col-sm-8 input">
                <input class="form-control" type="text" name="user" placeholder="UserName" autocomplete="off"/>
                <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="new-password"/>
                <input class="btn btn-primary btn-block" type="submit" value="Login"/>
            </div>
            <div class = "col-sm-3">
                <img class="adminlogo" src="layout/images/logo.jpg" alt="login">
            </div>
        </div>
    </form> 
<?php include $tpl.'footer.php'; ?>
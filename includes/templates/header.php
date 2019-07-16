<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo getTitle()?></title>
	<link rel="stylesheet" href="<?php echo $css ?>bootstrap.css">
    <link rel="stylesheet" href="<?php echo $css ?>font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo $css ?>jquery-ui.css"/>
    <link rel="stylesheet" href="<?php echo $css ?>jquery.selectBoxIt.css"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $css ?>front.css"/>
</head>
<body>
<header>
<div class="container-fluid">
    <div  class="row">

        <div class="col-xs-6">
            <div class="translation">
                <i class="fa fa-language"></i>
                <a href="#">AR</a> /
                <a href="#">ENG</a>
            </div>
        </div>
        <div class="col-xs-6 ">
            <?php if(isset($_SESSION['user'])){
                
                $stmt =$con->prepare("SELECT Images FROM users WHERE UserID = ?");
                $stmt->execute(array($sessionuid));
                $usre=$stmt->fetch();
                ?>
                    <div class= "pull-right ">
                     <?php 
                        if(empty($usre['Images'])){

                            echo "<img class='default' src='layout/images/UserImage/Avatar.png' alt='User-img'>";
                        }else{
                            echo '<img class="my-img pull-left " src="admin/uploads/image/UserImage/'.$usre['Images'].'"  alt="user-img" />';
            
                        }
                    ?>
                        <div class="btn btn-default btn-group my-info pull-right">
                        <span class="btn dropdown-toggle" data-toggle="dropdown">
                            <?php echo $sessionUser ?>
                            <span class="caret"></span>
                        </span>
                        <ul class="dropdown-menu">
                            <li><a href='profile.php?action=manage'>Your Profile </a></li>
                            <li><a href=''>Your Message</a></li>
                            <li><a href='logout.php'>Logout</a></li>
                        </ul>
                        
                    </div>
                </div>
				<?php
            } else { ?>
                <div class="login pull-right">
                <i class="fa fa-user"></i>
                <a href="login.php #login">LOGIN </a>
            </div>
            <div class="login pull-right">
                <i class="fa fa-user-plus"></i>
                <a href="login.php #register">REGISTER </a> 
            </div>
          <?php } ?>
    </div>
    </div>
</div>
</header>

<!-- Start navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">
          <img class="logo-img" src="layout/images/logo123.png" alt="img">
          <img class="logo-title" src="layout/images/logo1234.png" alt="img">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-align-justify"></i> Categories <span class="caret"></span></a>
          <ul class="dropdown-menu">
                <?php
                    $getCategory = getAllFrom("*", "categories", "" ,"" , "ID" ,"ASC");
                    foreach($getCategory as $cat ){
                        echo 
                        '<li>
                            <a href = "category.php?pageid='. $cat['ID'].'">'. $cat['Name'] .'</a>
                        </li>';
                    }
			    ?>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="home.php #private"> <i class="fa fa-envelope-open"></i> Private Message</a></li>
        <li><a href='#'><i class="fa fa-shopping-cart"></i> Shopping Cart</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- End navbar -->
<!-- Start section slider -->

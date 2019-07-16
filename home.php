<?php 
ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Homepage';
include 'init.php'; ?>
  <section id="header">
    <div class="intro">
      <div class="overlay">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="intro-text">
                <h2>Welcome to <span class="brand">CURE HOUSE</span></h2>
                <p class="lead">Here you can buy your medications online and we deliver that quickly.</p>
              </div>      
            </div>
            <div class="col-lg-6">
              <img class="img-responsive slider-img " src="layout/images/Doctor.png">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End section slider -->
  <!-- the medicine section -->
  <div id="medicine">
    <div class="container">
        <h2>medication section </h2>
      <div class="row">
        <div class="medicine-items">
            <?php
              $stmt = $con->prepare("SELECT * FROM items ORDER BY ID DESC LIMIT 8");
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
                    echo '<img class="img-responsive img-thumbnail" src="admin/uploads/image/'.$item['Images'].'" width="100%" height="100%"  alt="img" />';
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
          
          <div class="clearfix"></div>
            <div class="btn-show">
              <a href="allitem.php">show more</a>
            </div> <!--end button-->

        </div>
      </div>
    </div>
  </div>
<!-- end the medicine section -->

<!-- Start Section Contact Us -->
<section class="contact-us text-center">
  <div class="fields">
      <div class="container">
          <div class="row">
              <i class="fa fa-weixin fa-5x"></i>
              <h2 class="h1" id="private"> Private Message </h2>
              <!-- Start Contact Form -->
              <form role="form" action='#private' method="POST" enctype= "multipart/form-data">
                  <div class="col-md-6" >
                      <div class="form-group">
                        <label class="subject-title">Subject</label>
                          <input type="text" name="subject" class="form-control input-lg" placeholder="subject"  autocomplete="off">
                      </div>
                      <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="Images">
                            </div>
                        </div>
                  </div>
                  <div class="col-md-6 " >
                      <div class="form-group">
                          <textarea  name="message" class="form-control input-lg" placeholder="Your Message"></textarea>
                      </div>
                  </div>
                  <div class="col-lg-6 col-lg-offset-3">
                    <input type="submit" class="btn btn-primary btn-lg btn-block"  value="send message">
                  </div>
              </form>
              <!-- End Contact Form -->
          </div>
      </div>
  </div>
</section>
<!-- End Section Contact Us -->

<?php 
if (isset($_SESSION['user'])){

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		// Upload Variablse
		$imageName = $_FILES['Images']['name'];
		$imageSize = $_FILES['Images']['size'];
		$imageTmp = $_FILES['Images']['tmp_name'];
		$imageType = $_FILES['Images']['type'];

		// List Of Allowed File Typed To Upload

		$imageAllowedExtension = array("jpeg","jpg", "png", "gif");

		// Get image Extension

		$imageExtension = strtolower(end(explode('.' , $imageName))); 	

		//Get Variables From The Form

		$subject 	 = $_POST['subject'];
    $message   = $_POST['message'];
    

			if(! empty($imageName)){

				$image = rand(0, 1000000000) . '_' . $imageName ;
        move_uploaded_file($imageTmp , "admin\uploads\Image\PrivateMessage\\" .$image);
        
			} else{
				$image = '' ;	
			}

			//Insert User Info In Database 

			$stmt = $con->prepare("INSERT INTO 
									private_message(Subject, Message, Date, Images, User_ID) 
                  VALUES(:xsubject, :xmessage, now(), :ximage, :xuser_ID)");
                  
			$stmt->execute(array(
				'xsubject'  =>	$subject,
				'xmessage'	=>	$message,
        'ximage' 	  =>	$image,
        'xuser_ID' 	=> $sessionuid
			));		

			//Echo Success Message

			$theMsg = "<div class='alert alert-success'> The message was sent successfully and I waited for the reply from the Admin</div>";

			redirectHome($theMsg , 'back');
		}
}else{
  echo "<div class='alert alert-danger text-center' style='margin-bottom: 0'>
         <i class='fa fa-envelope'></i> You Can't Send Message Befor 
        <a href='login.php' style='color:#c71212;font-weight:bold;font-size:17px'>Login/Register</a></div>";
}
?>
<?php
include $tpl.'footer.php'; 
ob_end_flush(); 
?>
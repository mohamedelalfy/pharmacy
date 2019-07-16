<?php

    
    include 'connect.php';

    //Routes

    $tpl 	= 'includes/templates/'; //templates Directory
	$lang 	= 'includes/languages/'; //Langauge Directory
	$func	= 'includes/functions/'; //Functions Directory
	$css 	= 'layout/css/'; 		 //Css Directory
    $js 	= 'layout/js/';			 //javascript Directory
    
    // Include Then Important Files
	include $func . 'functions.php';
	include $lang . 'english.php';
	include $tpl  . 'header.php';

    // Include Navbar On All Pages Expect The One With $noNavbar Variable 
    if(!isset($noNavbar)){ include $tpl.'navbar.php' ;}
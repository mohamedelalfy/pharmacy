<?php

    include 'connect.php';
	$sessionUser = '' ;
	if(isset($_SESSION['user']))
	{
        $sessionUser = $_SESSION['user'];
        $sessionuid = $_SESSION['uid'];
	}
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
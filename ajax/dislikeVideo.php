<?php
require_once("../phplib/config.php"); 
require_once("../phplib/classes/Video.php"); 
require_once("../phplib/classes/User.php"); 

$username = $_SESSION["userLoggedIn"];
$videoId = $_POST["videoId"];

$userLoggedInObj = new User($con, $username);
$video = new Video($con, $videoId, $userLoggedInObj);

echo $video->dislike();
?>
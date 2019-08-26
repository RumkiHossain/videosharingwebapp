<?php
require_once("../phplib/config.php"); 
require_once("../phplib/classes/Comment.php"); 
require_once("../phplib/classes/User.php"); 

$username = $_SESSION["userLoggedIn"];
$videoId = $_POST["videoId"];
$commentId = $_POST["commentId"];

$userLoggedInObj = new User($con, $username);
$comment = new Comment($con, $commentId, $userLoggedInObj, $videoId);

echo $comment->getReplies();
?>
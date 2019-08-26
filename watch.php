<?php 
require_once("phplib/header.php"); 
require_once("phplib/classes/VideoPlayer.php"); 
require_once("phplib/classes/VideoInfoSection.php"); 
require_once("phplib/classes/Comment.php"); 
require_once("phplib/classes/CommentSection.php"); 

if(!isset($_GET["id"])) {
    echo "No url passed into page";
    exit();
}

$video = new Video($con, $_GET["id"], $userLoggedInObj);
$video->incrementViews();
?>
<script src="designer/js/videoPlayerActions.js"></script>
<script src="designer/js/commentActions.js"></script>

<div class="watchLeftColumn">

<?php
    $videoPlayer = new VideoPlayer($video);
    echo $videoPlayer->create(true);

    $videoPlayer = new VideoInfoSection($con, $video, $userLoggedInObj);
    echo $videoPlayer->create();

    $commentSection = new CommentSection($con, $video, $userLoggedInObj);
    echo $commentSection->create();
?>


</div>

<div class="suggestions">
    <?php
    $videoGrid = new VideoGrid($con, $userLoggedInObj);
    echo $videoGrid->create(null, null, false);
    ?>
</div>




<?php require_once("phplib/footer.php"); ?>
                
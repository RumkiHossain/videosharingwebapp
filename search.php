<?php
require_once("phplib/header.php");
require_once("phplib/classes/SearchResultsProvider.php");

if(!isset($_GET["term"]) || $_GET["term"] == "") {
    echo "You must enter a search term";
    exit();
}

$term = $_GET["term"];

if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == "views") {
    $orderBy = "views";
}
else {
    $orderBy = "uploadDate";
}

$searchResultsProvider = new SearchResultsProvider($con, $userLoggedInObj);
$videos = $searchResultsProvider->getVideos($term, $orderBy);

$videoGrid = new VideoGrid($con, $userLoggedInObj);
?>
<div class="largeVideoGridContainer">

    <?php

    if(sizeof($videos) > 0) {
        echo $videoGrid->createLarge($videos, sizeof($videos) . " results found", true);
    }
    else {
        echo "<div class='column' style='color:red; text-align:center;' >
                    <h1>No Result Found!</h1>
                </div>";
    }

    ?>

</div>














<?php
require_once("phplib/footer.php");
?>
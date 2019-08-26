<?php 
require_once("phplib/header.php");
require_once("phplib/classes/VideoUploadData.php");
require_once("phplib/classes/VideoProcessor.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

if(!isset($_POST["uploadButton"])) {
    echo "No file sent to page.";
    exit();
}



// for: create file upload data
$videoUploadData = new VideoUploadData(
                            $_FILES["fileInput"], 
                            $_POST["titleInput"],
                            $_POST["descriptionInput"],
                            $_POST["privacyInput"],
                            $_POST["categoryInput"],
                            $userLoggedInObj->getUsername()   
                        );

$videoProcessor = new VideoProcessor($con);
$wasSuccessful = $videoProcessor->upload($videoUploadData);


if($wasSuccessful) {
    echo "<div class='column' style='color:green; text-align:center;' >
                    <h1>Upload successful!</h1>
                </div>";
}

?>


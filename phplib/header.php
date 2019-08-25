<?php 
require_once("phplib/config.php"); 
require_once("phplib/classes/ButtonProvider.php"); 
require_once("phplib/classes/User.php"); 
require_once("phplib/classes/Video.php"); 
require_once("phplib/classes/VideoGrid.php"); 
require_once("phplib/classes/VideoGridItem.php");
require_once("phplib/classes/SubscriptionsProvider.php"); 
require_once("phplib/classes/NavigationMenuProvider.php");
 

$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>VideoSharingWebApp</title>

    <link rel="stylesheet" type="text/css" href="helper/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="designer/css/designer.css">
    <link rel="stylesheet" type="text/css" href="helper/css/dataTables.bootstrap.min.css">

    <script src="helper/js/jquery-3.3.1.min.js"></script>
    <script src="helper/js/popper.min.js"></script>
    <script src="helper/js/bootstrap.min.js"></script> 
    <script src="helper/js/jquery.dataTables.min.js"></script> 
    <script src="helper/js/dataTables.bootstrap.min.js"></script> 

    
    <script src="designer/js/sideBarToggle.js"></script>
    <script src="designer/js/userActions.js"></script>
    

</head>
<body>
    
    <div id="pageContainer">

        <div id="mastHeadContainer">
            <button class="navShowHide">
                <img src="designer/images/icons/menu.png">
            </button>

            <a class="logoContainer" href="index.php">
                <img src="designer/images/icons/logo.jpg" title="logo" alt="Site logo">
            </a>

            <div class="searchBarContainer">
                <form action="search.php" method="GET">
                    <input type="text" class="searchBar" name="term" placeholder="Search...">
                    <button class="searchButton">
                        <img src="designer/images/icons/search.png">
                    </button>
                </form>
            </div>

            <div class="rightIcons">
                <a href="upload.php">
                    <img class="upload" src="designer/images/icons/upload.png">
                </a>
                <?php echo ButtonProvider::createUserProfileNavigationButton($con, $userLoggedInObj->getUsername()); ?>
            </div>

        </div>

        <div id="sideNavContainer" style="display:none;">
            <?php
            $navigationProvider = new NavigationMenuProvider($con, $userLoggedInObj);
            echo $navigationProvider->create();
            ?>
        </div>

        <div id="mainSectionContainer">
            <div id="mainContentContainer">
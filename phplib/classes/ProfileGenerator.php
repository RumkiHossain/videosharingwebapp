<?php
require_once("ProfileData.php");


class ProfileGenerator {

    private $con, $userLoggedInObj, $profileData;

    public function __construct($con, $userLoggedInObj, $profileUsername) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->profileData = new ProfileData($con, $profileUsername);
        
    }

    public function create() {
        $profileUsername = $this->profileData->getProfileUsername();
        
        if(!$this->profileData->userExists()) {
            return "User does not exist";
        }

        $coverPhotoSection = $this->createCoverPhotoSection();
        $headerSection = $this->createHeaderSection();
        $tabsSection = $this->createTabsSection();
        $contentSection = $this->createContentSection();
        
        return "<div class='profileContainer'>
                    $coverPhotoSection
                    $headerSection
                    $tabsSection
                    $contentSection
                </div>";
    }

    public function createCoverPhotoSection() {
        $coverPhotoSrc = $this->profileData->getCoverPhoto();
        $name = $this->profileData->getProfileUserFullName();
        $userType = $this->profileData->getUserType();

        if ($userType == "user") {
            return "<div class='coverPhotoContainer'>
                    <img src='$coverPhotoSrc' class='coverPhoto'>
                    <span class='channelName'>$name</span>
                    </div>";
        }
        if($userType == "admin"){
            return "<div class='coverPhotoContainer'>
                    <img src='$coverPhotoSrc' class='coverPhoto'>
                    <span class='channelName'>ADMIN <br> $name</span>
                    </div>";
        }
        
            
        
    }

    public function createHeaderSection() {
        $profileImage = $this->profileData->getProfilePic();
        $name = $this->profileData->getProfileUserFullName();
        $subCount = $this->profileData->getSubscriberCount();
        $userType = $this->profileData->getUserType();
        
        $button = $this->createHeaderButton();

        if ($userType == "user") {
            return "<div class='profileHeader'>
                    <div class='userInfoContainer'>
                        <img class='profileImage' src='$profileImage'>
                        <div class='userInfo'>
                            <span class='title' style='color: green;'>$name</span>
                            <span class='subscriberCount'>$subCount subscribers</span>
                        </div>
                    </div>

                    <div class='buttonContainer'>
                        <div class='buttonItem'>    
                            $button
                        </div>
                    </div>
                </div>";
        }if($userType == "admin"){
            return "<div class='profileHeader'>
                    <div class='userInfoContainer'>
                        <img class='profileImage' src='$profileImage'>
                        <div class='userInfo'>
                            <span class='title' style='color: red;'>$name (ADMIN)</span>
                            <span class='subscriberCount'>$subCount subscribers</span>
                        </div>
                    </div>

                    <div class='buttonContainer'>
                        <div class='buttonItem'>    
                            $button
                        </div>
                    </div>
                </div>";
        }
            

        
    }

    public function createTabsSection() {

            $userType = $this->profileData->getUserType();

            if ($userType == "user") {
                return "<ul class='nav nav-tabs' role='tablist'>
                            <li class='nav-item'>
                            <a class='nav-link active' id='videos-tab' data-toggle='tab' 
                                href='#videos' role='tab' aria-controls='videos' aria-selected='true'>VIDEOS</a>
                            </li>
                            <li class='nav-item'>
                            <a class='nav-link' id='about-tab' data-toggle='tab' href='#about' role='tab' 
                                aria-controls='about' aria-selected='false'>ABOUT</a>
                            </li>
                        </ul>";
            }if($userType == "admin"){
                return "<ul class='nav nav-tabs' role='tablist'>
                            <li class='nav-item'>
                            <a class='nav-link active' id='videos-tab' data-toggle='tab' 
                                href='#videos' role='tab' aria-controls='videos' aria-selected='true'>VIDEOS</a>
                            </li>
                            <li class='nav-item'>
                            <a class='nav-link' id='videos-tab' data-toggle='tab' 
                                href='#videocontrol' role='tab' aria-controls='videocontrol' aria-selected='true'>VIDEO CONTROL</a>
                            </li>
                            <li class='nav-item'>
                            <a class='nav-link' id='videos-tab' data-toggle='tab' 
                                href='#management' role='tab' aria-controls='managment' aria-selected='true'>MANAGEMENT</a>
                            </li>
                            <li class='nav-item'>
                            <a class='nav-link' id='about-tab' data-toggle='tab' href='#about' role='tab' 
                                aria-controls='about' aria-selected='false'>ABOUT</a>
                            </li>
                        </ul>";
            }
        
                
    }

    public function createContentSection() {

        $videos = $this->profileData->getUsersVideos();

        if(sizeof($videos) > 0) {
            $videoGrid = new VideoGrid($this->con, $this->userLoggedInObj);
            $videoGridHtml = $videoGrid->create($videos, null, false);
        }
        else {
            $videoGridHtml = "<span>This user has no videos</span>";
        }

        $userType = $this->profileData->getUserType();

        $aboutSection = $this->createAboutSection();


        if ($userType == "user") {
            return "<div class='tab-content channelContent'>
                    <div class='tab-pane fade show active' id='videos' role='tabpanel' aria-labelledby='videos-tab'>
                        $videoGridHtml
                    </div>
                    <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
                        $aboutSection
                    </div>
                </div>";
        }if($userType == "admin"){
            return "<div class='tab-content channelContent'>
                    <div class='tab-pane fade' id='videos' role='tabpanel' aria-labelledby='videos-tab'>
                        $videoGridHtml
                    </div>
                    <div class='tab-pane fade' id='videocontrol' role='tabpanel' aria-labelledby='videos-tab'>
                        video control
                    </div>
                    <div class='tab-pane fade' id='management' role='tabpanel' aria-labelledby='videos-tab'>
                        management
                    </div>
                    <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
                        $aboutSection
                    </div>
                </div>";
        }
        

        
    }

    private function createHeaderButton() {
        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()) {
            return "";
        }
        else {
            return ButtonProvider::createSubscriberButton(
                        $this->con, 
                        $this->profileData->getProfileUserObj(),
                        $this->userLoggedInObj);
        }
    }

    private function createAboutSection() {
        $html = "<div class='section'>
                    <div class='title'>
                        <span>Details</span>
                    </div>
                    <div class='values'>";

        $details = $this->profileData->getAllUserDetails();
        foreach($details as $key => $value) {
            $html .= "<span>$key: $value</span>";
        }

        $html .= "</div></div>";

        return $html;
    }

    private function createManagementSection(){
        $html ="";
    }

}
?>
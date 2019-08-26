<?php
class NavigationMenuProvider {

    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {
        $menuHtml = $this->createNavItem("Home", "designer/images/icons/home.png", "index.php");
        $menuHtml .= $this->createNavItem("Trending", "designer/images/icons/trending.png", "trending.php");
        $menuHtml .= $this->createNavItem("Subscriptions", "designer/images/icons/subscriptions.png", "subscriptions.php");
        $menuHtml .= $this->createNavItem("Liked Videos", "designer/images/icons/circle-thumb-up.png", "likedVideos.php");
        
        if(!User::isLoggedIn()) {
            $menuHtml .= $this->createNavItem("Sign Up", "designer/images/icons/signup.png", "signUp.php");
        }

        if(User::isLoggedIn()) {
            $menuHtml .= $this->createNavItem("Settings", "designer/images/icons/settings.png", "settings.php");
            $menuHtml .= $this->createNavItem("Log Out", "designer/images/icons/logout.png", "logout.php");

            $menuHtml .= $this->createSubscriptionsSection();
        }
        
        $menuHtml .= $this->createFooter();

        return "<div class='navigationItems'>
                    $menuHtml
                </div>";
    }

    private function createNavItem($text, $icon, $link) {
        return "<div class='navigationItem'>
                    <a href='$link'>
                        <img src='$icon'>
                        <span>$text</span>
                    </a>
                </div>";
    }

    private function createSubscriptionsSection() {
        $subscriptions = $this->userLoggedInObj->getSubscriptions();

        $html = "<span class='heading'>Subscriptions</span>";
        
        foreach($subscriptions as $sub) {
            $subUsername = $sub->getUsername();
            $html .= $this->createNavItem($subUsername, $sub->getProfilePic(), "profile.php?username=$subUsername");
        }
        return $html;
    }
    
    private function createFooter() {

        $html = "<div class='card-footer bg-transparent border-success'><small>Copyright &copy; 2019 by VideoSharingWebApp.<br> All rights reserved.</small></div>";

        return $html;
    }

}
?>


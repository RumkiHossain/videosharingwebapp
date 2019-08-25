<?php
class ButtonProvider {

    public static $signInFunction = "notSignedIn()";

    public static function createLink($link) {
        return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
    }

    public static function createButton($text, $imageSrc, $action, $class) {

        $image = ($imageSrc == null) ? "" : "<img src='$imageSrc'>";

        $action  = ButtonProvider::createLink($action);

        return "<button class='$class' onclick='$action'>
                    $image
                    <span class='text'>$text</span>
                </button>";
    }

    public static function createHyperlinkButton($text, $imageSrc, $href, $class) {

        $image = ($imageSrc == null) ? "" : "<img src='$imageSrc'>";

        return "<a href='$href'>
                    <button class='$class'>
                        $image
                        <span class='text'>$text</span>
                    </button>
                </a>";
    }

    public static function createUserProfileButton($con, $username) {
        $userObj = new User($con, $username);
        $profilePic = $userObj->getProfilePic();
        
        $link = "profile.php?username=$username";
        

        if($username != ""){
            return "<a href='$link'>
                    <img src='$profilePic' class='profilePicture'>
                    </a>";
        }

    }
    
    
    public static function createEditDeleteVideoButton($videoId) {
        $href1 = "editVideo.php?videoId=$videoId";
        $href2 = "deleteVideo.php?videoId=$videoId";

        $button1 = ButtonProvider::createHyperlinkButton("EDIT VIDEO", null, $href1, "edit button");
        $button2 = ButtonProvider::createHyperlinkButton("DELETE VIDEO", null, $href2, "delete button");


        return "<div class='editVideoButtonContainer'>
                    $button1
                </div>
                <div class='editVideoButtonContainer'>
                    $button2
                </div>";
    }
    
    
    public static function createSubscriberButton($con, $userToObj, $userLoggedInObj) {
        $userTo = $userToObj->getUsername();
        $userLoggedIn = $userLoggedInObj->getUsername();

        $isSubscribedTo = $userLoggedInObj->isSubscribedTo($userTo);
        $buttonText = $isSubscribedTo ? "SUBSCRIBED" : "SUBSCRIBE";
        $buttonText .= " " . $userToObj->getSubscriberCount();

        $buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";
        $action = "subscribe(\"$userTo\", \"$userLoggedIn\", this)";

        $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

        return "<div class='subscribeButtonContainer'>
                    $button
                </div>";
    }
    
    public static function createUserProfileNavigationButton($con, $username) {
        if(User::isLoggedIn()) {
            
                return ButtonProvider::createUserProfileButton($con, $username);
            
            
        }
        else {
            return "<a href='signIn.php'>
                        <span class='signInLink'>SIGN IN</span>
                    </a>";
        }
    }

}
?>
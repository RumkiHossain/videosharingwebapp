<?php 
require_once("phplib/config.php"); 
require_once("phplib/classes/Account.php");
require_once("phplib/classes/Constants.php"); 
require_once("phplib/classes/FormSanitizer.php");


$account = new Account($con);

if(isset($_POST["submitButton"])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);

    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);

    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);

    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
    
    $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

    if($wasSuccessful) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }

}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>VideoSharingWebApp</title>

    <link rel="stylesheet" type="text/css" href="helper/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="designer/css/designer.css">

    <script src="helper/js/jquery-3.3.1.min.js"></script>
    <script src="helper/js/popper.min.js"></script>
    <script src="helper/js/bootstrap.min.js"></script> 
    
    <script src="designer/js/sideBarToggle.js"></script>
    <script src="designer/js/userActions.js"></script>

</head>
<body>

    <div class="signInContainer">

        <div class="column">

            <div class="header">
                <img src="designer/images/icons/logo.jpg" title="logo" alt="Site logo">
                <h3>Sign Up</h3>
                <span>to continue to VideoSharingWebApp</span>
            </div>

            <div class="loginForm">

                <form action="signUp.php" method="POST">
                    
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" name="firstName" placeholder="First name" value="<?php getInputValue('firstName'); ?>" autocomplete="off" required>

                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="lastName" placeholder="Last name" autocomplete="off" value="<?php getInputValue('lastName'); ?>" required>

                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?php getInputValue('username'); ?>" required>

                <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" name="email" placeholder="Email" autocomplete="off" value="<?php getInputValue('email'); ?>" required>
                <input type="email" name="email2" placeholder="Confirm email" autocomplete="off" value="<?php getInputValue('email2'); ?>" required>
                
                <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>
                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <input type="password" name="password2" placeholder="Confirm password" autocomplete="off" required>

                <input type="submit" name="submitButton" class="btn btn-success" value="SIGN UP">

                
                </form>


            </div>

            <a class="signInMessage" href="signIn.php">Already have an account? Sign in here!</a>
        
        </div>
    
    </div>




</body>
</html>
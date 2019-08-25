<?php 
require_once("phplib/config.php");
require_once("phplib/classes/Account.php");
require_once("phplib/classes/Constants.php"); 
require_once("phplib/classes/FormSanitizer.php"); 

$account = new Account($con);

if(isset($_POST["submitButton"])) {
    
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    
    
    $wasSuccessful = $account->login($username, $password);
    
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
                <h3>Sign In</h3>
                <span>to continue to VideoSharingWebApp</span>
            </div>

            <div class="loginForm">

                <form action="signIn.php" method="POST">
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <input type="text" name="username" placeholder="Username" value="<?php getInputValue('username'); ?>" 
                    required autocomplete="off">
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="submit" name="submitButton" class="btn btn-success" value="SIGN IN">
                
                </form>


            </div>
            
            <div>
            <a class="signInMessage" href="signUp.php">Forgot password? Click here!</a>
            </div>

            <div>
            <a class="signInMessage" href="signUp.php">Need an account? Sign up here!</a>
            </div>
        
        </div>
    
    </div>




</body>
</html>
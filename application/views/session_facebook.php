<?php
// Must pass session data for the library to work (only if not already included in your app).
session_start();

// Facebook app settings
$app_id       = '1597426363827669';
$app_secret   = '1ec53bd3e00f14a7bdf3211e50e753ea';
$redirect_uri = 'http://espaciovivomexico.com';

// Requested permissions for the app - optional.
$permissions = array(
    'email',
    'user_location',
    'user_birthday',
    'user_name'
);

// Define the root directoy.
define( 'ROOT', getcwd() . '/' );
// define( 'ROOT', dirname( __FILE__ ) . '/' );

// Autoload the required files
require_once( ROOT . 'vendor/autoload.php' );

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;

// Initialize the SDK.
FacebookSession::setDefaultApplication( $app_id, $app_secret );

// Initialize the Facebook SDK.
FacebookSession::setDefaultApplication( $app_id, $app_secret );
$helper = new FacebookRedirectLoginHelper( $redirect_uri );

// Authorize the user.
try {
    if ( isset( $_SESSION['access_token'] ) ) {
        // Check if an access token has already been set.
        $session = new FacebookSession( $_SESSION['access_token'] );
    } else {
        // Get access token from the code parameter in the URL.
        $session = $helper->getSessionFromRedirect();
    }
} catch( FacebookRequestException $ex ) {

    // When Facebook returns an error.
    print_r( $ex );
} catch( \Exception $ex ) {

    // When validation fails or other local issues.
    print_r( $ex );
}
if ( isset( $session ) ) {

    // Retrieve & store the access token in a session.
    $_SESSION['access_token'] = $session->getToken();

    $logoutURL = $helper->getLogoutUrl( $session, 'http://your-app-domain.com/logout' );

    // Logged in
    echo '<h1>Successfully logged in! <a href="' . $logoutURL . '">Logout</a></h1>';
} else {

    // Generate the login URL for Facebook authentication.
    $loginUrl = $helper->getLoginUrl();
    $loginFacebookBtn =  '<a href="' . $loginUrl . '"><button type="button" class="btn btn-default col-sm-6"><i class="icon-large icon-facebook col-sm-2"></i>INICIA SESIÓN CON FACEBOOK</button></a>';
}
?>
<?php
// This is the Accounts controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the functions library
require_once '../library/functions.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the accounts model
require_once '../model/accounts-model.php';

// Get the vehicles model
require_once '../model/reviews-model.php';


// Get the array of classifications
$classifications = getClassifications();


// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

// Control structure
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
  case 'register':
    // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for existing email address in the table
    $existingEmail = checkExistingEmail($clientEmail);

    if ($existingEmail) {
      $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
      $message = '<p class="center">Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit;
    }

    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model if no erros exist
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if ($regOutcome === 1) {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
    } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. 
          Please try again.</p>";
      include '../view/registration.php';
      exit;
    }
    break;

  case 'Login':
    // Filter and store the data
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for missing data
    if (empty($clientEmail) || empty($checkPassword)) {
      $message = '<p class="center">Please provide information for all empty form fields.</p>';
      include '../view/login.php';
      exit;
    }

    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if (!$hashCheck) {
      $message = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    $clientId = $_SESSION['clientData']['clientId'];
    $reviews = getReviewByClientId($clientId);
    $showReviews = buildReviewsByClientId($reviews);
    include '../view/admin.php';
    exit;
    break;

  case 'logout':
    unset($_SESSION['clientData']);
    session_destroy();
    include '../index.php';
    break;

  case 'admin':
    $clientId = $_SESSION['clientData']['clientId'];
    $reviews = getReviewByClientId($clientId);
    $showReviews = buildReviewsByClientId($reviews);
    include '../view/admin.php';
    break;

  case 'login':
    include '../view/login.php';
    break;

  case 'registration':
    include '../view/registration.php';
    break;


    // Action from admin view
  case 'accountupdate':
    $clientId = $_SESSION['clientData']['clientId'];
    $userInfo = getUserInfo($clientId);
    if (count($userInfo) < 1) {
      $message = 'Sorry, no user information could be found.';
    }
    include '../view/client-update.php';
    exit;
    break;

  case 'updateUser':
    // Filter and store the data
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    // $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
    $clientEmail = checkEmail($clientEmail);
    // $checkPassword = checkPassword($clientPassword);

    // Check for existing email address in the table
    $existingEmail = checkExistingEmail($clientEmail);

    if ($clientEmail != $_SESSION['clientData']['clientEmail']) {

      if ($existingEmail) {
        $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
        include '../view/client-update.php';
        exit;
      }
    }

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      $message = '<p class="center">Please provide information for all empty form fields.</p>';
      include '../view/client-update.php';
      exit;
    }

    // Send the data to the model if no erros exist
    $updateResult = updateUser($clientFirstname, $clientLastname, $clientEmail, $clientId);

    // Check and report the result
    if ($updateResult === 1) {
      $updatedInfo = getUserInfo($clientId);
      $_SESSION['clientData'] = $updatedInfo;
      $_SESSION['message'] = "<p class='updatemessage'>$clientFirstname thanks for updating your profile.</p>";
      header('Location: /phpmotors/accounts/?action=admin');
      exit;
    } else {
      $message = "<p class='updatemessage'>Sorry $clientFirstname, but the update failed. Please try again.</p>";
      include '../view/client-update.php';
      exit;
    }
    break;

  case 'updatePassword':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
    $checkPassword = checkPassword($clientPassword);
    // Check for missing data
    if ($checkPassword === 0 || empty($checkPassword)) {
      $message = "<p class='center'>Error: Missing or invalid data.</p>";
      include '../view/client-update.php';
      exit;
    }
    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    // Run password update function
    $updatedPassword = updatedPassword($hashedPassword, $clientId);
    // Check and report the result
    if ($updatedPassword === 1) {
      $_SESSION['message'] = "<p class='updatemessage'> Your password was updated successfully.</p>";
      header('Location: /phpmotors/accounts/?action=admin');
      exit;
    } else {
      $message = "<p>Sorry, but the password update failed. 
            Please try again.</p>";
      include '../view/client-update.php';
      exit;
    }
    break;


  default:
    $clientId = $_SESSION['clientData']['clientId'];
    $reviews = getReviewByClientId($clientId);
    $showReviews = buildReviewsByClientId($reviews);
    include '../view/admin.php';
    break;
}

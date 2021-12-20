<?php
// This is the reviews controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the functions library
require_once '../library/functions.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the vehicles model
require_once '../model/vehicles-model.php';

// Get the accounts model
require_once '../model/accounts-model.php';

// Get the reviews model
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
    case 'addreview':
        // Filter and store the data
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT));
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        $invInfo = getInvItemInfo($invId);


        // Check for missing data
        $reviews = getReviewByInvId($invId);
        if (empty($reviewText)) {
            $message = '<p class="center">Please provide information for all empty form fields.</p>';
            $vehicleInformation = getVehicleInfo($invInfo);
            $addReview = writeReview($invInfo);
            $vehicleReviews = buildReviewsDisplay($reviews, $invInfo);
            include '../view/vehicle-detail.php';
            exit;
        }

        // Send data to the model if no errors exist
        $addOutcome = addReview($reviewText, $invId, $clientId);
        $reviews = getReviewByInvId($invId);
        if ($addOutcome === 1) {
            $message = "<p> Your review was added successfully!</p>";
            $vehicleInformation = getVehicleInfo($invInfo);
            $addReview = writeReview($invInfo);
            $vehicleReviews = buildReviewsDisplay($reviews, $invInfo);
            include '../view/vehicle-detail.php';
            exit;
        } else {
            $message = '<p class="center">Sorry, the addition failed. Please try again.</p>';
            include '../view/vehicle-detail.php';
            exit;
        }
        break;

    case 'edit':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewInfo = getReview($reviewId);
        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/review-update.php';
        exit;
        break;

    case 'update':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

        if (empty($reviewText)) {
            $message = '<p class="center">Please provide information for all empty form fields.</p>';
            $reviewInfo = getReview($reviewId);
            include '../view/review-update.php';
            exit;
        }

        // Send data to the model if no errors exist
        $addOutcome = updateReview($reviewText, $reviewId);
        if ($addOutcome === 1) {
            $message = "<p> Your review was updated successfully!</p>";
            $_SESSION['message'] = $message;
            $clientId = $_SESSION['clientData']['clientId'];
            $reviews = getReviewByClientId($clientId);
            $showReviews = buildReviewsByClientId($reviews);
            include '../view/admin.php';
            exit;
        } else {
            $message = '<p class="center">Sorry, the update failed. Please try again.</p>';
            $reviewInfo = getReview($reviewId);
            include '../view/review-update.php';
            exit;
        }
        break;

    case 'deletereview':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewInfo = getReview($reviewId);
        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/review-delete.php';
        exit;
        break;

    case 'delete':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $review = deleteReview($reviewId);
        if ($review === 1) {
            $message = "<p> The review was successfully deleted!</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p> Error: The review was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        }
        break;

    case 'default';
        if ($_SESSION['loggedin']) {
            $clientId = $_SESSION['clientData']['clientId'];
            $reviews = getReviewByClientId($clientId);
            $showReviews = buildReviewsByClientId($reviews);
            include '../view/admin.php';
            exit;
        } else {
            include '../view/home.php';
            exit;
        }
}

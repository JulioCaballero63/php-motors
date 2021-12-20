<?php

/** 
 * Reviews model
 */

/*----------- Add a new review ------------*/
function addReview($reviewText, $invId, $clientId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
        VALUES (:reviewText, :invId, :clientId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

/*----------- Get reviews for a specific inventory item ------------*/
function getReviewByInvId($invId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews JOIN clients ON clients.clientId = reviews.clientId WHERE invId = :invId ORDER BY reviewDate DESC';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Get array of reviews
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $reviews;
}

/*----------- Get reviews for a specific client ------------*/
function getReviewByClientId($clientId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews JOIN inventory ON inventory.invId = reviews.invId WHERE clientId = :clientId ORDER BY reviewDate DESC';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Get array of reviews
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $reviews;
}


/*----------- Get reviews for a specific inventory item ------------*/
function getReview($reviewId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Get array of reviews
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $review;
}

/*----------- Update review ------------*/
function updateReview($reviewText, $reviewId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE reviews 
    SET reviewText = :reviewText
    WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


/*----------- Delete review ------------*/
function deleteReview($reviewId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line replace the placeholder in the SQL
    // statement with the actual value in the variable
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

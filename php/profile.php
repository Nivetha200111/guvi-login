<?php

// Display errors for debugging purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start a session
session_start();

// Database configuration
$host = '127.0.0.1';
$dbname = 'user_management';
$username = 'root';
$password = '';

// Function to check if the request is an Ajax request
function isAjaxRequest() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
         strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

try {
  // Connect to the database using PDO
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // Handle database connection error and return a JSON response
  echo json_encode(["error" => "Could not connect to the database"]);
  exit;
}

// Check if the 'logout' parameter is present in the URL
if (isset($_GET['logout'])) { 
  // Destroy the session to log the user out
  session_destroy();
  exit();
}

// Handle POST requests and ensure they are Ajax requests
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isAjaxRequest()) {

  // Retrieve user profile data from the POST request
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName']; 
  $email = $_POST['email'];
  $phoneNumber = $_POST['phone_number'];
  $age = $_POST['age'];

  // Check if the user is logged in (session must contain 'user_id')
  if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
  }

  // SQL query to update the user's profile data
  $sql = "UPDATE users SET  
            first_name = :firstName,
            last_name = :lastName, 
            email = :email,
            phone_number = :phoneNumber,
            age = :age
          WHERE id = :userId";

  // Prepare and execute the SQL statement
  $stmt = $pdo->prepare($sql);

  $stmt->execute([
    ':firstName' => $firstName,
    ':lastName' => $lastName,
    ':email' => $email,
    ':phoneNumber' => $phoneNumber,
    ':age' => $age,
    ':userId' => $_SESSION['user_id']
  ]);
  
  // Return a success message as a JSON response
  echo json_encode(['success' => 'Profile updated']);
  exit();

}

// Check if the user is not logged in (session must contain 'user_id')
if (!isset($_SESSION['user_id'])) {
  echo json_encode(["error" => "User not logged in"]);
  exit();  
}

// Fetch the user's profile data from the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :userId");

$stmt->execute([':userId' => $_SESSION['user_id']]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Return the user's profile data as a JSON response
echo json_encode($user);

?>

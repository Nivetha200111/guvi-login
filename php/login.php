<?php
// Start a session to manage user authentication
session_start();

// Database connection configuration
$host = '127.0.0.1';
$dbname = 'user_management';
$username = 'root';
$password = ''; // Use the correct password

try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error and display an error message
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate if both username and password fields are not empty
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo "Username and password are required.";
    } else {
        // Prepare SQL statement to retrieve user data by username
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
        $stmt->execute();

        // Fetch user data if a matching username is found
        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Verify the provided password against the hashed password in the database
            if (password_verify($_POST["password"], $user['password'])) {
                // Store user session data for authentication
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                echo "Login successful"; // Simplified response for JavaScript validation
            } else {
                echo "The password you entered was not valid.";
            }
        } else {
            echo "No user found with the provided username.";
        }
    }
} else {
    echo "Please fill out the login form.";
}
?>

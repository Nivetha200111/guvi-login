<?php
// Configuration for database connection
$host = '127.0.0.1';
$dbname = 'user_management';
$username = 'root';
$password = '';

// Connecting to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"]) ||
        empty($_POST["firstName"]) || empty($_POST["lastName"]) || empty($_POST["phoneNumber"]) ||
        empty($_POST["age"])) {
        echo "All fields are required.";
    } else {
        // Check if username, email, or phone number already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email OR phone_number = :phoneNumber");
        $stmt->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
        $stmt->bindParam(':email', $_POST["email"], PDO::PARAM_STR);
        $stmt->bindParam(':phoneNumber', $_POST["phoneNumber"], PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->fetchColumn() > 0) {
            echo "Username, email, or phone number already taken.";
        } else {
            // Prepare SQL statement to prevent SQL injection
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email, first_name, last_name, phone_number, age) VALUES (:username, :password, :email, :firstName, :lastName, :phoneNumber, :age)");

            // Hash the password
            $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

            // Bind parameters
            $stmt->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':email', $_POST["email"], PDO::PARAM_STR);
            $stmt->bindParam(':firstName', $_POST["firstName"], PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $_POST["lastName"], PDO::PARAM_STR);
            $stmt->bindParam(':phoneNumber', $_POST["phoneNumber"], PDO::PARAM_STR); // Ensure this column exists in your table
            $stmt->bindParam(':age', $_POST["age"], PDO::PARAM_INT); // Ensure this column exists in your table

            // Execute statement
            try {
                $stmt->execute();
                echo "Registration successful.";
                // header('Location: ../index.html');
                // exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
} else {
    echo "Please fill out the registration form.";
}
?>

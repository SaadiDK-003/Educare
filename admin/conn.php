<?php
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "gfedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
    echo "connected succses  2 ";
}
$stmt2 = $conn->prepare("SELECT * FROM studentt WHERE Student_Fname = ?"); $studentFname = "Amal"; // Bind the parameter and execute the query
$stmt2->bind_param("s", $studentFname); $stmt2->execute(); // Get the result
$result = $stmt2->get_result(); // Fetch the data and output it
if ($row = $result->fetch_assoc()) { $fname2 = $row['Student_Fname']; $lname = $row['Student_Lname']; $email = $row['Student_Email']; 
    echo $fname2 . "<br>";
    echo $lname . "<br>";
    echo $email . "<br>";
    } else { echo"No student found with the name Amal."; }
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['pass']);
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO studentt (Student_Fname, Student_Lname, Student_Email, Student_Pass) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname , $email, $pass);
    
    $stmt2 = $conn->prepare("SELECT * FROM studentt WHERE Student_Fname = ?"); $studentFname = "Amal"; // Bind the parameter and execute the query$stmt2->bind_param("s", $studentFname); $stmt2->execute(); // Get the result$result = $stmt2->get_result(); // Fetch the data and output itif ($row = $result->fetch_assoc()) { $fname2 = $row['Student_Fname']; $lname = $row['Student_Lname']; $email = $row['Student_Email']; echo$fname2; echo$lname; echo$email; } else { echo"No student found with the name Amal."; }
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    

    // Close statement
    $stmt->close();
}

// Dummy credentials for demonstration
session_start();

// Dummy credentials for demonstration
$valid_email = "email";
$valid_password = "pass";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Basic validation
    if ($email === $valid_email && $pass === $valid_password) {
        // Store user information in session
        $_SESSION['username'] = $username;
        header("Location: welcome.php"); // Redirect to a welcome page
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
$conn->close();
?>

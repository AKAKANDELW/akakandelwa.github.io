<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 400px;
            width: 100%; /* Ensures responsiveness */
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Patient Login</h2>
    <form action="patient_portal.html" method="POST">
        <div class="form-group">
            <label for="patient_id">Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

<?php
// login.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $password = $_POST['password'];

    // Database connection
    $servername = "localhost"; // Change if needed
    $username = "root"; // Your database username
    $db_password = ""; // Your database password
    $dbname = "hpc";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id = ? AND password = ?");
    
    // Check if prepare() failed
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $patient_id, $password); // Change this to use hashed passwords in production

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        echo "Login successful!";
        // Here you can start a session or redirect the user
    } else {
        // Failed login
        echo "Invalid patient ID or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
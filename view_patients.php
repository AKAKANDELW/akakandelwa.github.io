<?php
$servername = "localhost";
$username = "root"; // Use your database username
$password = ""; // Use your database password
$dbname = "hpc"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch patient details
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Patients List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Blood Group</th>
                    <th>Sex</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Primary Physician</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['patient_id']}</td>
                            <td>{$row['full_name']}</td>
                            <td>{$row['dob']}</td>
                            <td>{$row['blood_group']}</td>
                            <td>{$row['sex']}</td>
                            <td>{$row['height']}</td>
                            <td>{$row['weight']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['city']}</td>
                            <td>{$row['state']}</td>
                            <td>{$row['primary_physician']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['email']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No patients found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
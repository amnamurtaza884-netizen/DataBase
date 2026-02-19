<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect
$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Database
$conn->query("CREATE DATABASE IF NOT EXISTS lab_db");
$conn->select_db("lab_db");

// Drop table to prevent duplicates
$conn->query("DROP TABLE IF EXISTS students");

// Create Table
$conn->query("CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    gender VARCHAR(10),
    course VARCHAR(50),
    city VARCHAR(50),
    age INT,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Insert 5 different students
$conn->query("INSERT INTO students 
(full_name, email, phone, gender, course, city, age) VALUES
('Ali Khan', 'ali@email.com', '03001234567', 'Male', 'BSCS', 'Lahore', 21),
('Sara Ahmed', 'sara@email.com', '03111234567', 'Female', 'BBA', 'Karachi', 22),
('Ahmed Raza', 'ahmed@email.com', '03221234567', 'Male', 'BSIT', 'Islamabad', 23),
('Fatima Noor', 'fatima@email.com', '03331234567', 'Female', 'BSSE', 'Multan', 20),
('Usman Ali', 'usman@email.com', '03441234567', 'Male', 'BCom', 'Faisalabad', 24)
");

// Fetch data
$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e0f7fa;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            color: #00796b;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background: #00796b;
            color: white;
        }

        tr:nth-child(even) {
            background: #f1f8e9;
        }

        tr:hover {
            background: #c8e6c9;
        }

        footer {
            text-align: center;
            padding: 15px;
            margin-top: 30px;
            color: #555;
        }
    </style>
</head>
<body>

<h2>Student Records</h2>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Gender</th>
<th>Course</th>
<th>City</th>
<th>Age</th>
<th>Registration Date</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $row['id']; ?></td>
<td><?= $row['full_name']; ?></td>
<td><?= $row['email']; ?></td>
<td><?= $row['phone']; ?></td>
<td><?= $row['gender']; ?></td>
<td><?= $row['course']; ?></td>
<td><?= $row['city']; ?></td>
<td><?= $row['age']; ?></td>
<td><?= $row['registration_date']; ?></td>
</tr>
<?php } ?>

</table>

<footer>
    &copy; 2026 | Lab Work: PHP Student Table
</footer>

</body>
</html>

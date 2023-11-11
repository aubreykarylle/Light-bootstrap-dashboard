<?php
require('vendor/autoload.php');
$faker = Faker\Factory::create();
$servername = "localhost";
$username = "root";
$password = "root";
$database = "recordapp_db";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

for ($i = 0; $i <= 100; $i++) {
    $name = mysqli_real_escape_string($conn, $faker->name);
    $contactNum1 = rand(1000, 9999);
    $contactNum = $contactNum1 . "-" . $contactNum1;
    $email = mysqli_real_escape_string($conn, $faker->email);
    $bldg = ['IT Building', 'CS Building', 'New Building', 'ICT Building', 'Library Building', 'New Building'];
    $rand = rand(0, count($bldg) - 1);
    $address = $bldg[$rand];
    $city = "Puerto Princesa";
    $country = "Philippines";
    $postal = 5300;

    $sql = "INSERT INTO office (Name, contactnum, email, address, city, country, postal) 
            VALUES ('$name', '$contactNum', '$email', '$address', '$city', '$country', $postal)";

    mysqli_query($conn, $sql);
}

echo "100 rows of fake data have been inserted into the 'office' table.";

mysqli_close($conn);
?>;


<?php

require_once 'vendor/autoload.php'; // Assuming you have Faker installed via Composer

$faker = Faker\Factory::create();

// Database connection parameters
$host = 'localhost';
$db = 'recordsapp_db';
$user = 'root';
$pass = 'root';

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert records into the 'employee' table
    $employeeStmt = $pdo->prepare("INSERT INTO employee (lastname, firstname, office_id, address) VALUES (?, ?, ?, ?)");
    for ($i = 0; $i < 100; $i++) {
        $lastname = $faker->lastName;
        $firstname = $faker->firstName;
        $office_id = $faker->numberBetween(1, 5);
        $address = $faker->address;

        $employeeStmt->execute([$lastname, $firstname, $office_id, $address]);
    }

    // Insert records into the 'office' table
    $officeStmt = $pdo->prepare("INSERT INTO office (name, contactnum, email, address, city, country, postal) VALUES (?, ?, ?, ?, ?, ?, ?)");
    for ($i = 0; $i < 50; $i++) {
        $name = $faker->company;
        $contactnum = $faker->phoneNumber;
        $email = $faker->email;
        $address = $faker->address;
        $city = $faker->city;
        $country = $faker->country;
        $postal = $faker->postcode;

        $officeStmt->execute([$name, $contactnum, $email, $address, $city, $country, $postal]);
    }

    // Insert records into the 'transaction' table
    $transactionStmt = $pdo->prepare("INSERT INTO transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES (?, ?, ?, ?, ?, ?)");
    for ($i = 0; $i < 50; $i++) {
        $employee_id = $faker->numberBetween(1, 100);
        $office_id = $faker->numberBetween(1, 5);
        $datelog = $faker->dateTimeThisMonth->format('Y-m-d H:i:s');
        $action = $faker->randomElement(['IN', 'OUT', 'COMPLETE']);
        $remarks = $faker->realText(50); 
        $documentcode = $faker->ean8;

        $transactionStmt->execute([$employee_id, $office_id, $datelog, $action, $remarks, $documentcode]);
    }

    echo "Records inserted successfully!\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>

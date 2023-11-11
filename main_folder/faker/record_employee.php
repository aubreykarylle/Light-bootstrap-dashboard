<?php
require('vendor/autoload.php');
$faker = Faker\Factory::create();
$servername = "localhost";
$username = "root";
$password = "12345";
$database = "record_db";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

for ($i = 0; $i <= 100; $i++) {
    $lastname = mysqli_real_escape_string($conn, $faker->lastName);
    $firstname = mysqli_real_escape_string($conn, $faker->firstName);
    $city = ['Aborlan', 'Agutaya', 'Araceli', 'Bacomlabac', 'Bataraza', "Brookes Point", 'Busuanga', 'Cagayancillo', 'Coron', 'Culion', 'Cuyo', 'Dumaran', 'El Nido', 'Kalayaan', 'Linapacan', 'Magsayasay', 'Narra', 'Queson', 'Rizal', 'Roxas', 'San Vicente', 'Sofronio', 'Taytay'];
    $randomCity = rand(0, count($city) - 1);
    $address = $city[$randomCity];
    $office_id = rand(1, 4);
 

    $sql = "INSERT INTO employee(lastname, firstname, office_id, address) 
            VALUES ('$lastname', '$firstname', '$office_id', '$address')";

    mysqli_query($conn, $sql);
}

echo "100 rows of fake data have been inserted into the 'userAccount' table.";

// Close the database connection
mysqli_close($conn);
?>
<?php
require('vendor/autoload.php');
$faker = Faker\Factory::create();
$servername = "localhost";
$username = "root";
$password = "root";
$database = "recordapp_db";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $database);

$employee_ids = [];
$result = mysqli_query($conn, "SELECT id FROM employee");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $employee_ids[] = $row['id'];
    }
}

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

for ($i = 0; $i <= 100; $i++) {
    $name = mysqli_real_escape_string($conn, $faker->name);
    $office_id = rand(1, 4);
    $datelog = $faker->dateTimeThisCentury->format('Y-m-d H:i:s');
    $action_array = ['IN', 'OUT', 'COMPLETE'];
    $rand = rand(0, 2);
    $action = $action_array[$rand];
    $remarks_array = ['Signed', 'Not Signed', 'For Approval'];
    $remarks = $remarks_array[$rand];
    $documentcode = rand(100, 102);
    $employee_id = $employee_ids[array_rand($employee_ids)];

    $sql = "INSERT INTO transaction (employee_id, office_id, datelog, action, remarks, documentcode)
            VALUES ('$employee_id', '$office_id', '$datelog', '$action', '$remarks', '$documentcode')";

    mysqli_query($conn, $sql);
}

echo "100 rows of fake data have been inserted into the 'transaction' table.";

mysqli_close($conn);
?>

<?php

use Faker\Factory;
require_once('vendor/autoload.php');

try {

    $internCount = 95;
    $faker = Factory::create();

    //Set Database(Faker) connection info
    $host = 'localhost:3308';
    $dbName = 'internship';
    $username = 'root';
    $password = '';

    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;

    //Connecting MySQL Database(Faker)
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Drop the table
    $stmt = $pdo->prepare("truncate table intern");
    $stmt->execute();

    //Insert the data
    $sql = 'INSERT INTO intern(fname,lname,email,phone,group_id) VALUES (:first_name, :last_name, :email, :phone, :group_id)';
    $stmt = $pdo->prepare($sql);

    for ($i = 0; $i < $internCount; $i++) {
        $group_id = $faker->randomDigitNotNull();
        $stmt->execute(
            [
                ':first_name' => $faker->firstName,
                ':last_name' => $faker->lastName,
                ':email' => $faker->email,
                ':phone' => $faker->phoneNumber,
                ':group_id' => $faker->randomDigitNotNull
            ]
        );
    }

} catch (Exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
    exit;
}



<?php

// Application constant
const APP_TITLE = 'BE01 - PHP Personal Information and Calculator';

// Store the student's name in a constant.
const STUDENT_NAME = 'Your Name';

// Store personal information in variables.
$age = 21; // Replace with your actual age.

$email = 'your.email@example.com';

$city = 'Your City';

$skills = [
    'PHP Fundamentals',
    'Python',
    'HTML',
    'CSS',
    'JavaScript'
];

$education = 'BS Information Technology - Your University';

// Combine the variables into an associative array.
$profile = [
    'name' => STUDENT_NAME,
    'age' => $age,
    'email' => $email,
    'city' => $city,
    'skills' => $skills,
    'education' => $education
];

// Convert the associative array into an object.
$profileObject = (object) $profile;


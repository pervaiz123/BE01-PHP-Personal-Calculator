<?php

// Default calculator values.
$firstInput = '';
$secondInput = '';
$operator = '+';

// Store error and calculation information.
$errorMessage = '';

$calculationResult = null;

$isValidInput = false;
$hasResult = false;

// Execute the calculator only when the form is submitted.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Receive values from the submitted HTML form.
    $firstInput = $_POST['first_number'] ?? '';
    $secondInput = $_POST['second_number'] ?? '';

    // Make sure submitted values are strings.
    if (!is_string($firstInput)) {
        $firstInput = '';
    }

    if (!is_string($secondInput)) {
        $secondInput = '';
    }

    // Remove unnecessary spaces.
    $firstInput = trim($firstInput);
    $secondInput = trim($secondInput);

    // Receive and validate the selected operator.
    $submittedOperator = $_POST['operator'] ?? '+';

    if (
        is_string($submittedOperator) &&
        in_array($submittedOperator, ['+', '-', '*', '/'], true)
    ) {
        $operator = $submittedOperator;
    }

    // Validate that both inputs contain numeric values.
    if (
        $firstInput === '' ||
        $secondInput === '' ||
        !is_numeric($firstInput) ||
        !is_numeric($secondInput)
    ) {

        $errorMessage = 'Please enter valid numbers in both fields.';

    } else {

        $isValidInput = true;

        // Convert the submitted strings into floating-point numbers.
        $firstNumber = (float) $firstInput;
        $secondNumber = (float) $secondInput;

        // Perform the selected mathematical operation.
        switch ($operator) {

            case '+':

                $calculationResult = $firstNumber + $secondNumber;

                break;

            case '-':

                $calculationResult = $firstNumber - $secondNumber;

                break;

            case '*':

                $calculationResult = $firstNumber * $secondNumber;

                break;

            case '/':

                // Prevent division by zero.
                if ($secondNumber === 0.0) {

                    $errorMessage = 'Division by zero is not allowed.';

                    break;
                }

                $calculationResult = $firstNumber / $secondNumber;

                break;
        }

        // A result exists only when no error occurred.
        if ($errorMessage === '') {

            $hasResult = true;

        }
    }
}

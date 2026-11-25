<?php

declare(strict_types=1);

// Load the personal information and calculator logic.
require __DIR__ . '/includes/profile.php';
require __DIR__ . '/includes/calculator.php';

// Concatenate strings to create a dynamic heading.
$profileHeading = 'Personal Information - ' . $profileObject->name;

// Escape output before displaying it in HTML.
function e($value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

// Display the type of the calculation result.
$resultType = $calculationResult === null
    ? 'NULL'
    : (is_float($calculationResult) ? 'Float' : gettype($calculationResult));

// Capture var_dump output for safe display.
ob_start();

var_dump(
    $profileObject,
    $isValidInput,
    $calculationResult
);

$debugOutput = ob_get_clean();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e(APP_TITLE) ?></title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <main class="container">

        <!-- Application heading -->
        <header class="page-header">

            <h1><?php echo e(APP_TITLE); ?></h1>

            <p>
                <?php print 'A PHP application demonstrating personal information and basic calculations.'; ?>
            </p>

        </header>


        <!-- Personal Information Section -->
        <section class="card">

            <h2><?= e($profileHeading) ?></h2>

            <div class="profile-details">

                <div class="detail">

                    <strong>Name:</strong>

                    <span><?= e($profileObject->name) ?></span>

                </div>

                <div class="detail">

                    <strong>Age:</strong>

                    <span><?= e($profileObject->age) ?></span>

                </div>

                <div class="detail">

                    <strong>Email:</strong>

                    <span>
                        <a href="mailto:<?= e($profileObject->email) ?>">
                            <?= e($profileObject->email) ?>
                        </a>
                    </span>

                </div>

                <div class="detail">

                    <strong>City:</strong>

                    <span><?= e($profileObject->city) ?></span>

                </div>

                <div class="detail full-width">

                    <strong>Skills:</strong>

                    <ul class="skills-list">

                        <?php foreach ($profileObject->skills as $skill): ?>

                            <li><?= e($skill) ?></li>

                        <?php endforeach; ?>

                    </ul>

                </div>

                <div class="detail full-width">

                    <strong>Education:</strong>

                    <span><?= e($profileObject->education) ?></span>

                </div>

            </div>

        </section>


        <!-- Calculator Section -->
        <section class="card">

            <h2>Basic PHP Calculator</h2>

            <p>Enter two numbers and select a mathematical operation.</p>

            <form method="POST" action="">

                <div class="calculator-form">

                    <div class="form-group">

                        <label for="first_number">First Number</label>

                        <input type="number" id="first_number" name="first_number" step="any"
                            placeholder="Enter first number" value="<?= e($firstInput) ?>" required>

                    </div>


                    <div class="form-group">

                        <label for="operator">Operation</label>

                        <select id="operator" name="operator">

                            <option value="+" <?= $operator === '+' ? 'selected' : '' ?>>
                                Addition (+)
                            </option>

                            <option value="-" <?= $operator === '-' ? 'selected' : '' ?>>
                                Subtraction (-)
                            </option>

                            <option value="*" <?= $operator === '*' ? 'selected' : '' ?>>
                                Multiplication (*)
                            </option>

                            <option value="/" <?= $operator === '/' ? 'selected' : '' ?>>
                                Division (/)
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="second_number">Second Number</label>

                        <input type="number" id="second_number" name="second_number" step="any"
                            placeholder="Enter second number" value="<?= e($secondInput) ?>" required>

                    </div>

                </div>


                <button type="submit" name="calculate">
                    Calculate Result
                </button>

            </form>


            <!-- Display validation errors -->
            <?php if ($errorMessage !== ''): ?>

                <div class="message error" role="alert">

                    <?= e($errorMessage) ?>

                </div>

            <?php endif; ?>


            <!-- Display the calculation result -->
            <?php if ($hasResult): ?>

                <div class="message success">

                    <h3>Calculation Result</h3>

                    <p>
                        <?= e($firstInput) ?>
                        <?= e($operator) ?>
                        <?= e($secondInput) ?>
                        =
                        <strong>
                            <?= e(number_format($calculationResult, 2, '.', '')) ?>
                        </strong>
                    </p>

                </div>

            <?php endif; ?>

        </section>


        <!-- PHP Data Types and Debugging Section -->
        <section class="card">

            <details>

                <summary>PHP Data Types and Debugging</summary>

                <p>
                    This section demonstrates PHP data types,
                    type checking, print_r() and var_dump().
                </p>

                <div class="debug-details">

                    <p>
                        <strong>Name type:</strong>
                        <?= e(gettype($profileObject->name)) ?>
                    </p>

                    <p>
                        <strong>Age type:</strong>
                        <?= e(gettype($profileObject->age)) ?>
                    </p>

                    <p>
                        <strong>Skills is an array:</strong>
                        <?= is_array($profileObject->skills) ? 'Yes' : 'No' ?>
                    </p>

                    <p>
                        <strong>Profile is an object:</strong>
                        <?= is_object($profileObject) ? 'Yes' : 'No' ?>
                    </p>

                    <p>
                        <strong>Valid numeric input:</strong>
                        <?= $isValidInput ? 'true' : 'false' ?>
                    </p>

                    <p>
                        <strong>Calculation result type:</strong>
                        <?= e($resultType) ?>
                    </p>

                </div>


                <h3>print_r() Output</h3>

                <pre><?= e(print_r($profileObject, true)) ?></pre>


                <h3>var_dump() Output</h3>

                <pre><?= e($debugOutput) ?></pre>

            </details>

        </section>


        <footer>

            <p>BE01 - Introduction to PHP and PHP Fundamentals</p>

        </footer>

    </main>

</body>

</html>
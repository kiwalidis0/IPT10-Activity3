<?php

require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Retrieve POST data
$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$agree = $_POST['agree'] ?? '';

// Collect answers
$answers = [];
foreach ($_POST as $key => $value) {
    if (strpos($key, 'answer_') === 0) {
        $index = str_replace('answer_', '', $key);
        $answers[$index] = $value;
    }
}

$answers_array = array_values($answers); // Ensure the answers are in order
$score = compute_score($answers_array);
$hero_class = ($score > 2) ? 'is-success' : 'is-danger';
$birthday = date('F j, Y', strtotime($birthdate));

$questions = retrieve_questions();
$correct_answers = $questions['answers'];
$user_answers = $answers_array;

?>

<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/site/site.min.css">
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
</head>
<body class="has-background-dark">
<section class="hero has-background-dark">
    <div class="hero-body">
        <p class="title has-text-white">Your Score <?php echo $score; ?></p>
        <p class="subtitle has-text-white">This is the IPT10 PHP Quiz Web Application Laboratory Activity.</p>
    </div>
</section>
<section class="section">
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
        <tbody>
        <tr>
                    <th class="has-text-white">Input Field</th>
                    <th class="has-text-white">Value</th>
                </tr>
                <tr>
                    <td class="has-text-white">Complete Name</td>
                    <td class="has-text-white"><?php echo htmlspecialchars($complete_name); ?></td>
                </tr>
                <tr class="is-selected">
                    <td class="has-text-white">Email</td>
                    <td class="has-text-white"><?php echo htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <td class="has-text-white">Birthdate</td>
                    <td class="has-text-white"><?php echo htmlspecialchars($birthday); ?></td>
                </tr>
                <tr>
                    <td class="has-text-white">Contact Number</td>
                    <td class="has-text-white"><?php echo htmlspecialchars($contact_number); ?></td>
                </tr>
        </tbody>
        </table>

        <?php if ($score == 5): ?>
            <canvas id="confetti-canvas"></canvas>
        <?php endif; ?>

        <h2 class="title is-4">Quiz Summary</h2>
        <table class="table is-bordered is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-white">Question</th>
                    <th class="has-text-white">Correct Answer</th>
                    <th class="has-text-white">Your Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions['questions'] as $index => $question): ?>
                <tr>
                    <td class="has-text-white"><?php echo htmlspecialchars($question['question']); ?></td>
                    <td class="has-text-white"><?php echo htmlspecialchars($correct_answers[$index]); ?></td>
                    <td class="has-text-white"><?php echo htmlspecialchars($user_answers[$index] ?? 'Not Answered'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
        <?php if ($score == 5): ?>
            <script>
                var confettiSettings = {
                    target: 'confetti-canvas'
                };
                var confetti = new ConfettiGenerator(confettiSettings);
                confetti.render();
            </script>
        <?php endif; ?>
</section>
</body>
</html>
<?php

require "helpers.php";

# from the $_SERVER global variable, check if the HTTP method used is POST, if its not POST, redirect to the index.php page
# Reference: https://www.php.net/manual/en/reserved.variables.server.php

// Supply the missing code
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Retrieve POST data
$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];
$agree = $_POST['agree'];

// Prepare the target page
$target = 'result.php';

// Retrieve questions
$questions = retrieve_questions();

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            setTimeout(function() {
                document.querySelector('form').submit();
            }, 60000);
        });
    </script>
</head>
<body>
<section class="section">
    <h1 class="title">Quiz</h1>
    <h2 class="subtitle">Please answer all the questions below.</h2>

    <!-- Form to submit answers -->
    <form method="POST" action="<?php echo htmlspecialchars($target); ?>">
        <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
        <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
        <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
        <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />
        
         <!-- Initialize answers array -->
        <?php foreach ($questions['questions'] as $index => $question): ?>
            <input type="hidden" name="answer_<?php echo $index; ?>" id="answer_<?php echo $index; ?>" />
        <?php endforeach; ?>
        
        <?php foreach ($questions['questions'] as $index => $question): ?>
            <div class="box">
                <h3 class="title is-4">Question <?php echo $index + 1; ?>:</h3>
                <p><?php echo htmlspecialchars($question['question']); ?></p>

                <?php foreach ($question['options'] as $option): ?>
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="answer_<?php echo $index; ?>" value="<?php echo htmlspecialchars($option['key']); ?>" />
                                <?php echo htmlspecialchars($option['value']); ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <!-- Start Quiz button -->
        <button type="submit" class="button">Submit</button>
    </form>
</section>

</body>
</html>
<?php
# from the $_SERVER global variable, check if the HTTP method used is POST, if its not POST, redirect to the index.php page
# Reference: https://www.php.net/manual/en/reserved.variables.server.php

// Supply the missing code
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Supply the missing code
$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>
<body>
<section class="section">
    <h1 class="title">Instructions</h1>
    <h2 class="subtitle">
        Greetings, <?php echo $complete_name;?>!
    </h2>

    <!-- Supply the correct HTTP method and target form handler resource -->
    <form method="POST" action="quiz.php">
        <input type="hidden" name="complete_name" value="<?php echo $complete_name; ?>" />
        <input type="hidden" name="email" value="<?php echo $email; ?>" />
        <input type="hidden" name="birthdate"value="<?php echo $birthdate; ?>" />
        <input type="hidden" name="contact_number" value="<?php echo $contact_number; ?>" />

        <!-- Display the instruction -->
        <p>Please read the instructions below to avoid confusion. If there are questions, ask the teacher to assist you.</p>

        <div class="field">
            <label class="label">Terms and conditions</label>
            <div class="control">
                <textarea class="textarea" readonly>
                    Welcome to the quiz! This quiz is multiple choice, make sure to pick the correct answer before submitting. Goodluck <?php echo $complete_name?> !
                </textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" name="disagree">
                I agree to the <a href="#">terms and conditions</a>
                </label>
            </div>
        </div>

        <!-- Start Quiz button -->
        <button type="submit" class="button is-link">Start Quiz</button>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.querySelector('input[name="disagree"]');
    const submitButton = document.querySelector('button[type="submit"]');

    function toggleSubmitButton() {
        submitButton.disabled = !checkbox.checked;
    }

    checkbox.addEventListener('change', toggleSubmitButton);

    // Initial check
    toggleSubmitButton();
});
</script>

</body>
</html>
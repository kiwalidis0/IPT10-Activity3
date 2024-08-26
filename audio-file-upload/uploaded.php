<?php

$upload_directory = getcwd() . '/uploads/';

// Ensure the upload directory exists
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

// Check if a file was uploaded
if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['audio_file']['tmp_name'];
    $fileName = basename($_FILES['audio_file']['name']);
    $filePath = $upload_directory . $fileName;

    // Move the uploaded file
    if (move_uploaded_file($fileTmpPath, $filePath)) {
        $relative_path = 'uploads/';
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Upload Successful</title>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css'>
        </head>
        <body>
            <section class='section'>
                <div class='container'>
                    <h1 class='title'>Upload Successful</h1>
                    <a href='" . htmlspecialchars($relative_path . $fileName, ENT_QUOTES, 'UTF-8') . "' target='_blank' class='button is-primary'>Listen to MP3</a>
                </div>
            </section>
        </body>
        </html>";
    } else {
        echo "Error moving the uploaded file.";
    }
} else {
    echo 'No file uploaded or upload error';
}

exit;
?>

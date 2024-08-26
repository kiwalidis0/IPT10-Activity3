<?php

$upload_directory = getcwd() . '/uploads/';

// Ensure the upload directory exists
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

// Check if a file was uploaded
if (isset($_FILES['video_file']) && $_FILES['video_file']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['video_file']['tmp_name'];
    $fileName = basename($_FILES['video_file']['name']);
    $fileType = $_FILES['video_file']['type'];
    $filePath = $upload_directory . $fileName;

    // Validate image file type
    if ($fileType === 'video/mp4') {
        // Move the uploaded file
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Make sure the file was moved successfully
            if (file_exists($filePath)) {
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
                            <video controls style='max-width: 100%; height: auto;'>
                                <source src='" . htmlspecialchars($relative_path . $fileName, ENT_QUOTES, 'UTF-8') . "' type='video/mp4'>
                                Your browser does not support the video tag.
                            </video>
                            <p><a href='" . htmlspecialchars($relative_path . $fileName, ENT_QUOTES, 'UTF-8') . "' target='_blank' class='button is-primary'>View Video</a></p>
                        </div>
                    </section>
                </body>
                </html>";
            } else {
                echo "Error: The file does not exist after moving.";
            }
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "Uploaded file is not a valid image type.";
    }
} else {
    echo 'No file uploaded or upload error';
}

exit;
?>
